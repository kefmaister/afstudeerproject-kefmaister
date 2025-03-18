<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Proposal;
use App\Models\Cv;
use App\Models\Studyfield;
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function index(Request $request)
{
    // Get the coordinator's studyfields
    $coordinator = auth()->user()->coordinator;
    $allowedStudyfieldIds = $coordinator ? $coordinator->studyfields()->pluck('id')->toArray() : [];

    // If the coordinator has no studyfields, you might choose to return
    // an empty collection or a message. For example:
    if (empty($allowedStudyfieldIds)) {
        $students = collect();
        $studyfields = collect();
        return view('coordinator.home', compact('students', 'studyfields'));
    }

    $query = Student::query();

    // Filter: Only include students in one of these studyfields.
    // Make sure the column name ('studyfield_id') matches your DB
    $query->whereIn('studyfield_id', $allowedStudyfieldIds);

    // 1) Search by student name
    if ($search = $request->input('search')) {
        $query->whereHas('user', function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('firstname', 'like', "%{$search}%")
                      ->orWhere('lastname', 'like', "%{$search}%");
            });
        });
    }

    // 2) Additional filtering by studyfield if passed through form
    if ($studyfieldId = $request->input('studyfield')) {
        $query->where('studyfield_id', $studyfieldId);
    }

    // 3) Filter by proposal status
    if ($proposalStatus = $request->input('proposal_status')) {
        $query->whereHas('proposal', function ($q) use ($proposalStatus) {
            $q->where('status', $proposalStatus);
        });
    }

    // 4) Filter by contract status
    if ($contractStatus = $request->input('contract_status')) {
        $query->where('contract_status', $contractStatus);
    }

    // 5) Get paginated results
    $students = $query->with(['proposal', 'studyfield'])->paginate(10);

    // Provide the list of studyfields for the filter. Only show allowed ones.
    $studyfields = Studyfield::whereIn('id', $allowedStudyfieldIds)->get();

    return view('coordinator.home', [
        'students' => $students,
        'studyfields' => $studyfields,
    ]);
}

public function showStudent(Student $student)
{
    // Get the coordinator's studyfields
    $coordinator = auth()->user()->coordinator;
    $allowedStudyfieldIds = $coordinator ? $coordinator->studyfields()->pluck('id')->toArray() : [];

    // Ensure the student belongs to one of the coordinator's studyfields
    if (!in_array($student->studyfield_id, $allowedStudyfieldIds)) {
        abort(403, 'Unauthorized action.');
    }

    // Load the student's CV
    $cv = Cv::where('student_id', $student->id)->first();

    // Load all students in the coordinator's studyfields
    $students = Student::with(['proposal', 'user'])
        ->whereIn('studyfield_id', $allowedStudyfieldIds)
        ->orderBy('id', 'asc')
        ->get();

    // Compute previous and next student IDs
    $studentIds = $students->pluck('id')->toArray();
    $currentIndex = array_search($student->id, $studentIds);
    $prevStudentId = $currentIndex > 0 ? $studentIds[$currentIndex - 1] : null;
    $nextStudentId = $currentIndex < count($studentIds) - 1 ? $studentIds[$currentIndex + 1] : null;

    return view('coordinator.student-detail', [
        'student' => $student,
        'students' => $students,
        'prevStudentId' => $prevStudentId,
        'nextStudentId' => $nextStudentId,
        'cv' => $cv,
    ]);
}


public function showStudentCv(Student $student)
{
    // Get the coordinator's studyfields
    $coordinator = auth()->user()->coordinator;
    $allowedStudyfieldIds = $coordinator ? $coordinator->studyfields()->pluck('id')->toArray() : [];

    // Ensure the student belongs to the allowed studyfields
    if (!in_array($student->studyfield_id, $allowedStudyfieldIds)) {
        abort(403, 'Unauthorized action.');
    }

    $cv = Cv::where('student_id', $student->id)->first();

    // Also load students filtered by allowed studyfields
    $students = Student::with(['proposal', 'user'])
        ->whereIn('studyfield_id', $allowedStudyfieldIds)
        ->orderBy('id', 'asc')
        ->get();

    // Compute previous and next student IDs
    $studentIds = $students->pluck('id')->toArray();
    $currentIndex = array_search($student->id, $studentIds);
    $prevStudentId = $currentIndex > 0 ? $studentIds[$currentIndex - 1] : null;
    $nextStudentId = $currentIndex < count($studentIds) - 1 ? $studentIds[$currentIndex + 1] : null;

    return view('coordinator.partials.cv-page', compact('student', 'cv', 'students', 'prevStudentId', 'nextStudentId'));
}

public function showStudentProposal(Student $student)
{
    // Get the coordinator's studyfields
    $coordinator = auth()->user()->coordinator;
    $allowedStudyfieldIds = $coordinator ? $coordinator->studyfields()->pluck('id')->toArray() : [];

    // Ensure the student belongs to the allowed studyfields
    if (!in_array($student->studyfield_id, $allowedStudyfieldIds)) {
        abort(403, 'Unauthorized action.');
    }

    $students = Student::with(['proposal', 'user'])
        ->whereIn('studyfield_id', $allowedStudyfieldIds)
        ->orderBy('id', 'asc')
        ->get();

    // Compute prev and next student IDs
    $studentIds = $students->pluck('id')->toArray();
    $currentIndex = array_search($student->id, $studentIds);
    $prevStudentId = $currentIndex > 0 ? $studentIds[$currentIndex - 1] : null;
    $nextStudentId = $currentIndex < count($studentIds) - 1 ? $studentIds[$currentIndex + 1] : null;

    return view('coordinator.partials.proposal-page', compact('student', 'students', 'prevStudentId', 'nextStudentId'));
}

    public function updateProposal(Request $request, Proposal $proposal)
    {
        $request->validate([
            'status' => 'required|string|in:approved,denied,pending',
            'feedback' => 'nullable|string|max:255',
        ]);

        $proposal->status = $request->input('status');
        $proposal->feedback = $request->input('feedback');
        $proposal->save();

        return redirect()->route('coordinator.student.proposal', $proposal->student_id)->with('status', 'Proposal updated successfully.');
    }

    public function giveCvFeedback(Request $request, Cv $cv)
    {
        $request->validate([
            'feedback' => 'required|string|max:255',
        ]);

        $cv->feedback = $request->feedback;
        $cv->save();

        return redirect()->route('coordinator.student.show', $cv->student_id)->with('status', 'Feedback gegeven.');
    }

    public function profile()
    {
        $coordinator = auth()->user()->coordinator;
        return view('coordinator.profile', compact('coordinator'));
    }

    public function updateProfile(Request $request)
{
    $coordinator = auth()->user()->coordinator;

    $validated = $request->validate([
        'firstname' => ['required', 'string', 'max:255'],
        'lastname'  => ['required', 'string', 'max:255'],
        'email'     => ['required', 'email', 'max:255'],
    ]);

    $user = $coordinator->user;

    $user->update($validated);

    return redirect()->route('coordinator.profile')->with('status', 'Profiel succesvol bijgewerkt!');
}
}

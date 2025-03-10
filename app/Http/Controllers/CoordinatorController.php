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
        // Only show students from the coordinator's own studyfields
        // or show all if coordinator can see all. Adjust logic as needed:
        // $allowedStudyfields = auth()->user()->studyfield ? [auth()->user()->studyfield->id] : [];
        // For demonstration, we won't restrict. But in production, you might do so.

        $query = Student::query();

        // 1) Search by student name
        if ($search = $request->input('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }


        // 2) Filter by studyfield
        if ($studyfieldId = $request->input('studyfield')) {
            $query->where('studyfield_id', $studyfieldId);
        }

        // 3) Filter by proposal status
        if ($proposalStatus = $request->input('proposal_status')) {
            // Assuming Student has a `proposal()` relationship
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

        // Provide the list of studyfields for the filter
        $studyfields = Studyfield::all();

        return view('coordinator.home', [
            'students' => $students,
            'studyfields' => $studyfields,
        ]);
    }

    public function showStudent(Student $student)
    {
        // Load the student's CV
        $cv = Cv::where('student_id', $student->id)->first();

        // Load all students in an ordered collection
        $students = Student::with(['proposal', 'user'])->orderBy('id', 'asc')->get();

        // Find the index of the current student in that collection
        $currentIndex = $students->search(function ($s) use ($student) {
            return $s->id === $student->id;
        });

        // Compute prev and next
        $prevStudentId = null;
        $nextStudentId = null;

        if ($currentIndex > 0) {
            $prevStudentId = $students[$currentIndex - 1]->id;
        }
        if ($currentIndex < $students->count() - 1) {
            $nextStudentId = $students[$currentIndex + 1]->id;
        }

        // Return the view
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
        $cv = Cv::where('student_id', $student->id)->first();
        $students = Student::with(['proposal', 'user'])->orderBy('id', 'asc')->get();

        // Find the index of the current student in that collection
        $currentIndex = $students->search(function ($s) use ($student) {
            return $s->id === $student->id;
        });

        // Compute prev and next
        $prevStudentId = null;
        $nextStudentId = null;

        if ($currentIndex > 0) {
            $prevStudentId = $students[$currentIndex - 1]->id;
        }
        if ($currentIndex < $students->count() - 1) {
            $nextStudentId = $students[$currentIndex + 1]->id;
        }

        return view('coordinator.partials.cv-page', compact('student', 'cv', 'students', 'prevStudentId', 'nextStudentId'));
    }

    public function showStudentProposal(Student $student)
    {
        $students = Student::with(['proposal', 'user'])->orderBy('id', 'asc')->get();

        // Find the index of the current student in that collection
        $currentIndex = $students->search(function ($s) use ($student) {
            return $s->id === $student->id;
        });

        // Compute prev and next
        $prevStudentId = null;
        $nextStudentId = null;

        if ($currentIndex > 0) {
            $prevStudentId = $students[$currentIndex - 1]->id;
        }
        if ($currentIndex < $students->count() - 1) {
            $nextStudentId = $students[$currentIndex + 1]->id;
        }

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
}

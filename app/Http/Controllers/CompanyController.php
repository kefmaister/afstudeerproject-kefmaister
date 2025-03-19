<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Studyfield;
use App\Models\Coordinator;
use App\Models\Student;
use App\Models\Proposal;

class CompanyController extends Controller
{
    public function index(Request $request)
{
    $user = auth()->user();
    $company = $user->company;

    if (!$company) {
        abort(403, 'Geen bedrijf gekoppeld aan dit account.');
        return redirect()->route('company.home')->with('status', 'Terug naar home.');
    }

    if ($company->accepted === 0) {
        return redirect()->route('company.waiting');
    }

    if ($company->accepted === -1) {
        return redirect()->route('company.denied');
    }

    $stages = $company->stages()->latest()->paginate(6);

    $selectedStage = null;
    if ($request->has('selectedStage')) {
        $selectedStage = $company->stages()->find($request->get('selectedStage'));
    }

    $studyfields = Studyfield::all();

    return view('company.home', compact('stages', 'selectedStage', 'studyfields'));
}

public function studentList(Request $request)
{
    $company = auth()->user()->company;

    if (!$company) {
        abort(403, 'Geen bedrijf gekoppeld aan dit account.');
    }

    // Get proposals that are linked to stages of this company
    $proposalQuery = Proposal::whereHas('stage', function ($q) use ($company) {
        $q->where('company_id', $company->id);
    })->with(['student.user', 'stage']);

    // Add search filter on student's name
    if ($request->filled('search')) {
        $search = $request->input('search');
        $proposalQuery->whereHas('student.user', function ($q) use ($search) {
            $q->where('firstname', 'like', "%$search%")
              ->orWhere('lastname', 'like', "%$search%");
        });
    }

    $proposals = $proposalQuery->paginate(10);

    return view('company.student-list', compact('proposals'));
}

public function waiting()
{
    $coordinators = Coordinator::with('user')->get();
    return view('company.waiting', compact('coordinators'));
}

public function update(Request $request, Stage $stage)
{
    // Ensure the stage belongs to the authenticated company
    if ($stage->company_id !== auth()->user()->company->id) {
        abort(403);
    }

    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'tasks' => ['required', 'string'],
    ]);

    $stage->update($validated);

    return redirect()->route('company.home', ['selectedStage' => $stage->id])
        ->with('status', 'Stage succesvol bijgewerkt!');
}

    public function create()
{
    $studyfields = Studyfield::all();
    return view('company.create', compact('studyfields'));
}

public function store(Request $request)
{
$company = auth()->user()->company;

if (!$company) {
    abort(403, 'Geen bedrijf gekoppeld aan dit account.');
    return redirect()->route('company.home')->with('status', 'Terug naar home.');
    }

// Validate incoming data
$validated = $request->validate([
    'title' => ['required', 'string', 'max:255'],
    'tasks' => ['required', 'string'],
    'studyfield_id' => ['required', 'exists:studyfield,id'],
]);

// Create the stage (default to inactive/pending approval)
$stage = $company->stages()->create([
    'title' => $validated['title'],
    'tasks' => $validated['tasks'],
    'studyfield_id' => $validated['studyfield_id'],
    'active' => 0,
]);

return redirect()->route('company.home')->with('status', 'Stageplaats succesvol aangemaakt!');
}

public function activateStage(Stage $stage)
{
    $this->authorizeStageAccess($stage);

    $stage->update([
        'active' => 1, // In behandeling
        'denial_reason' => null // Clear old denial if re-submitting
    ]);

    return redirect()->route('company.home', ['selectedStage' => $stage->id])
        ->with('status', 'Stage is ingediend voor beoordeling.');
}

public function deactivateStage(Stage $stage)
{
    $this->authorizeStageAccess($stage);

    $stage->update([
        'active' => -1,
    ]);

    return redirect()->route('company.home', ['selectedStage' => $stage->id])
        ->with('status', 'Stage is gedeactiveerd.');
}

private function authorizeStageAccess(Stage $stage)
{
    if ($stage->company_id !== auth()->user()->company->id) {
        abort(403);
    }
}

public function denied()
{
    $company = auth()->user()->company;

    if (!$company) {
        abort(403, 'Geen bedrijf gekoppeld aan dit account.');
    }

    $reason = $company->reason;
    $coordinators = \App\Models\Coordinator::with('user')->get();

    return view('company.denied', compact('reason', 'coordinators'));
}

public function profile()
{
    $company = auth()->user()->company;

    if (!$company) {
        abort(403, 'Geen bedrijf gekoppeld aan dit account.');
    }

    return view('company.profile', compact('company'));
}

public function updateProfile(Request $request)
{
    $company = auth()->user()->company;

    $validated = $request->validate([
        'company_name' => 'required|string|max:255',
        'company_vat' => 'nullable|string|max:50',
        'street' => 'nullable|string|max:255',
        'streetNr' => 'nullable|string|max:10',
        'zip' => 'nullable|string|max:10',
        'town' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'website' => 'nullable|url|max:255',
        'phone' => 'nullable|string|max:50',
        'employee_count' => 'nullable|integer',
        'max_students' => 'nullable|integer',
        'student_amount' => 'nullable|integer',
        'logo' => 'nullable|image|max:2048',
    ]);


    if ($request->hasFile('logo')) {
        $validated['logo'] = $request->file('logo')->store('logos', 'public');
    }

    $company->update($validated);

    return redirect()->route('company.profile')->with('status', 'Profiel succesvol bijgewerkt.');
}


}

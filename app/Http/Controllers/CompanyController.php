<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Studyfield;
use App\Models\Coordinator;

class CompanyController extends Controller
{
    public function index(Request $request)
{
    $user = auth()->user();
    $company = $user->company;

    if (!$company) {
        abort(403, 'Geen bedrijf gekoppeld aan dit account.');
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


}

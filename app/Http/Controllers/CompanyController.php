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

        // Redirect if not accepted
        if ($company->accepted === 0) {
            return redirect()->route('company.waiting');
        }

        if ($company->accepted === -1) {
            return redirect()->route('company.denied');
        }

        // Approved
        $stages = $company->stages()->latest()->paginate(6);

        $selectedStage = null;
        if ($request->has('selectedStage')) {
            $selectedStage = $company->stages()->find($request->get('selectedStage'));
        }

        return view('company.home', compact('stages', 'selectedStage'));
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
}

<?php
namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Mentor;
use App\Models\Stage;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function show(Request $request)
{
    $student = auth()->user()->student;
    if (!$student) {
        abort(404, 'Student record not found.');
    }

    // Check if a proposal already exists
    $proposal = Proposal::with('stage.company', 'stage.mentor', 'coordinator')
    ->where('student_id', $student->id)
    ->first();


    // Don't auto-create one here (avoid stage_id missing errors)
    return view('student.proposal', ['proposal' => $proposal]);
}


    public function create(Request $request)
{
    $stageId = $request->input('stage_id');
    // Eager load both company and studyfield
    $stage = Stage::with(['company', 'studyfield'])->findOrFail($stageId);

    // Get the logged-in student
    $student = auth()->user()->student;

    if (!$student) {
        abort(403, 'Geen student gevonden voor deze gebruiker.');
    }

    $studentId = $student->id;

    // Get the coordinator_id from the stage's study field
    $coordinatorId = $stage->studyfield->coordinator_id;

    // Create a new proposal with the company information filled in based on the selected stage
    $proposal = Proposal::firstOrNew([
        'student_id' => $studentId,
        'stage_id'  => $stageId,
    ]);

    if (!$proposal->exists) {
        $proposal->fill([
            'status'         => 'draft',
            'coordinator_id' => $coordinatorId,
            'tasks'          => '', // default empty tasks
            'motivation'     => '', // default empty motivation
            'status'         => 'draft',
        ]);
        $proposal->save();
    } else {
        // Ensure the status is set to draft if not already set to pending, approved, or denied
        if (!in_array($proposal->status, ['pending', 'approved', 'denied'])) {
            $proposal->status = 'draft';
            $proposal->save();
        }
    }

    return redirect()->route('proposal.show', ['proposal' => $proposal->id]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'stage_id' => 'required|exists:stage,id',
        'company_name' => 'required|string|max:255',
        'street' => 'required|string|max:255',
        'nr' => 'required|string|max:10',
        'zip' => 'required|string|max:10',
        'town' => 'required|string|max:255',
        'stage_mentor_firstname' => 'required|string|max:255',
        'stage_mentor_lastname' => 'required|string|max:255',
        'stage_mentor_email' => 'required|email|max:255',
        'stage_mentor_phone' => 'nullable|string|max:50',
        'tasks' => 'required|string',
        'motivation' => 'required|string',
    ]);

    $student = auth()->user()->student;
    if (!$student) {
        abort(403, 'Geen student gekoppeld aan dit account.');
    }

    // 🔥 Load stage (with company) directly from validated data
    $stage = Stage::with('company')->findOrFail($validated['stage_id']);
    $company = $stage->company;

    if (!$company) {
        abort(403, 'Geen bedrijf gekoppeld aan deze stage.');
    }

    // 🔄 Find or create proposal
    $proposal = Proposal::firstOrNew([
        'student_id' => $student->id,
        'stage_id' => $validated['stage_id'],
    ]);

    $proposal->fill([
        'tasks' => $validated['tasks'],
        'motivation' => $validated['motivation'],
        'status' => 'pending',
        'coordinator_id' => $stage->studyfield->coordinator_id ?? null,
    ]);

    $proposal->save();

    // ✅ Check if mentor already exists
    $mentor = Mentor::where('email', $validated['stage_mentor_email'])
    ->where('stage_id', $stage->id)
    ->first();

    if (!$mentor) {
        $mentor = Mentor::create([
            'firstname' => $validated['stage_mentor_firstname'],
            'lastname' => $validated['stage_mentor_lastname'],
            'email' => $validated['stage_mentor_email'],
            'phone' => $validated['stage_mentor_phone'] ?? '',
            'stage_id' => $stage->id,
        ]);
    }

    return redirect()->route('proposal.show')
        ->with('status', 'Voorstel succesvol ingediend!');
}



}

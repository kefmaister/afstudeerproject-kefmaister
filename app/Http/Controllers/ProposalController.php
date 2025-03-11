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
        // Get the logged-in student’s proposal (if it exists)
        $proposal = Proposal::with('stage.company')->where('student_id', auth()->id())->first();

        // If the proposal doesn't exist, create a new empty proposal
        if (!$proposal) {
            $proposal = new Proposal();
        }

        return view('student.proposal', [
            'proposal' => $proposal,
        ]);
    }

    public function create(Request $request)
{
    $stageId = $request->input('stage_id');
    // Eager load both company and studyfield
    $stage = Stage::with(['company', 'studyfield'])->findOrFail($stageId);

    // Get the logged-in student
    $studentId = auth()->id();

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
        // Validate form input
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'nr' => 'required|string|max:10',
            'zip' => 'required|string|max:10',
            'town' => 'required|string|max:255',
            'stage_mentor' => 'required|string|max:255',
            'stage_mentor_email' => 'required|email|max:255',
            'tasks' => 'required|string',
            'motivation' => 'required|string',
        ]);

        // Find or create the student's proposal
        $proposal = Proposal::firstOrNew([
            'student_id' => auth()->id(),
        ]);

        // Fill fields from validated data
        $proposal->fill($validated);

        // Set status to draft if not already set
        if (!$proposal->exists) {
            $proposal->status = 'draft';
        }

        // Save the proposal
        $proposal->save();

        // Create a new mentor and link to the company based on the stage ID
        $mentor = Mentor::create([
            'firstname' => $request->input('stage_mentor'),
            'lastname' => '',
            'phone' => '',
            'email' => $request->input('stage_mentor_email'),
            'company_id' => $proposal->stage->company->id,
        ]);

        return redirect()->route('proposal.show')
            ->with('status', 'Proposal submitted successfully!');
    }
}

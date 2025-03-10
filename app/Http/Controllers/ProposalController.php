<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function show(Request $request)
    {
        // 1) Get the logged-in student’s proposal (if it exists)
        $proposal = Proposal::with('stage.company')->where('student_id', auth()->id())->first();

        // 2) If no proposal, we’ll assume we’re in the “start” state



        // 3) If status is “pending” or “approved,” we’ll show a locked form
        //    and the relevant coordinator info or final page

        return view('student.proposal', [
            'proposal' => $proposal,
        ]);
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

        // Set status to pending once they “send” the proposal
        $proposal->status = 'pending';

        // If you want to automatically assign a coordinator based on the student's studyfield:
        // $proposal->coordinator_id = auth()->user()->studyfield->coordinator->id ?? null;

        $proposal->save();

        return redirect()->route('proposal.show')
            ->with('status', 'Proposal submitted successfully!');
    }

    public function approve(Proposal $proposal)
{
    $proposal->status = 'approved';
    $proposal->feedback = 'Goed gedaan!';
    $proposal->save();

    return back()->with('status', 'Proposal approved!');
}

}

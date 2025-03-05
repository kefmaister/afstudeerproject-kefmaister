<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Proposal;
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
}

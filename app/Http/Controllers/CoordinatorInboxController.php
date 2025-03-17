<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Stage;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyApproved;
use App\Mail\CompanyDenied;
use App\Mail\StageApprovalMail;
use App\Mail\StageDenialMail;

class CoordinatorInboxController extends Controller
{
    // Combined index if needed
    public function index()
    {
        // Return both pending companies and stages
        $pendingCompanies = Company::where('accepted', 0)
            ->with('user')
            ->get();
        $pendingStages = Stage::where('active', 0)
            ->with('company.user')
            ->get();
        return view('coordinator.inbox', compact('pendingCompanies', 'pendingStages'));
    }

    // Index only companies
    public function indexCompanies()
{
    $pendingCompanies = Company::where('accepted', 0)
        ->with('user')
        ->get();
    // Always get the stages count as well
    $pendingStages = Stage::where('active', 0)
        ->with('company.user')
        ->get();
    return view('coordinator.inbox', compact('pendingCompanies', 'pendingStages'));
}

public function indexStages()
{
    // Always get the companies count as well
    $pendingCompanies = Company::where('accepted', 0)
         ->with('user')
         ->get();
    $pendingStages = Stage::where('active', 0)
         ->with('company.user')
         ->get();
    return view('coordinator.inbox', compact('pendingCompanies', 'pendingStages'));
}
    public function approveCompany(Request $request, Company $company)
    {
        $company->accepted = 1;
        $company->save();

        Mail::to($company->user->email)->send(new CompanyApproved($company->user));

        return redirect()->back()->with('status', 'Company approved successfully!');
    }

    public function denyCompany(Request $request, Company $company)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $company->update([
            'accepted' => -1,
            'reason' => $request->input('reason'),
        ]);

        Mail::to($company->user->email)->send(new CompanyDenied($company->user, $request->input('reason')));

        return redirect()->back()->with('status', 'Company denied successfully!');
    }


    public function approveStage(Request $request, Stage $stage)
    {
        $stage->active = 1;
        $stage->save();

        Mail::to($stage->company->user->email)->send(new StageApprovalMail($stage));

        return redirect()->back()->with('status', 'Stage approved successfully!');
    }

    public function denyStage(Request $request, Stage $stage)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);
        $stage->active = -1;
        $stage->save();

        Mail::to($stage->company->user->email)->send(new StageDenialMail($stage, $request->input('reason')));

        return redirect()->back()->with('status', 'Stage denied successfully!');
    }
}

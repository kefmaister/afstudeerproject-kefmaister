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
    public function index()
    {
        $pendingCompanies = Company::where('accepted', 0)->with('user')->get();
        $pendingStages = Stage::where('active', 1)->with('company.user')->get(); // Only submitted stages
        return view('coordinator.inbox', compact('pendingCompanies', 'pendingStages'));
    }

    public function indexCompanies()
    {
        $pendingCompanies = Company::where('accepted', 0)->with('user')->get();
        $pendingStages = Stage::where('active', 1)->with('company.user')->get();
        return view('coordinator.inbox', compact('pendingCompanies', 'pendingStages'));
    }

    public function indexStages()
    {
        $pendingCompanies = Company::where('accepted', 0)->with('user')->get();
        $pendingStages = Stage::where('active', 1)->with('company.user')->get();
        return view('coordinator.inbox', compact('pendingCompanies', 'pendingStages'));
    }

    public function approveCompany(Request $request, Company $company)
    {
        $company->update(['accepted' => 1]);

        \Log::info('Sending approval email to: ' . $company->user->email);
        Mail::to($company->user->email)->send(new CompanyApproved($company));
        \Log::info('Email sent');

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

    $coordinator = auth()->user()->coordinator;

    Mail::to($company->user->email)->send(
        new CompanyDenied($company, $request->input('reason'), $coordinator)
    );

    return redirect()->back()->with('status', 'Company denied successfully!');
}

    public function approveStage(Request $request, Stage $stage)
    {
        $stage->update([
            'active' => 2, // 2 = approved
            'reason' => ' ',
        ]);

        Mail::to($stage->company->user->email)->send(new StageApprovalMail($stage));

        return redirect()->back()->with('status', 'Stage approved successfully!');
    }

    public function denyStage(Request $request, Stage $stage)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $stage->update([
            'active' => -1,
            'reason' => $request->input('reason'),
        ]);

        Mail::to($stage->company->user->email)->send(new StageDenialMail($stage, $request->input('reason')));

        return redirect()->back()->with('status', 'Stage denied successfully!');
    }
}

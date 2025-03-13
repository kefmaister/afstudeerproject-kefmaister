<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coordinator;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role === 'student') {
                return redirect()->route('student.home');
            } elseif ($role === 'coordinator') {
                return redirect()->route('coordinator.home');
            } elseif ($role === 'company') {
                return redirect()->route('company.home');
            }
        }

        $coordinators = Coordinator::with('user')
            ->orderBy('created_at', 'asc')
            ->take(3)
            ->get();

        $recentCompanies = Company::with('user')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('welcome', compact('coordinators', 'recentCompanies'));
    }
}

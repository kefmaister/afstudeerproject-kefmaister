<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'firstname' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // Optionally add other validation rules for company info:
        'company_name' => ['required', 'string', 'max:255'],
        'street'       => ['required', 'string', 'max:255'],
        'nr'           => ['required'],
        'town'         => ['required', 'string'],
        'zip'          => ['required', 'string'],
        'employee_count' => ['nullable', 'numeric'],
        'company_vat'  => ['nullable', 'string', 'max:255'],
    ]);

    // Create the new user (assumed role is set to 'company' either by default or via form/input)
    $user = User::create([
        'firstname'     => $request->firstname,
        'lastname'    => $request->lastname,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'created_at' => now(),
        'updated_at' => now(),
        // Ensure the role is set appropriately, e.g.
        'role'     => 'company',
    ]);

    event(new Registered($user));
    Auth::login($user);

    // Process file upload for logo if present
    $logoPath = null;
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
    }

    // Create the company record linked to the user with accepted set to 0 (pending)
    Company::create([
        'user_id'      => $user->id,
        'company_name' => $request->company_name,
        'street'       => $request->street,
        'streetNr'     => $request->nr,
        'town'         => $request->town,
        'zip'          => $request->zip,
        'employee_count' => $request->employee_count ?? 0,
        'logo'         => $logoPath,
        'accepted'     => 0, // pending approval
        'created_at'   => now(),
        'updated_at'   => now(),
        'max_students' => 0,
        'student_amount' => 0,
        'company_vat'  => $request->company_vat,
    ]);

    // Redirect newly registered companies to the company home view
    return redirect()->route('company.home');
}
}

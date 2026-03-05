<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Services\ActivityLogger;

class AuthController extends Controller
{
    public function loginForm()  { return view('auth.login'); }
    public function registerForm(){ return view('auth.register'); }
    public function pending()    { return view('auth.pending'); }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email','password'))) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        $user = auth()->user();

        if ($user->status === 'suspended') {
            Auth::logout();
            return back()->withErrors(['email' => 'Account suspended.']);
        }

        $user->update(['last_login_at' => now()]);
        ActivityLogger::record($user->id, 'user_login', 'User logged in');

        // Redirect based on role
        return match($user->role) {
            'super_admin' => redirect()->route('admin'),
            'university'  => $user->status === 'pending'
                                ? redirect()->route('pending')
                                : redirect()->route('portal'),
            'student'     => redirect()->route('student.dashboard'),
            default       => redirect()->route('verify'),
        };
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|min:8|confirmed',
            'role'             => 'required|in:recruiter,university,student',
            'university_name'  => 'required_if:role,university|nullable|string',
            'company_name'     => 'nullable|string',
        ]);

        $status = $request->role === 'university' ? 'pending' : 'active';

        $user = User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'role'            => $request->role,
            'status'          => $status,
            'university_name' => $request->university_name,
            'company_name'    => $request->company_name,
        ]);

        // Notify admin of new university signup
        if ($user->role === 'university') {
            // Mail::to('admin@educhain.pk')->send(new NewUniversitySignup($user));
            Auth::login($user);
            return redirect()->route('pending');
        }

        Auth::login($user);
        ActivityLogger::record($user->id, 'user_registered', 'New user registered');

        return match($user->role) {
            'student'   => redirect()->route('student.dashboard'),
            default     => redirect()->route('verify'),
        };
    }

    public function logout()
    {
        ActivityLogger::record(auth()->id(), 'user_logout', 'User logged out');
        Auth::logout();
        return redirect()->route('home');
    }
}
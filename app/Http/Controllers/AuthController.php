<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UniversityApproved;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function pending()
    {
        return view('auth.pending');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            // Update last login
            $user->update(['last_login_at' => now()]);
            
            // Redirect based on role
            switch ($user->role) {
                case 'super_admin':
                    return redirect()->route('admin');
                case 'university':
                    return $user->status === 'approved' 
                        ? redirect()->route('portal') 
                        : redirect()->route('pending');
                case 'student':
                    return redirect()->route('student.dashboard');
                default:
                    return redirect()->route('verify');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:recruiter,university,student',
            'university_name' => 'required_if:role,university|nullable|string',
            'company_name' => 'required_if:role,recruiter|nullable|string',
        ]);

        $status = $request->role === 'university' ? 'pending' : 'approved';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $status,
            'university_name' => $request->university_name,
            'company_name' => $request->company_name,
        ]);

        // Notify admin for university registrations
        if ($user->role === 'university') {
            // Mail::to('admin@educhain.pk')->send(new UniversityApproved($user));
            Auth::login($user);
            return redirect()->route('pending');
        }

        Auth::login($user);

        return redirect()->route('verify');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
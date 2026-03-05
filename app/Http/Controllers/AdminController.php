<?php

namespace App\Http\Controllers;

use App\Models\{User, University, Verification, IssuedDegree, FraudAlert};
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'          => User::count(),
            'total_verifications'  => Verification::count(),
            'today_verifications'  => Verification::whereDate('created_at', today())->count(),
            'fake_caught'          => Verification::where('result', 'fake')->count(),
            'real_confirmed'       => Verification::where('result', 'real')->count(),
            'universities_on_chain'=> University::where('is_on_educhain', true)->count(),
            'pending_universities' => User::where('role','university')->where('status','pending')->count(),
            'fraud_alerts'         => FraudAlert::where('status','new')->where('search_count','>=',5)->count(),
            'total_issued'         => IssuedDegree::count(),
        ];

        $recent_verifications = Verification::with('user')->latest()->take(10)->get();
        $recent_activity      = \App\Models\ActivityLog::with('user')->latest()->take(15)->get();

        return view('admin.index', compact('stats','recent_verifications','recent_activity'));
    }

    public function pending()
    {
        $pending = User::where('role','university')->where('status','pending')->latest()->get();
        return view('admin.pending', compact('pending'));
    }

    public function approve(int $id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'active']);

        University::findByName($user->university_name)
            ?->update(['is_on_educhain' => true]);

        // Mail::to($user->email)->send(new UniversityApproved($user));
        ActivityLogger::record(auth()->id(), 'university_approved', 'Approved: '.$user->university_name);

        return back()->with('success', $user->university_name . ' approved.');
    }

    public function blacklist(int $id)
    {
        $uni = University::findOrFail($id);
        $uni->update(['is_blacklisted' => true]);
        ActivityLogger::record(auth()->id(), 'university_blacklisted', 'Blacklisted: '.$uni->name);
        return back()->with('success', $uni->name . ' blacklisted.');
    }

    public function unblacklist(int $id)
    {
        University::findOrFail($id)->update(['is_blacklisted' => false]);
        return back()->with('success', 'University removed from blacklist.');
    }

    public function users()
    {
        $users = User::latest()->paginate(25);
        return view('admin.users', compact('users'));
    }

    public function suspend(int $id)
    {
        User::findOrFail($id)->update(['status' => 'suspended']);
        ActivityLogger::record(auth()->id(), 'user_suspended', 'Suspended user ID '.$id);
        return back()->with('success', 'User suspended.');
    }

    public function activate(int $id)
    {
        User::findOrFail($id)->update(['status' => 'active']);
        return back()->with('success', 'User activated.');
    }

    public function universities()
    {
        $universities = University::latest()->paginate(25);
        return view('admin.universities', compact('universities'));
    }

    public function verifications()
    {
        $verifications = Verification::with('user')->latest()->paginate(25);
        return view('admin.verifications', compact('verifications'));
    }

    public function fraud()
    {
        $alerts = FraudAlert::orderByDesc('search_count')->paginate(25);
        return view('admin.fraud', compact('alerts'));
    }

    public function revoke(int $id)
    {
        IssuedDegree::findOrFail($id)->update(['is_revoked' => true]);
        ActivityLogger::record(auth()->id(), 'degree_revoked', 'Revoked degree ID '.$id);
        return back()->with('success', 'Degree revoked.');
    }

    public function licenses()
    {
        $licenses = \App\Models\ProfessionalLicense::latest()->paginate(25);
        return view('admin.licenses', compact('licenses'));
    }
}
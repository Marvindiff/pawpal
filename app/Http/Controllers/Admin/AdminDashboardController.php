<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Report;

class AdminDashboardController extends Controller
{
    // ===============================
    // 🏠 DASHBOARD
    // ===============================
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();

        $totalProviders = User::where('role', 'provider')->count();

        $pendingProviders = User::where('role', 'provider')
            ->where('is_approved', 0)
            ->count();

        $approvedProviders = User::where('role', 'provider')
            ->where('is_approved', 1)
            ->count();

        // ⭐ TOP PROVIDERS
        $topProviders = User::where('role', 'provider')
            ->where('is_approved', 1)
            ->get()
            ->map(function ($provider) {

                $reviews = Review::where('provider_id', $provider->id)->get();

                $provider->average_rating = $reviews->count() > 0
                    ? round($reviews->avg('rating'), 1)
                    : 0;

                $provider->total_reviews = $reviews->count();

                return $provider;
            })
            ->sortByDesc('average_rating')
            ->take(5);

        // 🚨 REPORT STATS
        $totalReports = Report::count();
        $pendingReports = Report::where('status','pending')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProviders',
            'pendingProviders',
            'approvedProviders',
            'topProviders',
            'totalReports',
            'pendingReports'
        ));
    }

    // ===============================
    // 🔁 OPTIONAL INDEX (SAME AS DASHBOARD)
    // ===============================
    public function index()
    {
        return $this->dashboard(); // cleaner, avoids duplicate code
    }

    // ===============================
    // 🚨 REPORTS PAGE
    // ===============================
    public function reports()
    {
        $reports = Report::with(['reporter','reported','booking'])
                    ->latest()
                    ->paginate(10);

        return view('admin.reports.index', compact('reports'));
    }

    // ===============================
    // 🔄 UPDATE REPORT
    // ===============================
    public function updateReport(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $report->update([
            'status' => $request->status,
            'severity' => $request->severity,
            'admin_note' => $request->admin_note
        ]);

        // 🔥 CORRECT AUTO BAN SYSTEM
        $count = Report::where('reported_id', $report->reported_id)->count();

        if($count >= 5){
            User::where('id', $report->reported_id)
                ->update(['status' => 'banned']);
        }

        return back()->with('success','Report updated');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\Notification;


class ReportController extends Controller
{
    // USER: submit report
    public function store(Request $request)
{
    $request->validate([
        'reported_id' => 'required|exists:users,id',
        'reason' => 'required',
        'description' => 'required'
    ]);

    Report::create([
        'booking_id' => $request->booking_id,
        'user_id' => auth()->id(), // ✅ FIXED
        'reported_id' => $request->reported_id,
        'reason' => $request->reason,
        'description' => $request->description,
    ]);

    return back()->with('success','Report submitted');
}

    // ADMIN: view all reports
    public function index()
    {
        $reports = Report::with(['reporter','reported','booking'])
                    ->latest()
                    ->paginate(10);

        return view('admin.reports.index', compact('reports'));
    }

    // ADMIN: update report
    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $report->update([
            'status' => $request->status,
            'severity' => $request->severity,
            'admin_note' => $request->admin_note
        ]);

        // 🔥 AUTO ACTION SYSTEM
        $count = Report::where('reported_id', $report->reported_id)->count();

        if($count >= 5){
            User::where('id', $report->reported_id)
                ->update(['status' => 'banned']);
        }

        return back()->with('success','Report updated');
    }
}
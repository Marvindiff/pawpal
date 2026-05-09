<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // 👥 SHOW ALL USERS (MANAGE USERS)
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users', compact('users'));
    }

    // 🐾 SHOW PENDING SITTER/WALKER REQUESTS
    public function sitterVerifications()
    {
        $sitters = User::whereIn('role', ['sitter', 'walker'])
                        ->where('status', 'pending')
                        ->get();

        return view('admin.sitter-verifications', compact('sitters'));
    }

    // ✅ APPROVE USER
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        return back()->with('success', 'User approved successfully.');
    }

    // ❌ REJECT USER
    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();

        return back()->with('success', 'User rejected.');
    }

public function pendingProviders()
{
    dd('CONTROLLER HIT'); // 🔥
}

public function ban($id)
{
    $user = User::findOrFail($id);
    $user->status = 'banned';
    $user->save();

    return back()->with('success', 'User banned.');
}

// 🔓 UNBAN USER
public function unban($id)
{
    $user = User::findOrFail($id);
    $user->status = 'approved';
    $user->save();

    return back()->with('success', 'User unbanned.');
}

// 🗑 DELETE USER
public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return back()->with('success', 'User deleted.');
}

public function addPenalty($id)
{
    $user = User::findOrFail($id);

    $user->penalty = ($user->penalty ?? 0) + 1;

    // 🚫 AUTO BAN AT 3
    if ($user->penalty >= 3) {
        $user->status = 'banned';
    }

    $user->save();

    return back()->with('success', 'Penalty added.');
}
public function edit($id)
{
    $user = \App\Models\User::findOrFail($id);

    return view('admin.edit-user', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->name = $request->name;
    $user->email = $request->email;

    // 🔥 UPDATE PENALTY
    $user->penalty = $request->penalty;

    // 🔥 AUTO BAN LOGIC
    if ($user->penalty >= 3) {
        $user->status = 'banned';
    } else {
        // optional: restore if lowered
        $user->status = 'approved';
    }

    $user->save();

    return redirect()->route('admin.users')
        ->with('success', 'User updated successfully.');
}
}
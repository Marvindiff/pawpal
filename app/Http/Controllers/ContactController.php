<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // STORE MESSAGE
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ]);

    \App\Models\ContactMessage::create([
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
    ]);

    return back()->with('success', 'Message sent!');
}

    // ADMIN VIEW
    public function index()
{
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        return redirect('/dashboard')->with('error', 'Unauthorized');
    }

    $messages = ContactMessage::latest()->get();

    return view('admin.messages', compact('messages'));
}

public function reply(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'reply' => 'required'
    ]);

    // 📧 Send email
    Mail::raw($request->reply, function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Reply from PawPal Admin');
    });

    return back()->with('success', 'Reply sent successfully!');
}
}
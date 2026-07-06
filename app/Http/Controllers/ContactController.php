<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        Mail::to('diyacollection97@gmail.com')->send(new ContactMail($validated));

        return redirect()->route('contact')->with('success', 'Thank you! Your message has been sent. We\'ll get back to you shortly.');
    }

    public function adminIndex()
    {
        $messages = ContactMessage::latest()->paginate(20);

        return view('admin.contact.index', compact('messages'));
    }

    public function markRead(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);

        return back()->with('success', 'Message marked as read.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return back()->with('success', 'Message deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function show()
    {
        return view('store.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::send('emails.contact', $validated, function ($m) use ($validated) {
            $m->to(config('mail.from.address'))
              ->subject('Contact Form: ' . $validated['subject']);
        });

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact page.
     */
    public function showContact()
    {
        return view('user_views.contact');
    }

    /**
     * Handle contact form submission.
     */
    public function submitContact(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'number' => 'required|numeric|digits_between:1,10',
            'email' => 'required|email|max:50',
            'msg' => 'required|max:500',
        ]);

        // Process the validated data (e.g., save to database, send email, etc.)

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function homePage()
    {
        return view("home");
    }
    public function aboutPage()
    {
        return view("about");
    }

    public function contactPage()
    {
        return view("contact");
    }
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'message' => 'required|string|min:10',
        ]);

        // Process the contact form (e.g., send email)
        return back()->with('success', 'Message sent successfully!');
    }

    public function hero()
    {
        return view("hero");
    }
}

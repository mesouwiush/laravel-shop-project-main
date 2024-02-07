<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmail()
    {
        Mail::to('example@example.com')->send(new TestEmail());

        return back()->with('success', 'Email sent successfully!');
    }
}

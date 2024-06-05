<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $details = [
            'fullName' => $request->fullName,
        ];

        Mail::to($request->email)->send(new SendMail($details));

        return response()->json(['message' => 'Email sent successfully']);
    }
}

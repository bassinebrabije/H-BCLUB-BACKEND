<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
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
    public function sendAdminEmail(Request $request)
    {
        \Log::info('sendAdminEmail called', $request->all());

        try {
            $details = [
                'fname' => $request->fname,
                'lname' => $request->lname,
                'username' => $request->username,
                'password' => $request->password,
            ];
            Mail::to($request->email)->send(new AdminMail($details));
            \Log::info('Email sent successfully');
            return response()->json(['message' => 'Email sent successfully']);
        } catch (\Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
            return response()->json(['message' => 'Email sending failed', 'error' => $e->getMessage()], 500);
        }
    }

}

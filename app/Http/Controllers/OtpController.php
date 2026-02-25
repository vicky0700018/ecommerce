<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    // OTP form
    public function showOtpForm()
    {
        return view('auth.otp');
    }

    // OTP generate & send
    public function sendOtp()
    {
        $otp = rand(1000, 9999);

        Otp::updateOrCreate(
            ['user_id' => Auth::id()],
            ['otp' => $otp]
        );

    
        if (config('app.env') === 'production') {
            Mail::raw("Your OTP code is: $otp", function ($message) {
                $message->to(Auth::user()->email)
                        ->subject('Your Login OTP');
            });
        }

        // Development mode में OTP दिखाएं
        $message = config('app.env') === 'local' 
            ? "✅ OTP: $otp (Development Mode)"
            : 'OTP sent to your email';

        return redirect()->route('otp.form')->with('success', $message);
    }

    // OTP verify
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $record = Otp::where('user_id', Auth::id())
                     ->where('otp', $request->otp)
                     ->first();

        if ($record) {
            $record->delete(); // one-time OTP
            session(['otp_verified' => true]);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['otp' => 'Invalid OTP']);
    }
}

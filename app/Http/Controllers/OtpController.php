<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function showOtpForm()
    {
        return view('auth.otp');
    }

    public function sendOtp()
    {
        $user = Auth::user();
        $otp = rand(1000, 9999);

        Otp::updateOrCreate(
            ['user_id' => $user->id],
            ['otp' => $otp]
        );

        Mail::raw("Your OTP code is: {$otp}", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Your Login OTP');
        });

        return redirect()
            ->route('otp.form')
            ->with('success', 'OTP sent to your email address.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $record = Otp::where('user_id', Auth::id())
            ->where('otp', $request->otp)
            ->first();

        if ($record) {
            $record->delete();
            session(['otp_verified' => true]);

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['otp' => 'Invalid OTP']);
    }
}

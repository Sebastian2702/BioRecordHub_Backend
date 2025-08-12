<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use \App\Models\User;

class ProfilePasswordController extends Controller
{
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['status' => 'password-updated']);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
        ]);

        $user = Auth::user();
        $user->update([
            'email' => $request->email,
        ]);

        return response()->json(['status' => 'email-updated']);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'reset_password_token' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Log::info('Password reset request for email: ' . $request->email);

        $user = User::where('email', $request->email)->first();
        if ($user->email !== $request->email) {
            return response()->json(['error' => 'Email does not match'], 422);
        }
        if ($user->reset_password_token !== $request->reset_password_token) {
            return response()->json(['error' => 'Invalid reset token'], 422);
        }
        $user->update([
            'password' => Hash::make($request->password),
            'reset_password_token' => $user->name . uniqid(),
            'first_login' => true,
        ]);

        return response()->json(['status' => 'password-updated']);

    }

    public function resetPasswordToken(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = Auth::user();
        if ($user->email !== $request->email) {
            return response()->json(['error' => 'Email does not match'], 422);
        }

        $user->update([
            'reset_password_token' => $user->name . uniqid(),
        ]);

        Log::info('Reset password token updated for user: ' . $user->email);

        return response()->json(['status' => 'reset-token-updated']);
    }

    public function firstLogin(Request $request)
    {
        $user = Auth::user();
        if ($user->first_login) {
            $user->update(['first_login' => false]);
            return response()->json(['status' => 'first-login']);
        }
        return response()->json(['status' => 'not-first-login']);
    }
}

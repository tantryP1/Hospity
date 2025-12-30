<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Reset link sent successfully']);
        } else {
            return response()->json(['error' => 'Error sending reset link'], 400);
        }
    }

    public function resetPassword(Request $request)
    {
        $credentials = $request->only('token', 'email', 'password', 'password_confirmation');

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });

        if ($response == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successfully']);
        }

        return response()->json(['error' => 'Error resetting password'], 400);

    }
}

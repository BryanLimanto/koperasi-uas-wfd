<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loginStaff(Request $request)
    {
        $identifier = $request->input('identifier');

        if (!$identifier) {
            return response()->json(['error' => 'No identifier provided'], 400);
        }

        // Determine if input is an email
        $isEmail = filter_var($identifier, FILTER_VALIDATE_EMAIL);

        // Fetch user by email or username
        $user = $isEmail
            ? Staff::where('email', $identifier)->first()
            : Staff::where('username', $identifier)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'email' => $user->email,
        ]);
    }

    public function loginMember(Request $request)
    {
        $identifier = $request->input('identifier');

        if (!$identifier) {
            return response()->json(['error' => 'No identifier provided'], 400);
        }

        // Determine if input is an email
        $isEmail = filter_var($identifier, FILTER_VALIDATE_EMAIL);

        // Fetch user by email or username
        $user = $isEmail
            ? Member::where('email', $identifier)->first()
            : Member::where('username', $identifier)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (!$user->is_active) {
            return response()->json(['error' => 'Account is inactive'], 403);
        }

        return response()->json([
            'email' => $user->email,
        ]);
    }
}

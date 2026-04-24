<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return response()->json(['status' => 'success', 'message' => 'Please authenticate']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('admin')->attempt(array_merge($credentials, ['deleted_at' => null]), $request->filled('remember'))) {
            $request->session()->regenerate();
            $admin = Auth::guard('admin')->user();
            return response()->json(['status' => 'success', 'message' => 'Login successful', 'data' => $admin]);
        }

        return response()->json(['status' => 'error', 'message' => 'The provided credentials do not match our records.'], 401);
    }

    public function showRegister()
    {
        return response()->json(['status' => 'success', 'message' => 'Ready for registration']); 
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Registration successful! Please login.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['status' => 'success', 'message' => 'Logged out successfully']);
    }

    public function showUpdatePassword()
    {
        return response()->json(['status' => 'success', 'message' => 'Ready to update password']);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return response()->json(['status' => 'error', 'message' => 'Current password does not match.'], 400);
        }

        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Password updated successfully!']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PassengerAuthController extends Controller
{
    /**
     * Register a new passenger via Mobile App
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|stringt|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:passengers',
            'phone' => 'required|string|max:20|unique:passengers',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'nullable|string|in:Male,Female,Other',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $passenger = Passenger::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'status' => 'Active'
        ]);

        $token = $passenger->createToken('passenger_auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Passenger registered successfully',
            'data' => [
                'user' => $passenger,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ], 201);
    }

    /**
     * Login passenger via Mobile App
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $passenger = Passenger::where('email', $request->email)->first();

        if (!$passenger || !Hash::check($request->password, $passenger->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        if ($passenger->status !== 'Active') {
            return response()->json([
                'status' => 'error',
                'message' => 'Your account is ' . $passenger->status
            ], 403);
        }

        // Revoke previous tokens to keep it clean (Optional)
        $passenger->tokens()->delete();

        $token = $passenger->createToken('passenger_auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'user' => $passenger,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ]);
    }

    /**
     * Get authenticated passenger profile
     */
    public function profile(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $request->user()
        ]);
    }

    /**
     * Update passenger profile
     */
    public function updateProfile(Request $request, $id = null)
    {
        $passenger = $request->user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:passengers,email,' . $passenger->id,
            'phone' => 'required|string|max:20|unique:passengers,phone,' . $passenger->id,
            'gender' => 'nullable|string|in:Male,Female,Other',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['first_name', 'last_name', 'email', 'phone', 'gender']);

        // Handle Avatar Upload if provided
        if ($request->hasFile('avatar')) {
             if ($passenger->avatar) {
                Storage::disk('public')->delete($passenger->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('passengers/avatars', 'public');
        }

        // Force persistent update
        $passenger->update($data);
        $passenger->save(); // Senior standard: ensure persistence call

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => $passenger->fresh()
        ]);
    }

    /**
     * Update passenger password
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $passenger = $request->user();

        if (!Hash::check($request->current_password, $passenger->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Current password does not match'
            ], 401);
        }

        $passenger->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully'
        ]);
    }

    /**
     * Toggle the status of the passenger (Block/Unblock) via API
     */
    public function toggleStatus(Request $request, $id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->status = ($passenger->status == 'Active') ? 'inactive' : 'Active';
        $passenger->save();

        // Optional: Revoke tokens if blocked
        if ($passenger->status !== 'Active') {
            $passenger->tokens()->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Passenger status updated to ' . $passenger->status,
            'data' => $passenger
        ]);
    }

    /**
     * Remove the passenger via API
     */
    public function destroy(Request $request, $id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->tokens()->delete();
        $passenger->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Passenger deleted successfully'
        ]);
    }

    /**
     * Logout passenger
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }
}

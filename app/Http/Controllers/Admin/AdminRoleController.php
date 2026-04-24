<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the admins.
     */
    public function index()
    {
        $admins = Admin::latest()->get();
        return response()->json(['status' => 'success', 'data' => $admins]);
    }

    /**
     * Show the form for creating a new admin.
     */
    public function create()
    {
        return response()->json(['status' => 'success', 'data' => []]);
    }

    /**
     * Store a newly created admin in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'phone' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'modules' => 'nullable|array',
            'created_at' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        $modules = $request->modules ?? [];
        // Senior Engineering Tip: Always ensure Dashboard is available as a fallback
        if (!in_array('Dashboard', $modules)) {
            $modules[] = 'Dashboard';
        }

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'modules' => $request->has('is_super') ? [] : $modules,
            'is_super' => $request->has('is_super'),
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Admin created and invited successfully.']);
    }

    /**
     * Show the form for editing the specified admin.
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $admin]);
    }

    /**
     * Update the specified admin in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'phone' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'modules' => 'nullable|array',
            'updated_at' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => $request->updated_at,
        ];

        // Safety Catch: If editing self, do not allow changing own is_super status
        // This prevents the "2nd click 403 error" by ensuring session remains consistent
        if (auth()->guard('admin')->user()->id == $id) {
            $data['is_super'] = $admin->is_super; 
        } else {
            $data['is_super'] = $request->has('is_super');
        }

        $modules = $request->modules ?? [];
        if (!in_array('Dashboard', $modules)) {
            $modules[] = 'Dashboard';
        }

        $data['modules'] = $data['is_super'] ? [] : $modules;

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return response()->json(['status' => 'success', 'message' => 'Admin updated successfully.']);
    }

    /**
     * Remove the specified admin from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Security check: Don't allow deleting yourself
        if (auth()->guard('admin')->id() == $id) {
            return response()->json(['status' => 'error', 'message' => 'You cannot delete your own account.'], 403);
        }

        if ($request->isMethod('get')) {
             return response()->json(['status' => 'error', 'message' => 'Direct GET deletion is now deprecated for security.'], 405);
        }

        $admin = Admin::findOrFail($id);
        
        // Manual Soft Delete using frontend provided timestamp
        $admin->update([
            'deleted_at' => $request->deleted_at ?? now()
        ]);

        return response()->json(['status' => 'success', 'message' => 'Admin deleted successfully.']);
    }
}

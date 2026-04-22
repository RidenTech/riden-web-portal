<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminRoleApiController extends Controller
{
    /**
     * List all admin users with their roles
     */
    public function index()
    {
        $admins = Admin::all();
        return response()->json([
            'status' => 'success',
            'data' => $admins
        ]);
    }

    /**
     * Create new admin user
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
            'modules' => 'required|array',
            'is_super' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'modules' => $request->modules,
            'is_super' => $request->is_super ?? false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Admin created successfully',
            'data' => $admin
        ]);
    }

    /**
     * Update existing admin
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:admins,email,' . $id,
            'modules' => 'sometimes|array',
            'is_super' => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $admin->update($request->only(['name', 'email', 'modules', 'is_super']));

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
            $admin->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Admin updated successfully',
            'data' => $admin
        ]);
    }

    /**
     * Delete Admin
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        
        if ($admin->is_super) {
            return response()->json(['status' => 'error', 'message' => 'Super admin cannot be deleted'], 403);
        }

        $admin->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Admin deleted successfully'
        ]);
    }
}

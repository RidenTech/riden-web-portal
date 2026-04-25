<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * List all vehicles
     */
    public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('model', 'like', "%{$search}%")
                  ->orWhere('license_plate', 'like', "%{$search}%");
        }

        $vehicles = $query->latest()->paginate($request->get('per_page', 10));

        return response()->json([
            'status' => 'success',
            'data' => $vehicles
        ]);
    }

    /**
     * Store new vehicle
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'model' => 'required|string|max:255',
            'vehicle_type' => 'required|string',
            'license_plate' => 'required|string|unique:vehicles',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();

        if ($request->hasFile('front_image')) {
            $data['front_image'] = $request->file('front_image')->store('vehicles', 'public');
        }
        if ($request->hasFile('back_image')) {
            $data['back_image'] = $request->file('back_image')->store('vehicles', 'public');
        }

        $vehicle = Vehicle::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle created successfully',
            'data' => $vehicle
        ], 201);
    }

    /**
     * Show vehicle detail
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['status' => 'error', 'message' => 'Vehicle not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $vehicle
        ]);
    }

    /**
     * Update Vehicle
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'model' => 'sometimes|string|max:255',
            'vehicle_type' => 'sometimes|string',
            'license_plate' => 'sometimes|string|unique:vehicles,license_plate,' . $id,
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();

        if ($request->hasFile('front_image')) {
            if ($vehicle->front_image) Storage::disk('public')->delete($vehicle->front_image);
            $data['front_image'] = $request->file('front_image')->store('vehicles', 'public');
        }
        if ($request->hasFile('back_image')) {
            if ($vehicle->back_image) Storage::disk('public')->delete($vehicle->back_image);
            $data['back_image'] = $request->file('back_image')->store('vehicles', 'public');
        }

        $vehicle->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle updated successfully',
            'data' => $vehicle
        ]);
    }

    /**
     * Delete Vehicle
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        // Cleanup images
        if ($vehicle->front_image) Storage::disk('public')->delete($vehicle->front_image);
        if ($vehicle->back_image) Storage::disk('public')->delete($vehicle->back_image);
        
        $vehicle->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle deleted successfully'
        ]);
    }
}


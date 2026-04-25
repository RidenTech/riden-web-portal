<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('driver')->paginate(10);
        return view('admin.vehicle.index', compact('vehicles'));
    }

    public function create()
    {
        $drivers = Driver::all();
        return view('admin.vehicle.create', compact('drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'model' => 'required|string|max:255',
            'year' => 'required|numeric|min:1900|max:'.(date('Y')+1),
            'license_plate' => 'required|string|unique:vehicles,license_plate|max:20',
            'vehicle_type' => 'required|string',
            'no_of_seats' => 'required|numeric|min:1|max:50',
            'color' => 'nullable|string|max:50',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        // Handle Front Image Upload
        if ($request->hasFile('front_image')) {
            $frontFileName = time() . '_front.' . $request->front_image->extension();
            $request->front_image->move(public_path('uploads/vehicles'), $frontFileName);
            $data['front_image'] = $frontFileName;
        }

        // Handle Back Image Upload
        if ($request->hasFile('back_image')) {
            $backFileName = time() . '_back.' . $request->back_image->extension();
            $request->back_image->move(public_path('uploads/vehicles'), $backFileName);
            $data['back_image'] = $backFileName;
        }

        Vehicle::create($data);

        return redirect()->route('admin.vehicle.management')->with('status', 'Vehicle added successfully with images!');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $drivers = Driver::all();
        return view('admin.vehicle.edit', compact('vehicle', 'drivers'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'model' => 'required|string|max:255',
            'year' => 'required|numeric|min:1900|max:'.(date('Y')+1),
            'license_plate' => 'required|string|max:20|unique:vehicles,license_plate,'.$vehicle->id,
            'vehicle_type' => 'required|string',
            'no_of_seats' => 'required|numeric|min:1|max:50',
            'color' => 'nullable|string|max:50',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['front_image', 'back_image']);

        // Update Front Image
        if ($request->hasFile('front_image')) {
            if ($vehicle->front_image && file_exists(public_path('uploads/vehicles/' . $vehicle->front_image))) {
                unlink(public_path('uploads/vehicles/' . $vehicle->front_image));
            }
            $frontFileName = time() . '_front.' . $request->front_image->extension();
            $request->front_image->move(public_path('uploads/vehicles'), $frontFileName);
            $data['front_image'] = $frontFileName;
        }

        // Update Back Image
        if ($request->hasFile('back_image')) {
            if ($vehicle->back_image && file_exists(public_path('uploads/vehicles/' . $vehicle->back_image))) {
                unlink(public_path('uploads/vehicles/' . $vehicle->back_image));
            }
            $backFileName = time() . '_back.' . $request->back_image->extension();
            $request->back_image->move(public_path('uploads/vehicles'), $backFileName);
            $data['back_image'] = $backFileName;
        }

        $vehicle->update($data);

        return redirect()->route('admin.vehicle.management')->with('status', 'Vehicle updated successfully!');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        // Cleanup Images
        if ($vehicle->front_image && file_exists(public_path('uploads/vehicles/' . $vehicle->front_image))) {
            unlink(public_path('uploads/vehicles/' . $vehicle->front_image));
        }
        if ($vehicle->back_image && file_exists(public_path('uploads/vehicles/' . $vehicle->back_image))) {
            unlink(public_path('uploads/vehicles/' . $vehicle->back_image));
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicle.management')->with('status', 'Vehicle deleted successfully!');
    }
}

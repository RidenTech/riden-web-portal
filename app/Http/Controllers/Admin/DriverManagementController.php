<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\DriverDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DriverManagementController extends Controller
{
    public function index()
    {
        $drivers = Driver::where('status', '!=', 'Requested')->latest()->paginate(10);
        return view('admin.drivers.directory', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female,Other',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // Vehicle
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'color' => 'required|string|max:50',
            'license_plate' => 'required|string|unique:vehicles,license_plate',
            // Documents
            'documents.*' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:5120',
            'doc_names.*' => 'nullable|string|max:255',
        ]);

        // 1. Save Driver
        $driverData = $request->only(['first_name', 'last_name', 'email', 'phone', 'gender']);
        $driverData['unique_id'] = '#' . rand(10000, 99999);
        $driverData['status'] = 'Active';

        if ($request->hasFile('avatar')) {
            $driverData['avatar'] = $request->file('avatar')->store('drivers/avatars', 'public');
        }

        $driver = Driver::create($driverData);

        // 2. Save Vehicle
        Vehicle::create([
            'driver_id' => $driver->id,
            'model' => $request->model,
            'year' => $request->year,
            'color' => $request->color,
            'license_plate' => $request->license_plate,
            'vehicle_type' => $request->vehicle_type ?? 'Sedan',
        ]);

        // 3. Save Documents
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $index => $file) {
                if ($file->isValid()) {
                    $path = $file->store('drivers/documents', 'public');
                    DriverDocument::create([
                        'driver_id' => $driver->id,
                        'document_name' => $request->doc_names[$index] ?? 'Document ' . ($index + 1),
                        'file_path' => $path,
                        'status' => 'Pending'
                    ]);
                }
            }
        }

        return redirect()->route('admin.drivers.directory')
            ->with('status', 'Driver registered successfully with vehicle and documents.');
    }

    public function show($id)
    {
        $driver = Driver::with(['vehicle', 'documents'])->findOrFail($id);
        return view('admin.drivers.view', compact('driver'));
    }

    public function toggleStatus(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);
        $newStatus = $request->status;
        
        if (!in_array($newStatus, ['Active', 'Blocked', 'Suspended'])) {
            return back()->with('statusDanger', 'Invalid status selected.');
        }

        $driver->update(['status' => $newStatus]);

        return back()->with('status', 'Driver status updated to ' . $newStatus);
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return redirect()->route('admin.drivers.directory')
            ->with('status', 'Driver moved to trash.');
    }

    public function edit($id)
    {
        $driver = Driver::with(['vehicle', 'documents'])->findOrFail($id);
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);
        $vehicle = $driver->vehicle;

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email,' . $id,
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female,Other',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // Vehicle
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'color' => 'required|string|max:50',
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . ($vehicle ? $vehicle->id : 'NULL'),
            // New Documents
            'documents.*' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:5120',
            'doc_names.*' => 'nullable|string|max:255',
        ]);

        // 1. Update Driver
        $driverData = $request->only(['first_name', 'last_name', 'email', 'phone', 'gender']);
        
        if ($request->hasFile('avatar')) {
            if ($driver->avatar) {
                Storage::disk('public')->delete($driver->avatar);
            }
            $driverData['avatar'] = $request->file('avatar')->store('drivers/avatars', 'public');
        }

        $driver->update($driverData);

        // 2. Handle Deleted Documents
        if ($request->filled('deleted_documents')) {
            $deletedIds = explode(',', $request->deleted_documents);
            $docsToDelete = DriverDocument::whereIn('id', $deletedIds)->where('driver_id', $driver->id)->get();
            
            foreach ($docsToDelete as $doc) {
                if ($doc->file_path) {
                    Storage::disk('public')->delete($doc->file_path);
                }
                $doc->delete();
            }
        }

        // 3. Update/Create Vehicle
        $vehicleData = [
            'model' => $request->model,
            'year' => $request->year,
            'color' => $request->color,
            'license_plate' => $request->license_plate,
            'vehicle_type' => $request->vehicle_type ?? 'Sedan',
        ];

        if ($vehicle) {
            $vehicle->update($vehicleData);
        } else {
            $vehicleData['driver_id'] = $driver->id;
            Vehicle::create($vehicleData);
        }

        // 3. Save New Documents
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $index => $file) {
                if ($file->isValid()) {
                    $path = $file->store('drivers/documents', 'public');
                    DriverDocument::create([
                        'driver_id' => $driver->id,
                        'document_name' => $request->doc_names[$index] ?? 'Document ' . ($index + 1),
                        'file_path' => $path,
                        'status' => 'Pending'
                    ]);
                }
            }
        }

        return redirect()->route('admin.drivers.view', $driver->id)
            ->with('status', 'Driver records and documents updated successfully.');
    }
}

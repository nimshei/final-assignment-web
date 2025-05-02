<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Accident;
use App\Models\Officer;
use App\Models\Vehicle;

class AccidentController extends Controller
{

    public function getAccidents(Request $request)
    {
        $query = Accident::with(['officer', 'vehicles'])
            ->addSelect(['plate_numbers' => Vehicle::selectRaw('GROUP_CONCAT(plate_number SEPARATOR ", ")')
                ->join('accident_vehicle', 'vehicles.id', '=', 'accident_vehicle.vehicle_id')
                ->whereColumn('accident_vehicle.accident_id', 'accidents.id')
                ->groupBy('accident_vehicle.accident_id')
            ]);

        if (!empty($request->input('selectedSeverity'))) {
            $query->where('severity', $request->input('selectedSeverity'));
        }

        if (!empty($request->input('selectedStatus'))) {
            $query->where('status', $request->input('selectedStatus'));
        }

        if (!empty($request->input('searchLocation'))) {
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('location', 'like', '%' . $request->input('searchLocation') . '%')
                    ->orWhereHas('vehicles', function ($vehicleQuery) use ($request) {
                        $vehicleQuery->where('plate_number', 'like', '%' . $request->input('searchLocation') . '%');
                    })
                    ->orWhereHas('officer', function ($officerQuery) use ($request) {
                        $officerQuery->where('name', 'like', '%' . $request->input('searchLocation') . '%');
                    });
            });
        }

        if (!empty($request->input('accidentDate'))) {
            $query->whereDate('accident_date_time', $request->input('accidentDate'));
        }

        $accidents = $query->get();
        $officers = Officer::all();

        return response()->json(compact('accidents', 'officers'));
    }


    public function createAccident(Request $request)
    {
        $request->merge([
            'injuries' => is_numeric($request->input('injuries')) ? (int) $request->input('injuries') : null,
            'fatalities' => is_numeric($request->input('fatalities')) ? (int) $request->input('fatalities') : null,
            'property_damage' => is_numeric($request->input('property_damage')) ? (float) $request->input('property_damage') : null,
        ]);

        $validatedData = $request->validate([
            'officer_id' => 'required|exists:officers,id',
            'accident_date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'severity' => 'required|string',
            'injuries' => 'nullable|integer|min:0',
            'fatalities' => 'nullable|integer|min:0',
            'property_damage' => 'nullable|numeric|min:0',
            'status' => 'required|string',
            'notes' => 'nullable|string',
            'vehicles' => 'required|array',
            'vehicles.*' => 'exists:vehicles,id',
        ]);

        // Create the accident record
        $accident = Accident::create([
            'officer_id' => $validatedData['officer_id'],
            'accident_date_time' => $validatedData['accident_date_time'],
            'location' => $validatedData['location'],
            'description' => $validatedData['description'],
            'severity' => $validatedData['severity'],
            'injuries' => $validatedData['injuries'],
            'fatalities' => $validatedData['fatalities'],
            'property_damage' => $validatedData['property_damage'],
            'status' => $validatedData['status'],
            'notes' => $validatedData['notes'],
        ]);

        // Attach vehicles to the accident using the pivot table
        foreach ($validatedData['vehicles'] as $vehicleId) {
            \DB::table('accident_vehicle')->insert([
                'accident_id' => $accident->id,
                'vehicle_id' => $vehicleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Accident created successfully!',
            'accident' => $accident,
        ], 201);
    }
    
}

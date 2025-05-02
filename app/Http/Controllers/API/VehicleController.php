<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function getVehicles(Request $request)
    {
        $query = Vehicle::query()->with(['revenueLicenses' => function ($q) use ($request) {

            if ($request->has('minFee') && $request->input('minFee')) {
                $q->where('fee_paid', '>=', $request->input('minFee'));
            }
            if ($request->has('issueDate') && $request->input('issueDate')) {
                $q->whereDate('issue_date', '=', $request->input('issueDate'));
            }
            if ($request->has('expiryDate') && $request->input('expiryDate')) {
                $q->whereDate('expiry_date', '=', $request->input('expiryDate'));
            }
        }]);
    
        if ($request->has('search') && $request->input('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('plate_number', 'like', '%' . $search . '%')
                    ->orWhere('make', 'like', '%' . $search . '%')
                    ->orWhere('model', 'like', '%' . $search . '%')
                    ->orWhere('owner_name', 'like', '%' . $search . '%')
                    ->orWhere('owner_nic', 'like', '%' . $search . '%');
            });
        }
    
        // Vehicle type filter
        if ($request->has('selectedVehicleType') && $request->input('selectedVehicleType')) {
            $query->where('vehicle_type', $request->input('selectedVehicleType'));
        }
    
        // Year of manufacture filter
        if ($request->has('selectedYearOfManufacture') && $request->input('selectedYearOfManufacture')) {
            $query->whereYear('year_of_manufacture', $request->input('selectedYearOfManufacture'));
        }
    
        $vehicles = $query->get();
        $vehicleTypes = Vehicle::distinct('vehicle_type')->pluck('vehicle_type')->filter();
    
        Log::info('getVehicles called, vehicles count: ' . $vehicles->count());
    
        return response()->json([
            'vehicles' => $vehicles,
            'vehicleTypes' => $vehicleTypes,
        ]);
    }
}

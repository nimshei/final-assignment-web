<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offence;

class OffenceController extends Controller
{
    public function getOffences(Request $request)
    {
        $query = Offence::with(['license', 'officer', 'vehicle', 'violation']);

        if ($request->has('selectedStatus')) {
            $query->where('status', $request->input('selectedStatus'));
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('location', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhereHas('license', function ($q) use ($search) {
                      $q->where('license_number', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('officer', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        }

        if ($request->has('date')) {
            $query->whereDate('date_time', $request->input('date'));
        }

        $offences = $query->get();

        return response()->json([
            'offences' => $offences,
            'statuses' => ['Pending', 'Warning', 'Paid', 'Court']
        ]);
    }

    public function createOffence(Request $request)
    {
        $validatedData = $request->validate([
            'license_id' => 'required|exists:licenses,id',
            'officer_id' => 'required|exists:officers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'violation_id' => 'required|exists:violations,id',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fine_amount' => 'required|numeric',
            'court_date' => 'nullable|date',
            'deadline' => 'nullable|date',
            // 'status' => 'required|string|in:Pending,Warning,Paid,Court',
        ]);

        $offence = Offence::create($validatedData);

        return response()->json([
            'message' => 'Offence added successfully!',
            'offence' => $offence,
        ], 201);
    }

}

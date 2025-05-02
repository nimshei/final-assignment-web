<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\License;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LicenseController extends Controller
{

    public function toggleActiveStatus($licenseId)
    {
        Log::info('toggleActiveStatus called with licenseId: ' . $licenseId);
        $license = License::find($licenseId);

        if ($license) {
            $license->active_status = !$license->active_status;
            $license->save();

            return response()->json([
                'message' => 'License ' . ($license->active_status ? 'activated' : 'deactivated') . ' successfully!',
            ], 200);
        } else {
            Log::warning('License not found in toggleActiveStatus for licenseId: ' . $licenseId);
            return response()->json(['message' => 'License not found!'], 404);
        }
    }

    public function getLicenses(Request $request)
    {
        $query = License::with('user');

        if ($request->has('selectedUser')) {
            $query->where('user_id', $request->selectedUser);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('user', function ($userQuery) use ($request) {
                    $userQuery->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhere('license_number', 'like', '%' . $request->search . '%')
                ->orWhere('id_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('expiryDate')) {
            $query->whereDate('expiry_date', $request->expiryDate);
        }

        if ($request->has('selectedLicenseType')) {
            $query->where('id_type', $request->selectedLicenseType);
        }

        if ($request->has('selectedActiveStatus')) {
            $query->where('active_status', $request->selectedActiveStatus);
        }

        $licenses = $query->paginate(10);
        $users = User::all();
        $licenseTypes = License::distinct()->pluck('id_type')->filter();

        $penaltiesPerLicense = \DB::table('offences')
            ->join('violations', 'offences.violation_id', '=', 'violations.id')
            ->select('offences.license_id', \DB::raw('SUM(violations.penalty) as total_penalty'))
            ->groupBy('offences.license_id')
            ->pluck('total_penalty', 'offences.license_id');

        foreach ($licenses as $license) {
            $license->total_penalty = $penaltiesPerLicense->get($license->id, 0);
        }

        return response()->json(compact('licenses', 'users', 'licenseTypes'));
    }

}

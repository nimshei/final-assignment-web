<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Violation;

class ViolationController extends Controller
{
    public function getViolations(Request $request)
    {
        $query = Violation::query();

        $selectedStatus = $request->input('status');
        $search = $request->input('search');

        if ($selectedStatus) {
            $query->where('status', $selectedStatus);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('violation_code', 'like', '%' . $search . '%')
                ->orWhere('violation_name', 'like', '%' . $search . '%');
            });
        }

        $violations = $query->get();

        return response()->json($violations);
    }

}

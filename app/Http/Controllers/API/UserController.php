<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $query = User::with('roles');

        if ($request->has('selectedRole') && $request->selectedRole) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('id', $request->selectedRole);
            });
        }

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('createdDate') && $request->createdDate) {
            $query->whereDate('created_at', $request->createdDate);
        }

        $users = $query->paginate(10);
        $roles = Role::all();

        return response()->json([
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}

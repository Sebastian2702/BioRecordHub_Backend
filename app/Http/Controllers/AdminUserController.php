<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
            ->select('id', 'name', 'email', 'role')
            ->get();

        return response()->json($users);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return response()->json(['error' => 'Cannot delete admin user.'], 403);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully.']);
    }


    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|string|in:user,manager,admin',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::findOrFail($id);

        if ($user->role === 'admin' && $request->role !== 'admin') {
            return response()->json(['error' => 'Cannot change admin role.'], 403);
        }

        $user->role = $request->role;
        $user->save();

        return response()->json(['message' => 'User role updated successfully.']);
    }
}

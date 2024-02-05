<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
//show current user
        $user = auth()->user();
        //send only relevant data about user and not everything
        $user = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'username' => $user->username,
            'role_id' => $user->role_id,
            'mobile' => $user->mobile,
            'gender' => $user->gender,
            'birthday' => $user->birthday,
            'created_at' => $user->created_at,
        ];
        return response()->json($user);
    }


    public function show($id)
    {
        $this->authorize('accessAdmin');
        try {
            // Find a user by ID where role_id is 2
            $user = User::where('id', $id)->where('role_id', 2)->firstOrFail();

            // Send only relevant data about the user and not everything
            $user = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
                'role_id' => $user->role_id,
                'created_at' => $user->created_at,
            ];

            return response()->json($user);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'User not found',
            ], 404);
        }
    }

    public function create(Request $request)
    {
        $this->authorize('accessAdmin');
        try {
            $data = $this->validateUser($request);

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'role_id' => UserRole::Moderator,
            ]);
            return response()->json(['success' => 'User created successfully.']);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 302);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    private function validateUser(Request $request, $userId = null)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'username' => 'required|string|max:255|unique:users,username,' . $userId,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mobile' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'skill_level' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'progress' => 'nullable|integer',
        ]);
    }

    public function edit(Request $request, $id)
    {
        try {
            $validatedData = $this->validateUser($request, Auth::user()->id);
            $user = Auth::user();

            $user->update([
                'name' => $validatedData['name'] ?? $user->name,
                'email' => $validatedData['email'] ?? $user->email,
                'username' => $validatedData['username'] ?? $user->username,
                'password' => Hash::make($validatedData['password']) ?? $user->password,
                'profile_image_path' => null,
                'mobile' => $validatedData['mobile'] ?? $user->mobile,
                'designation' => $validatedData['designation'] ?? $user->designation,
                'gender' => $validatedData['gender'] ?? $user->gender,
                'birthday' => $validatedData['birthday'] ?? $user->birthday,
                'skill_level' => $validatedData['skill_level'] ?? $user->skill_level,
            ]);

            return response()->json(['success' => 'User updated successfully.']);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 302);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        //delete user
        try {
            $user = User::findOrFail($id);
            if ($user->role_id === UserRole::SuperAdministrator) {
                return response()->json(['error' => 'You cannot delete a super administrator.'], 403);
            }
            if ($user->id === auth()->user()->id || Auth::user()->role_id === UserRole::SuperAdministrator) {
                $user->delete();
                return response()->json(['success' => 'User deleted successfully.']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['error' => 'You cannot delete this user.'], 403);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Enums\UserRole;

class UserEditController extends Controller
{
    public function edit(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('editForm');
    }

    public function payments()
    {
        //display all courses that user has enrolled in
        $user = Auth::user();
        $enrollments = Enrollment::where('user_id', $user->id)->get();
        return view('components.billing_payments', compact('enrollments'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        $validatedData = $this->validateUser($request, $user->id);

        try {
            $imagePath = $this->storeImage($request, $user->profile_image_path);
            // Update the user's details
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->username = $validatedData['username'];

            // Update password only if provided
            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }

            // Update other fields only if provided
            $user->profile_image_path = $imagePath ?? $user->profile_image_path;
            $user->mobile = $validatedData['mobile'] ?? $user->mobile;
            $user->designation = $validatedData['designation'] ?? $user->designation;
            $user->skill_level = $validatedData['skill_level'] ?? $user->skill_level;
            $user->gender = $validatedData['gender'] ?? $user->gender;
            $user->birthday = $validatedData['birthday'] ?? $user->birthday;
            $user->progress = $validatedData['progress'] ?? $user->progress;

            $user->save();

            return redirect()->route('profile')->with('success', 'Your details have been updated.');
        } catch (Exception) {
//            Storage::delete($imagePath);
            return redirect()->route('profile')->with('error', 'User details could not be updated.');
        }
    }

    // Validation logic for user update
    private function validateUser(Request $request, $userId)
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


    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->role_id === UserRole::SuperAdministrator) {
            return redirect()->back()->with('error', 'Super Administrators cannot be deleted.');
        }
        if ($user->id === auth()->user()->id) {
            $user->delete();
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'You cannot delete this user.');
    }


    // Image storage logic for update
    private function storeImage(Request $request, $currentImagePath = null)
    {

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('user_img', 'public');

            // Delete the current image if updating
            if ($currentImagePath) {
                Storage::delete($currentImagePath);
            }
            return $imagePath;
        }

        return $currentImagePath;
    }


}

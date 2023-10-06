<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Enums\UserRole;
class UserEditController extends Controller
{
    public function edit(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('editForm');
    }


    /**
     * Update the user's details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Validate the input data
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit')
                ->withErrors($validator)
                ->withInput();
        }

        // Update the user's details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        // User::update([
        //     'name' =>$user->name ,
        //     'email' => $user->email ,
        //     'username' =>$user->username ,
        //     'password' => $user->password,
        // ]);
        $user->save();
        return redirect()->route('profile')->with('success', 'Your details have been updated.');
    }

    public function destroy(string $id)
    {
        $user = \App\Models\User::findOrFail($id);
        if ($user->role_id === UserRole::SuperAdministrator) {
            return redirect()->back()->with('error', 'Super Administrators cannot be deleted.');
        }
        $user->delete();
        return redirect()->route('home');
    }
}

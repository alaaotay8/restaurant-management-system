<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Admin as admin;

class ProfileController extends Controller
{

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        // Update name if it exists in the request
        if ($request->filled('name')) {
            $validated['name'] = filter_var($request->input('name'), FILTER_SANITIZE_STRING);
            if ($user->name !== $validated['name']) {
                $user->name = $validated['name'];
            }
        }

        // Handle password change
        if ($request->filled('old_pass') && $request->filled('new_pass') && $request->filled('new_pass_confirmation')) {
            $oldPass = filter_var($request->input('old_pass'), FILTER_SANITIZE_STRING);
            $newPass = filter_var($request->input('new_pass'), FILTER_SANITIZE_STRING);
            $confirmPass = filter_var($request->input('new_pass_confirmation'), FILTER_SANITIZE_STRING);

            if (!Hash::check($oldPass, $user->password)) {
                return Redirect::route('profile.edit')->with('error', 'Old password does not match.');
            }

            if ($newPass !== $confirmPass) {
                return Redirect::route('profile.edit')->with('error', 'New password confirmation does not match.');
            }

            if ($newPass !== '' && $newPass !== null && $newPass !== $oldPass) {
                $user->password = Hash::make($newPass);
            } else {
                return Redirect::route('profile.edit')->with('error', 'Please enter a valid new password.');
            }
        }

        // Save changes
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

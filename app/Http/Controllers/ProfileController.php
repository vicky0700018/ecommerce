<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            
            // Store new image
            $path = $request->file('profile_image')->store('profile-images', 'public');
            $user->profile_image = $path;
        }
        
        // Get validated data and exclude profile_image to avoid overwriting
        $validated = $request->validated();
        unset($validated['profile_image']);
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Refresh the authenticated user in the session
        Auth::setUser($user->fresh());

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

    /**
     * Display user's addresses.
     */
    public function addresses(): View
    {
        return view('profile.addresses', [
            'addresses' => Auth::user()->addresses()->get(),
        ]);
    }

    /**
     * Display user's orders.
     */
    public function orders(): View
    {
        return view('profile.orders', [
            'orders' => Auth::user()->orders()->with('items.product')->orderBy('created_at', 'desc')->get(),
        ]);
    }
}

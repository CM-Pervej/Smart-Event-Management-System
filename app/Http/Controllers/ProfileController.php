<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // show user & profile data 
    public function show($id)
    {
        $user = User::with('profile')->findOrFail($id);
        return view('profile.profile', compact('user'));
    }

    // show edit page for user & profile data 
    public function edit($id)
    {
        $user = User::with('profile')->findOrFail($id);
        return view('profile.edit', compact('user'));
    }

    // Update user data and create/update profile data
    public function update(Request $request, $id)
    {
        $request->validate([
            // User fields
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            // Profile fields
            'company'              => 'nullable|string|max:255',
            'department'           => 'nullable|string|max:255',
            'title'                => 'nullable|string|max:255',
            'address'              => 'nullable|string',
            'dietary_requirements' => 'nullable|string',
            'accessibility_needs'  => 'nullable|string',
            'profile_picture'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail($id);

        // 1️⃣ Update user
        $userUpdated = $user->update([
            'name'  => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        // 2️⃣ Handle profile picture
        $imagePath = $user->profile->profile_picture ?? null;

        if ($request->hasFile('profile_picture')) {
            // Delete old image if exists
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // Store new image
            $imagePath = $request->file('profile_picture')->store('profiles', 'public');
        }

        // 3️⃣ Update or create profile
        $profileUpdated = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'company'              => $request->company,
                'department'           => $request->department,
                'title'                => $request->title,
                'address'              => $request->address,
                'dietary_requirements' => $request->dietary_requirements,
                'accessibility_needs'  => $request->accessibility_needs,
                'profile_picture'      => $imagePath,
            ]
        );

        // 4️⃣ Only update cookies if user update succeeded
        if($userUpdated){
            Cookie::queue('user_name', $user->name, 60*24);
            Cookie::queue('user_role', $user->role, 60*24);
        }

        return redirect()->route('profile.show', $user->id)
                         ->with('success', 'Profile updated successfully!');
    }
}
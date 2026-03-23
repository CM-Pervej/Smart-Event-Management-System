<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    public function active(){
        $organizations = Organization::where('status', 'active')
                                    ->where('is_verified', 1)                            
                                    ->with('user')  // Load the owner
                                    ->orderBy('name', 'asc')
                                    ->get();
        return view('organizations.organizations', compact('organizations'));
    }
    public function inactive(){
        $organizations = Organization::where('status', 'inactive')
                                    ->where('is_verified', 1)
                                    ->with('user')  // Load the owner
                                    ->orderBy('name', 'asc')
                                    ->get();
        return view('organizations.organizations', compact('organizations'));
    }
    
    public function create(){
        return view('organizations.create');
    }

    public function currentUserId(Request $request){
        $userId = $request->cookie('user_id');
        if(!$userId) {
            abort(403, 'User not identified');
        }

        return $userId;
    }

    public function store(Request $request){
        $ownerId = $this->currentUserId($request);

        $validated = $request->validate([
            'name'              => 'required|string|max:100',
            'description'       => 'nullable|string',
            'email'             => 'nullable|email',
            'phone'             => 'nullable|string|max:20',
            'website'           => 'nullable|url',
            'address'           => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:100',
            'country'           => 'nullable|string|max:100',
            'organization_type' => 'nullable|string|max:100',
            'industry'          => 'nullable|string|max:100',

            // Files
            'logo'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cover_image'       => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $validated['owner_id']  = $ownerId;
        $validated['slug']      = Str::slug($validated['name'] . '-' . time());

        // 🔐 Default values (user cannot control these)
        $validated['is_verified'] = 0;
        $validated['status'] = 'inactive';

        // Upload files
        if($request->hasFile('logo')){
            $validated['logo']  = $request->file('logo')->store('organization/logos', 'public');
        }

        if($request->hasFile('cover_image')){
            $validated['cover_image']  = $request->file('cover_image')->store('organization/covers', 'public');
        }

        // Handle custom organization type
        if ($request->organization_type === 'other') {
            $validated['organization_type'] = $request->organization_type_custom ?? null;
        }

        // Handle custom industry
        if ($request->industry === 'other') {
            $validated['industry'] = $request->industry_custom ?? null;
        }

        // Create organization
        Organization::create($validated);
        return redirect()->route('organizations.active')->with('success', 'Organization created successfully!');
    }

    public function showBySlug($slug){
        $organization = Organization::where('slug', $slug)->with('user')->firstOrFail();
        return view('organizations.show', compact('organization'));
    }

    public function edit($slug){
        $organization = Organization::where('slug', $slug)->firstOrFail();
        return view('organizations.edit', compact('organization'));
    }

    public function update(Request $request, $slug){
        $organization = Organization::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name'              => 'required|string|max:100',
            'description'       => 'nullable|string',
            'email'             => 'nullable|email',
            'phone'             => 'nullable|string|max:20',
            'website'           => 'nullable|url',
            'address'           => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:100',
            'country'           => 'nullable|string|max:100',
            'organization_type' => 'nullable|string|max:100',
            'industry'          => 'nullable|string|max:100',

            'logo'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cover_image'       => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Handle custom fields
        if ($request->organization_type === 'other') {
            $validated['organization_type'] = $request->organization_type_custom ?? null;
        }

        if ($request->industry === 'other') {
            $validated['industry'] = $request->industry_custom ?? null;
        }

        // Replace logo
        if ($request->hasFile('logo')) {
            if ($organization->logo) {
                Storage::disk('public')->delete($organization->logo);
            }
            $validated['logo'] = $request->file('logo')->store('organization/logos', 'public');
        }

        // Replace cover
        if ($request->hasFile('cover_image')) {
            if ($organization->cover_image) {
                Storage::disk('public')->delete($organization->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('organization/covers', 'public');
        }

        $organization->update($validated);

        return redirect()
            ->route('organizations.organization', $organization->slug)
            ->with('success', 'Organization updated successfully!');
    }
}

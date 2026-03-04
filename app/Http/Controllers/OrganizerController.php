<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function show(){
        return view('organizer.organizer');
    }
    
    public function create(){
        return view('organizer.create');
    }

    public function store(Request $request, $id){
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'descriptin'        => 'required|string',
            'website'           => 'nullable|url',
            'logo'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = $request->file('logo')->store('organizers', 'public');

        Organizer::create([
            'user_id'           => $request->user_id,
            'organization_name' => $request->organization_name,
            'descriptin'        => $request->descriptin,
            'website'           => $request->website,
            'logo'              => $logoPath,
            'status'            => 0,
        ]);

        return back()->with('success', 'Organizer created successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Profile;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Profile $profile)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Profile $profile)
    {
        $techstacks = $profile->techstacks;
        return view('admin.experiences.create', compact('profile', 'techstacks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'company' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'techstacks' => 'nullable|array',
            'techstacks.*' => 'exists:techstacks,id',
        ]);

        $experience = $profile->experiences()->create($data);
        if (!empty($data['techstacks'])) {
            $experience->techstacks()->sync($request->input('techstacks'));
        }
        return redirect()->route('profiles.show', $profile)->with('success', 'Experience successfully added.');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        $profiles = Profile::all();
        $techstacks = $experience->profile->techstacks;
        return view('admin.experiences.edit', compact('experience', 'profiles', 'techstacks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'techstacks' => 'array'
        ]);

        $experience->update($validated);
        $experience->techstacks()->sync($request->techstacks ?? []);

        return redirect()->route('profiles.show', $experience->profile)->with('success', 'Experience updated successfully.');
    }


    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('profiles.show', $experience->profile_id)->with('success', 'Experience deleted successfully!');
    }
}

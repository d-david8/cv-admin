<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Profile;

class ExperienceController extends Controller
{
    public function index(Profile $profile)
    {
        return view('admin.experiences.index', [
            'profile' => $profile,
            'experiences' => $profile->experiences
        ]);
    }

    public function create(Profile $profile)
    {
        $techstacks = $profile->techstacks;
        return view('admin.experiences.create', compact('profile', 'techstacks'));
    }

    public function store(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'company' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'techstack' => 'nullable|string',
        ]);

        $profile->experiences()->create($data);
        return redirect()->route('profiles.show', $profile)->with('success', 'Experience added successfully!');
    }


    public function edit(Experience $experience)
    {
        $profiles = Profile::all();
        return view('admin.experiences.edit', compact('experience', 'profiles'));
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'profile_id' => 'required|exists:profiles,id',
            'company' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'techstack' => 'nullable|string',
        ]);

        $experience->update($data);
        return redirect()->route('profiles.show', $experience->profile_id)->with('success', 'Experience updated successfully!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('profiles.show', $experience->profile_id)->with('success', 'Experience deleted successfully!');
    }
}

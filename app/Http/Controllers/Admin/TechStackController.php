<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\TechStack;
use Illuminate\Http\Request;

/**
* Controller for managing Profiles in the admin panel
*/
class TechStackController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Profile $profile)
    {
        $techstacks = $profile->techstacks;
        return view('admin.techstacks.index', compact('profile', 'techstacks'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Profile $profile)
    {
        return view('admin.techstacks.index', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:50',
        ]);

        $profile->techstacks()->create($data);

        return redirect()
            ->route('profiles.techstacks.index', $profile)
            ->with('success', 'Tech stack added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TechStack $techstack)
    {
        return view('admin.techstacks.edit', compact('techstack'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TechStack $techstack)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:50',
        ]);

        $techstack->update($data);

        return back()->with('success', 'Tech stack updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TechStack $techstack)
    {
        $profileId = $techstack->profile_id;
        $techstack->delete();

        return redirect()->route('profiles.techstacks.index', $profileId)
            ->with('success', 'Tech stack deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Profile;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Profile $profile)
    {
        $techstacks = $profile->techstacks;
        return view('admin.projects.create', compact('profile', 'techstacks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'techstacks' => 'nullable|array',
            'techstacks.*' => 'exists:techstacks,id',
        ]);


        $project = $profile->projects()->create($data);
        if (!empty($data['techstacks'])) {
            $project->techstacks()->sync($request->input('techstacks'));
        }
        return redirect()->route('profiles.show', $profile)->with('success', 'Project successfully added.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $profile = $project->profile;
        $techstacks = $project->profile->techstacks;
        return view('admin.projects.edit', compact('project', 'profile', 'techstacks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255,',
            'description' => 'required|string|max:255,',
            'techstacks' => 'array'
        ]);

        $project->update($data);
        $project->techstacks()->sync($request->techstacks ?? []);

        return redirect()->route('profiles.show', $project->profile)->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('profiles.show', $project->profile_id)->with('success', 'Project deleted successfully!');
    }
}

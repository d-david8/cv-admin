<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceApiController extends Controller
{
    public function index()
    {
        return Experience::with('profile')->get();
    }

    public function store(Request $request)
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

        $experience = Experience::create($data);

        return response()->json($experience, 201);
    }

    public function show(Experience $experience)
    {
        return $experience->load('profile');
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

        return response()->json($experience);
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return response()->json(null, 204);
    }
}

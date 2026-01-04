<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileApiController extends Controller
{
    public function index()
    {
        return response()->json(Profile::all());
    }

    public function show($id)
    {
        $profile = Profile::find($id);
        if (!$profile) return response()->json(['message' => 'Profile not found'], 404);

        return response()->json($profile);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles',
            'title' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'linkedin' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255'
        ]);

        $profile = Profile::create($request->all());

        return response()->json($profile, 201);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        if (!$profile) return response()->json(['message' => 'Profile not found'], 404);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles,email,'.$id,
            'title' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'linkedin' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255'
        ]);

        $profile->update($request->all());

        return response()->json($profile);
    }

    public function destroy($id)
    {
        $profile = Profile::find($id);
        if (!$profile) return response()->json(['message' => 'Profile not found'], 404);

        $profile->delete();

        return response()->json(['message' => 'Profile deleted successfully']);
    }
}
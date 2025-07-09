<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ClubResource;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClubController extends Controller
{
    public function index()
    {
        return ClubResource::collection(Club::latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clubs'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'club_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $club = Club::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'club_name' => $request->club_name,
            'location' => $request->location,
        ]);

        return new ClubResource($club);
    }

    public function show(Club $club)
    {
        return new ClubResource($club);
    }

    public function update(Request $request, Club $club)
    {
        $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('clubs')->ignore($club->id)],
            'club_name' => ['sometimes', 'required', 'string', 'max:255'],
            'location' => ['sometimes', 'required', 'string', 'max:255'],
        ]);

        $club->update($request->all());

        return new ClubResource($club);
    }

    public function destroy(Club $club)
    {
        $club->delete();
        return response()->json(null, 204);
    }
}
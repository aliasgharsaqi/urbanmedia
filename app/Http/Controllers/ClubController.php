<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::latest()->get();
        return view('pages.clubs.index', compact('clubs'));
    }

    public function create()
    {
        return view('pages.clubs.create');
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

        Club::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'club_name' => $request->club_name,
            'location' => $request->location,
        ]);

        return redirect()->route('clubs.index')->with('success', 'Club created successfully.');
    }

    public function show(Club $club)
    {
        return view('pages.club.show', compact('club'));
    }

    public function edit(Club $club)
    {
        return view('pages.clubs.edit', compact('club'));
    }

    public function update(Request $request, Club $club)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('clubs')->ignore($club->id)],
            'club_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $data = $request->only(['name', 'email', 'club_name', 'location']);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['sometimes', 'required', 'string', 'min:8', 'confirmed'],
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $club->update($data);

        return redirect()->route('clubs.index')->with('success', 'Club updated successfully.');
    }

    public function destroy(Club $club)
    {
        $club->delete();
        return redirect()->route('clubs.index')->with('success', 'Club deleted successfully.');
    }
}

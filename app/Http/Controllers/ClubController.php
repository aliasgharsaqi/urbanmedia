<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClubController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clubs',
            'password' => 'required|string|min:8|confirmed',
            'club_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Club::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'club_name' => $request->club_name,
            'location' => $request->location,
        ]);

        return redirect()->route('dashboard')->with('success', 'Club registered successfully!');
    }

    public function update(Request $request, Club $club)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clubs,email,' . $club->id,
            'club_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $club->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Club updated successfully!');
    }

    public function destroy(Club $club)
    {
        $club->delete();
        return redirect()->route('dashboard')->with('success', 'Club deleted successfully!');
    }
}

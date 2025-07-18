<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        // FIX: Check for 'Admin' with a capital 'A'.
        if (auth()->user()->role !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        $users = User::where('role', 'User')->withTrashed()->latest()->get();
        return view('pages.clubs.index', compact('users'));
    }

    public function toggleStatus(User $user)
    {
        $user->status = ($user->status == 1) ? 3 : 1;
        $user->save();
        $message = ($user->status == 1) ? 'User activated successfully.' : 'User deactivated successfully.';
        // FIX: Use the 'admin.' prefix
        return redirect()->route('admin.users.index')->with('success', $message);
    }

    public function destroy(User $user)
    {
        $user->delete();
        // FIX: Use the 'admin.' prefix
        return redirect()->route('admin.users.index')->with('success', 'User soft-deleted successfully.');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        // FIX: Use the 'admin.' prefix
        return redirect()->route('admin.users.index')->with('success', 'User restored successfully.');
    }
    
    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        // Validation logic...
        User::create([
            // Creation logic...
        ]);
        // FIX: Use the 'admin.' prefix
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validation logic...
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            // Add other fields and validation rules as needed
        ]);
        $user->update($data);
        // FIX: Use the 'admin.' prefix
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}
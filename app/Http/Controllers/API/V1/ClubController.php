<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClubController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            $clubs = Club::latest()->get();
            return $clubs->isEmpty()
                ? $this->emptyResponse('No clubs found.')
                : $this->successResponse($clubs, 'Clubs retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not retrieve clubs.', 500, $e);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clubs'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'club_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }

        try {
            // Manually create the data array and hash the password
            $club = Club::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // <-- This is the fix
                'club_name' => $request->club_name,
                'location' => $request->location,
            ]);

            return $this->successResponse($club, 'Club created successfully.', 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Could not create club.', 500, $e);
        }
    }

    public function show(Club $club)
    {
        return $this->successResponse($club, 'Club retrieved successfully.');
    }

    public function update(Request $request, Club $club)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('clubs')->ignore($club->id)],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'], // Also allow password updates
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }

        try {
            $data = $request->except('password');

            // Check if a new password was provided and hash it
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $club->update($data);
            return $this->successResponse($club, 'Club updated successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not update club.', 500, $e);
        }
    }

    public function destroy(Club $club)
    {
        try {
            $club->delete();
            return $this->successResponse(null, 'Club deleted successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not delete club.', 500, $e);
        }
    }
}
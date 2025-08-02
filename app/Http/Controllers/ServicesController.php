<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Mail\ServiceRequestConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ServicesController extends Controller
{
    public function services()
    {
        if (auth()->user()->role == 'Admin') {
            $services = ServiceRequest::latest()->get();
            return view('pages.services.services', compact('services'));
        } else {
            return view('pages.services.index');
        }
    }

    public function services_create()
    {
        return view('pages.services.create');
    }

    public function showRequestForm()
    {
        return view('pages.serivices-request');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string',
            'club'      => 'nullable|string|max:255',
            'location'  => 'nullable|string|max:255',
            'services'  => 'required|array',
        ]);

        $serviceRequest = ServiceRequest::create($validatedData);

        try {
            Mail::to($serviceRequest->email)->send(new ServiceRequestConfirmation($serviceRequest));
            if ($user) {
                return redirect()->route('admin.services')
                    ->with('success', 'Your request was submitted and a confirmation email has been sent!');
            } else {
                return redirect()->route('service.request.create')
                    ->with('success', 'Your request was submitted and a confirmation email has been sent!');
            }
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            if ($user) {
                return redirect()->route('admin.services')
                    ->with('success', 'Your request was submitted and a confirmation email has been sent!');
            } else {
                return redirect()->route('service.request.create')
                    ->with('success', 'Your request was submitted and a confirmation email has been sent!');
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Mail\ServiceRequestConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ServicesController extends Controller
{
    public function showRequestForm()
    {
        return view('pages.serivices-request');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|max:255',
        'club'      => 'nullable|string|max:255',
        'location'  => 'nullable|string|max:255',
        'services'  => 'required|array',
    ]);

    $serviceRequest = ServiceRequest::create($validatedData);

    try {
        Mail::to($serviceRequest->email)->send(new ServiceRequestConfirmation($serviceRequest));
        
        return redirect()->route('service.request.create')
            ->with('success', 'Your request was submitted and a confirmation email has been sent!');

    } catch (\Exception $e) {
        Log::error('Email sending failed: ' . $e->getMessage());

        return redirect()->route('service.request.create')
            ->with('error', 'Your request was saved, but the confirmation email could not be sent. Please contact support.');
    }
}
}
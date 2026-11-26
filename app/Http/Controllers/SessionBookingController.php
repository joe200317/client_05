<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionBookingRequest;
use App\Models\SessionBooking;
use Illuminate\Http\JsonResponse;

class SessionBookingController extends Controller
{
    public function store(StoreSessionBookingRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $booking = SessionBooking::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'program' => trim($validated['program']),
            'timing' => trim($validated['timing']),
            'message' => trim($validated['message']),
            'status' => 'new',
        ]);

        return response()->json([
            'message' => 'Your session request has been submitted successfully.',
            'booking_id' => $booking->id,
        ], 201);
    }
}

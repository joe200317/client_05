<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SessionBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SessionBookingController extends Controller
{
    public function index(): View
    {
        $bookings = SessionBooking::query()
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(SessionBooking $booking): View
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, SessionBooking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:new,reviewed,confirmed,closed'],
        ]);

        $booking->update(['status' => $validated['status']]);

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('status', 'Booking status updated.');
    }

    public function destroy(SessionBooking $booking): RedirectResponse
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('status', 'Booking deleted.');
    }
}

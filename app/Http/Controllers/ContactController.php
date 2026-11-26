<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        ContactMessage::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => $validated['phone'] ?? null,
            'topic' => $validated['interest'],
            'message' => trim($validated['message']),
            'is_read' => false,
        ]);

        return redirect()
            ->route('contact')
            ->with('status', 'Thank you. Your message has been sent successfully.');
    }
}

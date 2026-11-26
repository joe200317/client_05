@extends('layouts.admin')

@section('title', 'Session Bookings')

@push('styles')
<style>
    tr.booking-row { cursor:pointer; transition:background .15s ease; }
    tr.booking-row:hover { background:#f7faf3; }
    .badge { display:inline-block; padding:3px 9px; border-radius:999px; font-size:11px; font-weight:700; background:var(--brand-soft); color:var(--brand-deep); }
    .empty-note { color:var(--text-muted); font-size:14px; margin:0; }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Inbox</p>
            <h1 class="page-title">Session bookings</h1>
            <p class="page-subtitle">Requests submitted from the Book a Session modal.</p>
        </div>
    </div>

    <div class="card">
        @if($bookings->isEmpty())
            <p class="empty-note">No session bookings yet.</p>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width:22%;">Name</th>
                            <th style="width:22%;">Program</th>
                            <th style="width:26%;">Timing</th>
                            <th style="width:18%;">Received</th>
                            <th style="width:12%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr class="booking-row" onclick="window.location='{{ route('admin.bookings.show', $booking) }}'">
                                <td>
                                    <strong>{{ $booking->name }}</strong>
                                    <div style="color:var(--text-muted);font-size:12px;margin-top:3px;">{{ $booking->email }}</div>
                                </td>
                                <td>{{ $booking->program }}</td>
                                <td>{{ $booking->timing }}</td>
                                <td>{{ $booking->created_at?->format('d M Y, h:i A') }}</td>
                                <td><span class="badge">{{ ucfirst($booking->status) }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

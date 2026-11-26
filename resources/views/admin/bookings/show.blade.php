@extends('layouts.admin')

@section('title', 'Booking Detail')

@push('styles')
<style>
    .detail-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; margin-bottom:18px; }
    .detail-item { padding:14px 16px; border:1px solid var(--border-soft); border-radius:14px; background:#fbfcf9; }
    .detail-item span { display:block; font-size:11px; font-weight:800; letter-spacing:.7px; text-transform:uppercase; color:var(--text-muted); margin-bottom:6px; }
    .detail-item strong { font-size:14.5px; color:var(--text-ink); word-break:break-word; }
    .message-body { white-space:pre-wrap; line-height:1.7; font-size:14.5px; color:#314531; margin:0; }
    .actions { display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin-top:18px; }
    .status-form { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
    .status-form select { padding:10px 12px; border-radius:12px; border:1px solid var(--border-soft); font:inherit; }
    @media (max-width:720px) { .detail-grid { grid-template-columns:1fr; } }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Session bookings</p>
            <h1 class="page-title">Booking detail</h1>
            <p class="page-subtitle">Complete request from {{ $booking->name }}</p>
        </div>
        <a href="{{ route('admin.bookings.index') }}" class="btn-secondary-soft">Back to list</a>
    </div>

    <div class="card" style="max-width:860px;">
        <div class="detail-grid">
            <div class="detail-item"><span>Name</span><strong>{{ $booking->name }}</strong></div>
            <div class="detail-item"><span>Email</span><strong>{{ $booking->email }}</strong></div>
            <div class="detail-item"><span>Program</span><strong>{{ $booking->program }}</strong></div>
            <div class="detail-item"><span>Preferred timing</span><strong>{{ $booking->timing }}</strong></div>
            <div class="detail-item"><span>Submitted</span><strong>{{ $booking->created_at?->format('d M Y, h:i A') }}</strong></div>
            <div class="detail-item"><span>Status</span><strong>{{ ucfirst($booking->status) }}</strong></div>
        </div>

        <h2 style="margin:0 0 10px;font-family:'Playfair Display',serif;font-size:22px;">Notes</h2>
        <p class="message-body">{{ $booking->message }}</p>

        <div class="actions">
            <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" class="status-form">
                @csrf
                @method('PUT')
                <label for="status" style="font-size:12px;font-weight:700;color:var(--text-muted);">Update status</label>
                <select id="status" name="status" data-theme-dropdown>
                    @foreach (['new', 'reviewed', 'confirmed', 'closed'] as $status)
                        <option value="{{ $status }}" @selected($booking->status === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary-green">Save</button>
            </form>

            <a href="mailto:{{ $booking->email }}" class="btn-secondary-soft">Reply by email</a>

            <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" onsubmit="return confirm('Delete this booking?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-secondary-soft" style="color:var(--danger-text);">Delete</button>
            </form>
        </div>
    </div>
@endsection

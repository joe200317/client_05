@extends('layouts.admin')

@section('title', 'Message Detail')

@push('styles')
<style>
    .detail-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; margin-bottom:18px; }
    .detail-item { padding:14px 16px; border:1px solid var(--border-soft); border-radius:14px; background:#fbfcf9; }
    .detail-item span { display:block; font-size:11px; font-weight:800; letter-spacing:.7px; text-transform:uppercase; color:var(--text-muted); margin-bottom:6px; }
    .detail-item strong { font-size:14.5px; color:var(--text-ink); word-break:break-word; }
    .message-body { white-space:pre-wrap; line-height:1.7; font-size:14.5px; color:#314531; margin:0; }
    .actions { display:flex; gap:10px; flex-wrap:wrap; margin-top:18px; }
    @media (max-width:720px) { .detail-grid { grid-template-columns:1fr; } }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Contact messages</p>
            <h1 class="page-title">Message detail</h1>
            <p class="page-subtitle">Full enquiry from {{ $message->name }}</p>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="btn-secondary-soft">Back to inbox</a>
    </div>

    <div class="card" style="max-width:860px;">
        <div class="detail-grid">
            <div class="detail-item"><span>Name</span><strong>{{ $message->name }}</strong></div>
            <div class="detail-item"><span>Email</span><strong>{{ $message->email }}</strong></div>
            <div class="detail-item"><span>Phone</span><strong>{{ $message->phone ?: '—' }}</strong></div>
            <div class="detail-item"><span>Topic</span><strong>{{ $message->topic }}</strong></div>
            <div class="detail-item"><span>Submitted</span><strong>{{ $message->created_at?->format('d M Y, h:i A') }}</strong></div>
            <div class="detail-item"><span>Status</span><strong>{{ $message->is_read ? 'Read' : 'New' }}</strong></div>
        </div>

        <h2 style="margin:0 0 10px;font-family:'Playfair Display',serif;font-size:22px;">Message</h2>
        <p class="message-body">{{ $message->message }}</p>

        <div class="actions">
            <a href="mailto:{{ $message->email }}" class="btn-primary-green">Reply by email</a>
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-secondary-soft" style="color:var(--danger-text);">Delete</button>
            </form>
        </div>
    </div>
@endsection

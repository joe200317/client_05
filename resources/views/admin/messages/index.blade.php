@extends('layouts.admin')

@section('title', 'Contact Messages')

@push('styles')
<style>
    tr.message-row { cursor:pointer; transition:background .15s ease; }
    tr.message-row:hover { background:#f7faf3; }
    .badge { display:inline-block; padding:3px 9px; border-radius:999px; font-size:11px; font-weight:700; }
    .badge-on { background:var(--brand-soft); color:var(--brand-deep); }
    .badge-off { background:#f1f1f1; color:#6b6b6b; }
    .empty-note { color:var(--text-muted); font-size:14px; margin:0; }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Inbox</p>
            <h1 class="page-title">Contact messages</h1>
            <p class="page-subtitle">Messages submitted from the public contact form.</p>
        </div>
    </div>

    <div class="card">
        @if($messages->isEmpty())
            <p class="empty-note">No contact messages yet.</p>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width:22%;">From</th>
                            <th style="width:18%;">Topic</th>
                            <th style="width:30%;">Preview</th>
                            <th style="width:18%;">Received</th>
                            <th style="width:12%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr class="message-row" onclick="window.location='{{ route('admin.messages.show', $message) }}'">
                                <td>
                                    <strong>{{ $message->name }}</strong>
                                    <div style="color:var(--text-muted);font-size:12px;margin-top:3px;">{{ $message->email }}</div>
                                </td>
                                <td>{{ $message->topic }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($message->message, 70) }}</td>
                                <td>{{ $message->created_at?->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if($message->is_read)
                                        <span class="badge badge-off">Read</span>
                                    @else
                                        <span class="badge badge-on">New</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Edit Gallery Photo')

@push('styles')
<style>
    .form-grid { display:grid; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:16px; }
    .field { display:flex; flex-direction:column; gap:6px; margin-bottom:14px; }
    .field label, .check-row label { font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:.8px; color:#30472f; }
    .field-hint { font-weight:500; text-transform:none; letter-spacing:0; color:var(--text-muted); }
    .field input, .field textarea { padding:11px 14px; border-radius:12px; border:1px solid var(--border-soft); font-family:inherit; font-size:14px; background:#fff; }
    .field textarea { resize:vertical; min-height:90px; }
    .field input:focus, .field textarea:focus { outline:none; border-color:var(--brand-primary); box-shadow:0 0 0 3px rgba(45,117,66,.12); }
    .field-error { color:var(--danger-text); font-size:12px; font-weight:600; }
    .check-row { display:flex; gap:18px; flex-wrap:wrap; margin:8px 0 18px; }
    .check-row label { display:flex; align-items:center; gap:8px; text-transform:none; letter-spacing:0; font-weight:600; font-size:13.5px; }
    .form-actions { display:flex; gap:10px; flex-wrap:wrap; }
    @media (max-width:720px) { .form-grid { grid-template-columns:1fr; } }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Gallery</p>
            <h1 class="page-title">Edit photo</h1>
            <p class="page-subtitle">Update how this photo appears on the website.</p>
        </div>
        <a href="{{ route('admin.gallery.index') }}" class="btn-secondary-soft">Back to list</a>
    </div>

    <div class="card" style="max-width:820px;">
        <form method="POST" action="{{ route('admin.gallery.update', $photo) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.gallery._form', ['photo' => $photo])
            <div class="form-actions">
                <button type="submit" class="btn-primary-green">Update photo</button>
                <a href="{{ route('admin.gallery.index') }}" class="btn-secondary-soft">Cancel</a>
            </div>
        </form>
    </div>
@endsection

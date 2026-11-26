@extends('layouts.admin')

@section('title', 'Edit Program')

@push('styles')
<style>
    .form-grid { display:grid; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:16px; }
    .field { display:flex; flex-direction:column; gap:6px; margin-bottom:14px; }
    .field label {
        font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:.8px; color:#30472f;
    }
    .field input, .field textarea, .field select {
        padding:11px 14px; border-radius:12px; border:1px solid var(--border-soft);
        font-family:inherit; font-size:14px; background:#fff;
    }
    .field textarea { resize:vertical; min-height:120px; }
    .field-hint { font-weight:500; text-transform:none; letter-spacing:0; color:var(--text-muted); }
    .field input:focus, .field textarea:focus, .field select:focus {
        outline:none; border-color:var(--brand-primary); box-shadow:0 0 0 3px rgba(45,117,66,.12);
    }
    .field select.theme-select {
        appearance:none; -webkit-appearance:none;
        min-height:48px; padding:12px 46px 12px 14px;
        border:1px solid #d5e3cb; border-radius:14px;
        background-color:#fcfdf9;
        background-image:
            linear-gradient(45deg, transparent 50%, #2d7542 50%),
            linear-gradient(135deg, #2d7542 50%, transparent 50%),
            linear-gradient(to right, #e3eedb, #e3eedb);
        background-position:
            calc(100% - 20px) calc(50% - 3px),
            calc(100% - 14px) calc(50% - 3px),
            calc(100% - 42px) 50%;
        background-size:6px 6px, 6px 6px, 1px 56%;
        background-repeat:no-repeat;
        color:#24392a; font-weight:500; cursor:pointer;
        transition:border-color .2s ease, box-shadow .2s ease, background-color .2s ease, transform .2s ease;
    }
    .field select.theme-select:hover {
        border-color:#b7d0ae; background-color:#fff;
    }
    .field select.theme-select:focus {
        outline:none; border-color:#2d7542; background-color:#fff;
        box-shadow:0 0 0 4px rgba(45,117,66,.14);
    }
    .field-error { color:var(--danger-text); font-size:12px; font-weight:600; }
    .form-actions { display:flex; gap:10px; flex-wrap:wrap; margin-top:8px; }
    @media (max-width:720px) { .form-grid { grid-template-columns:1fr; } }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Programs</p>
            <h1 class="page-title">Edit program</h1>
            <p class="page-subtitle">Update how this program appears on the website.</p>
        </div>
        <a href="{{ route('admin.programs.index') }}" class="btn-secondary-soft">Back to list</a>
    </div>

    <div class="card" style="max-width:820px;">
        <form method="POST" action="{{ route('admin.programs.update', $program) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.programs._form', ['program' => $program])
            <div class="form-actions">
                <button type="submit" class="btn-primary-green">Update program</button>
                <a href="{{ route('admin.programs.index') }}" class="btn-secondary-soft">Cancel</a>
            </div>
        </form>
    </div>
@endsection
@extends('layouts.admin')

@section('title', 'Account Settings')

@push('styles')
<style>
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }
    .field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 14px; }
    .field label {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: #30472f;
    }
    .field input {
        padding: 11px 14px;
        border-radius: 12px;
        border: 1px solid var(--border-soft);
        font-family: inherit;
        font-size: 14px;
    }
    .field input:focus {
        outline: none;
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 3px rgba(45, 117, 66, .12);
    }
    .field-error { color: var(--danger-text); font-size: 12px; font-weight: 600; }
    @media (max-width: 720px) { .form-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Administration</p>
            <h1 class="page-title">Account settings</h1>
            <p class="page-subtitle">Update your admin profile, login email, or password.</p>
        </div>
    </div>

    <div class="card" style="max-width:720px;">
        <form method="POST" action="{{ route('admin.account.update') }}">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="field">
                    <label for="name">Admin name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                    @error('name') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="field">
                    <label for="email">Login email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="field">
                <label for="current_password">Current password (required to save changes)</label>
                <input type="password" id="current_password" name="current_password" required>
                @error('current_password') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-grid">
                <div class="field">
                    <label for="password">New password (optional, min 8 chars)</label>
                    <input type="password" id="password" name="password">
                    @error('password') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm new password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>
            </div>

            <button type="submit" class="btn-primary-green">Save account changes</button>
        </form>
    </div>
@endsection
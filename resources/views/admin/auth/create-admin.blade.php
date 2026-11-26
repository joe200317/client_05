@extends('layouts.admin')

@section('title', 'Create Admin')

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
    table { width: 100%; border-collapse: collapse; }
    th, td { text-align: left; padding: 11px 12px; border-bottom: 1px solid #edf2e8; font-size: 13.5px; }
    th { font-size: 11px; text-transform: uppercase; letter-spacing: .7px; color: var(--text-muted); }
    @media (max-width: 720px) { .form-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Administration</p>
            <h1 class="page-title">Create admin</h1>
            <p class="page-subtitle">Only existing signed-in admins can create additional admin accounts.</p>
        </div>
    </div>

    <div class="card" style="margin-bottom:22px;max-width:720px;">
        <form method="POST" action="{{ route('admin.admins.store') }}">
            @csrf

            <div class="form-grid">
                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="field">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="field">
                    <label for="password">Password (min 8 chars)</label>
                    <input type="password" id="password" name="password" required>
                    @error('password') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn-primary-green">Create admin account</button>
        </form>
    </div>

    <div class="card" style="max-width:720px;">
        <h2 style="margin:0 0 12px;font-family:'Playfair Display',serif;font-size:20px;">Active Admin Accounts</h2>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $adminUser)
                        <tr>
                            <td>{{ $adminUser->name }}</td>
                            <td>{{ $adminUser->email }}</td>
                            <td>{{ ucfirst($adminUser->role ?? 'admin') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
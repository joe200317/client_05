@extends('layouts.admin')

@section('title', 'Programs')

@push('styles')
<style>
    .badge {
        display:inline-block; padding:3px 9px; border-radius:999px; font-size:11px; font-weight:700;
    }
    .badge-on { background:var(--brand-soft); color:var(--brand-deep); }
    .badge-off { background:#f1f1f1; color:#6b6b6b; }
    .empty-note { color:var(--text-muted); font-size:14px; margin:0; }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Manage</p>
            <h1 class="page-title">Programs</h1>
            <p class="page-subtitle">Programs marked visible appear on the public /programs page.</p>
        </div>
        <a href="{{ route('admin.programs.create') }}" class="btn-primary-green">Add program</a>
    </div>

    <div class="card">
        @if($programs->isEmpty())
            <p class="empty-note">No programs yet. Add the first one to show it on the website.</p>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width:28%;">Title</th>
                            <th style="width:18%;">Category</th>
                            <th style="width:18%;">Type</th>
                            <th style="width:10%;">Order</th>
                            <th style="width:12%;">Status</th>
                            <th class="col-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programs as $program)
                            <tr>
                                <td>
                                    <strong>{{ $program->title }}</strong>
                                    <div style="color:var(--text-muted);font-size:12px;margin-top:3px;">{{ $program->slug }}</div>
                                </td>
                                <td>{{ $program->category }}</td>
                                <td>{{ $program->type }}</td>
                                <td>{{ $program->display_order }}</td>
                                <td>
                                    @if($program->is_visible)
                                        <span class="badge badge-on">Visible</span>
                                    @else
                                        <span class="badge badge-off">Hidden</span>
                                    @endif
                                </td>
                                <td class="col-actions">
                                    <div class="row-actions">
                                        <a href="{{ route('admin.programs.edit', $program) }}" class="btn-secondary-soft">Edit</a>
                                        <form method="POST" action="{{ route('admin.programs.destroy', $program) }}" onsubmit="return confirm('Delete this program?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-secondary-soft" style="color:var(--danger-text);">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Gallery')

@push('styles')
<style>
    .badge { display:inline-block; padding:3px 9px; border-radius:999px; font-size:11px; font-weight:700; }
    .badge-on { background:var(--brand-soft); color:var(--brand-deep); }
    .badge-off { background:#f1f1f1; color:#6b6b6b; }
    .empty-note { color:var(--text-muted); font-size:14px; margin:0; }
    .thumb { width:64px; height:48px; object-fit:cover; border-radius:10px; border:1px solid var(--border-soft); }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Manage</p>
            <h1 class="page-title">Gallery</h1>
            <p class="page-subtitle">Visible photos appear on the public /gallery page.</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="btn-primary-green">Add photo</a>
    </div>

    <div class="card">
        @if($photos->isEmpty())
            <p class="empty-note">No gallery photos yet. Upload the first moment.</p>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width:12%;">Photo</th>
                            <th style="width:42%;">Title</th>
                            <th style="width:10%;">Order</th>
                            <th style="width:12%;">Status</th>
                            <th class="col-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($photos as $photo)
                            <tr>
                                <td><img src="{{ $photo->image_url }}" alt="" class="thumb"></td>
                                <td>
                                    <strong>{{ $photo->title }}</strong>
                                    @if($photo->description)
                                        <div style="color:var(--text-muted);font-size:12px;margin-top:3px;">{{ \Illuminate\Support\Str::limit($photo->description, 70) }}</div>
                                    @endif
                                </td>
                                <td>{{ $photo->display_order }}</td>
                                <td>
                                    @if($photo->is_visible)
                                        <span class="badge badge-on">Visible</span>
                                    @else
                                        <span class="badge badge-off">Hidden</span>
                                    @endif
                                </td>
                                <td class="col-actions">
                                    <div class="row-actions">
                                        <a href="{{ route('admin.gallery.edit', $photo) }}" class="btn-secondary-soft">Edit</a>
                                        <form method="POST" action="{{ route('admin.gallery.destroy', $photo) }}" onsubmit="return confirm('Delete this photo?');">
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

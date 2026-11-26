@extends('layouts.admin')

@section('title', 'Blog')

@push('styles')
<style>
    .badge { display:inline-block; padding:3px 9px; border-radius:999px; font-size:11px; font-weight:700; }
    .badge-on { background:var(--brand-soft); color:var(--brand-deep); }
    .badge-off { background:#f1f1f1; color:#6b6b6b; }
    .empty-note { color:var(--text-muted); font-size:14px; margin:0; }
</style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <p class="page-kicker">Manage</p>
            <h1 class="page-title">Blog</h1>
            <p class="page-subtitle">Published posts appear on the public /blogs page.</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="btn-primary-green">Add post</a>
    </div>

    <div class="card">
        @if($posts->isEmpty())
            <p class="empty-note">No blog posts yet. Publish the first insight.</p>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width:34%;">Title</th>
                            <th style="width:18%;">Category</th>
                            <th style="width:14%;">Published</th>
                            <th style="width:12%;">Status</th>
                            <th class="col-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <strong>{{ $post->title }}</strong>
                                    <div style="color:var(--text-muted);font-size:12px;margin-top:3px;">{{ $post->slug }}</div>
                                </td>
                                <td>{{ $post->category }}</td>
                                <td>{{ optional($post->published_at)->format('d M Y') }}</td>
                                <td>
                                    @if($post->is_published)
                                        <span class="badge badge-on">Published</span>
                                    @else
                                        <span class="badge badge-off">Draft</span>
                                    @endif
                                </td>
                                <td class="col-actions">
                                    <div class="row-actions">
                                        <a href="{{ route('admin.blogs.edit', $post) }}" class="btn-secondary-soft">Edit</a>
                                        <form method="POST" action="{{ route('admin.blogs.destroy', $post) }}" onsubmit="return confirm('Delete this post?');">
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

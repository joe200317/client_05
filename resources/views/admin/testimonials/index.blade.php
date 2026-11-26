@extends('layouts.admin')

@section('title', 'Testimonials')

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
            <h1 class="page-title">Testimonials</h1>
            <p class="page-subtitle">Published reflections appear on the public /testimonials page.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-primary-green">Add testimonial</a>
    </div>

    <div class="card">
        @if($testimonials->isEmpty())
            <p class="empty-note">No testimonials yet. Add the first participant reflection.</p>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width:22%;">Learner</th>
                            <th style="width:40%;">Quote</th>
                            <th style="width:10%;">Order</th>
                            <th style="width:12%;">Status</th>
                            <th class="col-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                            <tr>
                                <td>
                                    <strong>{{ $testimonial->learner_name }}</strong>
                                    @if($testimonial->program_or_role)
                                        <div style="color:var(--text-muted);font-size:12px;margin-top:3px;">{{ $testimonial->program_or_role }}</div>
                                    @endif
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($testimonial->quote, 90) }}</td>
                                <td>{{ $testimonial->display_order }}</td>
                                <td>
                                    @if($testimonial->is_published)
                                        <span class="badge badge-on">Published</span>
                                    @else
                                        <span class="badge badge-off">Hidden</span>
                                    @endif
                                </td>
                                <td class="col-actions">
                                    <div class="row-actions">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn-secondary-soft">Edit</a>
                                        <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Delete this testimonial?');">
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

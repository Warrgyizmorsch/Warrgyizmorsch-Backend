@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title"><h5 class="m-b-10">SEO Dashboard</h5></div>
        <ul class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li><li class="breadcrumb-item">SEO</li></ul>
    </div>
</div>
<div class="main-content">
    <div class="row">
        @foreach ([
            ['Blogs', $totalBlogs, 'feather-book-open', 'blog.index', 'primary'],
            ['Website Leads', $totalWarrLeads, 'feather-inbox', 'warr-leads.index', 'success'],
            ['Service Pages', $totalServicePages, 'feather-file-text', 'warr-service-pages.index', 'warning'],
        ] as [$label, $count, $icon, $route, $color])
            <div class="col-xxl-4 col-md-6"><a href="{{ route($route) }}" class="text-decoration-none"><div class="card stretch stretch-full"><div class="card-body d-flex align-items-center gap-3"><div class="avatar-text avatar-lg bg-soft-{{ $color }} text-{{ $color }}"><i class="{{ $icon }}"></i></div><div><span class="text-muted">Total {{ $label }}</span><h3 class="mb-0">{{ number_format($count) }}</h3></div></div></div></a></div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-xl-6"><div class="card stretch stretch-full"><div class="card-header"><h5 class="card-title">Recent Blogs</h5></div><div class="card-body">
            @forelse ($recentBlogs as $blog)<div class="d-flex justify-content-between border-bottom py-2"><span>{{ $blog->title ?? $blog->blog_title ?? 'Blog #'.$blog->id }}</span><small class="text-muted">{{ optional($blog->created_at)->format('d M Y') }}</small></div>@empty <p class="text-muted mb-0">No blogs found.</p> @endforelse
        </div></div></div>
        <div class="col-xl-6"><div class="card stretch stretch-full"><div class="card-header"><h5 class="card-title">Recent Website Leads</h5></div><div class="card-body">
            @forelse ($recentWarrLeads as $lead)<div class="d-flex justify-content-between border-bottom py-2"><span>{{ $lead->name ?: $lead->email }}</span><small class="text-muted">{{ $lead->status ?: 'New' }}</small></div>@empty <p class="text-muted mb-0">No website leads found.</p> @endforelse
        </div></div></div>
    </div>
</div>
@endsection

@foreach ($blogs as $blog)
    <div class="new-blog-card new-blog-card-sm">
        <a href="{{ url('/blog', $blog->slug) }}">
            <img src="{{ asset($blog->images) }}" alt="{{ $blog->title }}" class="new-blog-card-img">
        </a>
        <div class="new-blog-card-body">
            <div class="new-blog-meta">{{ $blog->created_at->format('F j, Y') }}</div>
            <h3 class="new-blog-card-title" style="font-size:16px;">
                <a href="{{ url('/blog', $blog->slug) }}">{{ $blog->title }}</a>
            </h3>
            <p class="new-blog-card-text">
                {{ Str::limit(strip_tags($blog->content), 100, '…') }}
            </p>
            <a href="{{ url('/blog', $blog->slug) }}" class="new-blog-custom-btn"
                style="background:#fff;color:#FC9118;border:1px solid #FC9118;box-shadow:none;">Read</a>
        </div>
    </div>
@endforeach
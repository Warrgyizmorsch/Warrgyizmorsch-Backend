<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" 
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    @foreach($subjects as $subject)
        <url>
            <loc>{{ url('/study/' . $subject->slug) }}</loc>
            <lastmod>{{ now()->toDateString() }}</lastmod>
            <priority>0.5</priority>
            <changefreq>weekly</changefreq>

            @if(!empty($subject->images))
                <image:image>
                    <image:loc>{{ url($subject->images) }}</image:loc>
                    <image:title>{{ $subject->title }}</image:title>
                </image:image>
            @endif

        </url>
    @endforeach

</urlset>
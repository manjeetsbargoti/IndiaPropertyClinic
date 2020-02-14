<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($city as $ct)
        <url>
            <loc>{{ url('/city/real-estate-for-sale-'.str_replace(' ','_',$ct->name)) }}</loc>
            <lastmod>{{ $ct->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
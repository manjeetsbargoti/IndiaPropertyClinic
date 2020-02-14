<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    @foreach ($country as $count)
        <url>
            <loc>{{ url('/country/real-estate-for-sale-'.str_replace(' ','_',$count->name)) }}</loc>
            <lastmod>{{ $count->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
    
    @foreach ($country as $count)
        <url>
            <loc>{{ url('/country_property/properties-for-sale-in-'.str_replace(' ','_',$count->name)) }}</loc>
            <lastmod>{{ $count->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
    
    @foreach ($state as $st)
        <url>
            <loc>{{ url('/state/real-estate-for-sale-'.str_replace(' ','_',$st->name)) }}</loc>
            <lastmod>{{ $st->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
    
    @foreach($ptype as $p)
        @foreach($country as $c)
            <url>
                <loc>{{ url('/country/'.str_replace(' ','_',$p->property_type).'-for-sale-in-'.str_replace(' ','_',$c->name)) }}</loc>
                <lastmod>{{ $st->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.6</priority>
            </url>
        @endforeach
    @endforeach
</urlset>
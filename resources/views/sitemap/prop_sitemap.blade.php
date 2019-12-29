<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

@foreach($property as $purl)
   <url>

      <loc>{{ url('/properties/'.$purl->property_url) }}</loc>

      <lastmod>2019-12-24</lastmod>

      <changefreq>daily</changefreq>

      <priority>0.8</priority>

   </url>
@endforeach

</urlset> 
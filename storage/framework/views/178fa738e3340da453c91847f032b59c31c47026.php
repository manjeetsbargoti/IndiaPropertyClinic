<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

<?php $__currentLoopData = $property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <url>

      <loc><?php echo e(url('/properties/'.$purl->property_url)); ?></loc>

      <lastmod>2019-12-24</lastmod>

      <changefreq>daily</changefreq>

      <priority>0.8</priority>

   </url>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</urlset> <?php /**PATH D:\GITHUB\IndiaPropertyClinic\resources\views/sitemap/prop_sitemap.blade.php ENDPATH**/ ?>
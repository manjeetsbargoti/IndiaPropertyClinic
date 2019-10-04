<?php

// namespace App\Console\Commands;

// use App\OtherServices;
// use App\Option;
// use App\SitemapConfig;
// use App\SitemapSetting;
// use App\Property;
// use Illuminate\Console\Command;
// use Illuminate\Support\Facades\App;

// class GenerateSitemap extends Command
// {
//     /**
//      * The name and signature of the console command.
//      *
//      * @var string
//      */
//     protected $signature = 'sitemap:generate';

//     /**
//      * The console command description.
//      *
//      * @var string
//      */
//     protected $description = 'Generates sitemaps for the given url';

//     /**
//      * Create a new command instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         parent::__construct();
//     }

//     /**
//      * Execute the console command.
//      *
//      * @return mixed
//      */
//     public function handle()
//     {
//         $base_url = config('app.url');
//         $per_page = config('sitemap_links');

//         // $sitemap = App::make ("sitemap");
//         $sitemap = \App::make("sitemap");

//         // Property Sitemaps
//         if(config('sitemap_add_properties')){
//             Property::chunk($per_page, function ($properties) use ($sitemap, $base_url) {
//                 static $ctr = 0;
//                 $sitemap_properties = \App::make("sitemap");
//                 foreach ($properties as $property) {
//                     $sitemap_properties->add($base_url . '/properties/' . $property->property_url);
//                 }
//                 $ctr = $ctr + 1;

//                 $sitemap_properties->store('xml', 'sitemaps/sitemap-properties-' . $ctr);
//                 $sitemap_properties->store('html', 'sitemaps/sitemap-properties-' . $ctr);
//                 $sitemap->addSitemap($base_url . '/sitemaps/sitemap-properties-' . $ctr. '.xml');
//                 $sitemap->addSitemap($base_url . '/sitemaps/sitemap-properties-' . $ctr. '.html');
//             });
//         }

//         // Repair Services Sitemaps
//         if(config('sitemap_add_services')){
//             OtherServices::chunk($per_page, function ($rservices) use($sitemap,$base_url) {
//                 static $ctr = 0;
//                 $sitemap_services = \App::make("sitemap");
//                 foreach ($rservices as $rservice) {
//                     $sitemap_services->add($base_url . '/services/' . $rservice->url);
//                 }
//                 $ctr = $ctr + 1;

//                 $sitemap_services->store('xml', 'sitemaps/sitemap-services-' .$ctr);
//                 $sitemap_services->store('html', 'sitemaps/sitemap-services-' .$ctr);
//                 $sitemap->addSitemap($base_url . '/sitemaps/sitemap-services-' .$ctr. '.xml');
//                 $sitemap->addSitemap($base_url . '/sitemaps/sitemap-services-' .$ctr. '.html');
//             });
//         }

//         //Index
//         $sitemap->store('sitemapindex','sitemaps/index');
//     }
// }   

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use Spatie\Sitemap\SitemapGenerator;

    class GenerateSitemap extends Command
    {
        /**
         * The console command name.
         *
         * @var string
         */
        protected $signature = 'sitemap:generate';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Generate the sitemap.';

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle()
        {
            // modify this to your own needs
            SitemapGenerator::create('http://127.0.0.1:8000')
                ->setMaximumCrawlCount(500)
                ->writeToFile(public_path('sitemap.xml'));
        }
    }


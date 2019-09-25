<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdsController extends Controller
{
    // Get Google Ads Code Script
    public function getAdsCode()
    {
        $data['mid_rec_300_250'] = file_get_contents(resource_path('views/admin/google_ads/partials/mid_rec_300_250.blade.php'));
        $data['square_250_250'] = file_get_contents(resource_path('views/admin/google_ads/partials/square_250_250.blade.php'));
        $data['leaderboard_728_90'] = file_get_contents(resource_path('views/admin/google_ads/partials/leaderboard_728_90.blade.php'));
        $data['half_page_300_600'] = file_get_contents(resource_path('views/admin/google_ads/partials/half_page_300_600.blade.php'));
        $data['large_mobile_banner_320_100'] = file_get_contents(resource_path('views/admin/google_ads/partials/large_mobile_banner_320_100.blade.php'));
        $data['wide_skyscraper_160_600'] = file_get_contents(resource_path('views/admin/google_ads/partials/wide_skyscraper_160_600.blade.php'));
        $data['large_leaderboard_970_90'] = file_get_contents(resource_path('views/admin/google_ads/partials/large_leaderboard_970_90.blade.php'));
        $data['banner_468_60'] = file_get_contents(resource_path('views/admin/google_ads/partials/banner_468_60.blade.php'));

        return view('admin.google_ads.google_ads_code', $data);
    }

    // Save Google Ads Code Script to files
    public function postAdsCode(Request $request)
    {
        file_put_contents(resource_path('views/admin/google_ads/partials/mid_rec_300_250.blade.php'), $request->mid_rec_300_250);
        file_put_contents(resource_path('views/admin/google_ads/partials/square_250_250.blade.php'), $request->square_250_250);
        file_put_contents(resource_path('views/admin/google_ads/partials/leaderboard_728_90.blade.php'), $request->leaderboard_728_90);
        file_put_contents(resource_path('views/admin/google_ads/partials/half_page_300_600.blade.php'), $request->half_page_300_600);
        file_put_contents(resource_path('views/admin/google_ads/partials/large_mobile_banner_320_100.blade.php'), $request->large_mobile_banner_320_100);
        file_put_contents(resource_path('views/admin/google_ads/partials/wide_skyscraper_160_600.blade.php'), $request->wide_skyscraper_160_600);
        file_put_contents(resource_path('views/admin/google_ads/partials/large_leaderboard_970_90.blade.php'), $request->large_leaderboard_970_90);
        file_put_contents(resource_path('views/admin/google_ads/partials/banner_468_60.blade.php'), $request->banner_468_60);

        return back();
    }
}

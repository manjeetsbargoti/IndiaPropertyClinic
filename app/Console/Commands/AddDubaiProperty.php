<?php

namespace App\Console\Commands;

use DB;
use Image;
use App\State;
use App\Cities;
use App\Amenity;
use App\Country;
use App\Property;
use App\Services;
use App\PropertyTypes;
use App\PropertyImages;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AddDubaiProperty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:addDubaiProperty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for Add Dubai Property!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "\nLoading Please Wait.......";

        $data_count = DB::table('dubai_properties')->where('city','Dubai')->count();
        // echo "$data_count \n"; die;

        $limit = 1;

        $mod  = $data_count % $limit;
        if($mod != 0){
            $rem = 1;
        }else{
            $rem = 0;
        }
        $count = (int)($data_count / $limit) + $rem;

        $phase = $count;

        // echo "$count \n"; die;

        for($k=0; $k<$phase; $k++){
            $value = $k*$limit;
            $data = DB::table('dubai_properties')->where('city','Dubai')->offset($value)->limit($limit)->get();
            // echo "$data \n";die; 

            // $data = DB::table('dubai_properties')->where('city','Dubai')->take(100)->get();
            $data = json_decode(json_encode($data));

            foreach($data as $key => $val){
                // Maping Property Offering Type
                if($val->offering_type == 'sale'){
                    $data[$key]->offering_type = 4;
                }elseif($val->offering_type == 'rent'){
                    $data[$key]->offering_type = 3;
                }

                // Creating Property URL
                $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $val->pro_title);
                $data[$key]->slug = $slug.'-'.$val->reference;

                // Maping Property Type name
                if($val->t_name == 'Apartment'){
                    $data[$key]->t_name = 1004;
                }elseif($val->t_name == 'Office Space'){
                    $data[$key]->t_name = 1009;
                }elseif($val->t_name == 'Townhouse'){
                    $data[$key]->t_name = 1002;
                }elseif($val->t_name == 'Villa'){
                    $data[$key]->t_name = 1005;
                }elseif($val->t_name == 'Penthouse'){
                    $data[$key]->t_name = 1006;
                }elseif($val->t_name == 'Land' && $val->t_category == 'commercial'){
                    $data[$key]->t_name = 1014;
                }elseif($val->t_name == 'Land' && $val->t_category == 'residential'){
                    $data[$key]->t_name = 1017;
                }elseif($val->t_name == 'Shop'){
                    $data[$key]->t_name = 1010;
                }elseif($val->t_name == 'Warehouse'){
                    $data[$key]->t_name = 1013;
                }elseif($val->t_name == 'Duplex'){
                    $data[$key]->t_name = 1025;
                }elseif($val->t_name == 'Labor Camp'){
                    $data[$key]->t_name = 1026;
                }elseif($val->t_name == 'Retail'){
                    $data[$key]->t_name = 1011;
                }elseif($val->t_name == 'Whole Building'){
                    $data[$key]->t_name = 1003;
                }

                // Maping Furnished Type
                if($val->furnished == 'unfurnished'){
                    $data[$key]->furnished = 'U';
                }elseif($val->furnished == 'furnished'){
                    $data[$key]->furnished = 'F';
                }elseif($val->furnished == 'semi-furnished'){
                    $data[$key]->furnished = 'S';
                }

                // Maping Category
                if($val->t_category == 'residential'){
                    $data[$key]->t_category = 0;
                }else{
                    $data[$key]->t_category = 1;
                }

                // Maping Construction Type
                if($val->status == 'available'){
                    $data[$key]->construction_status = 'Ready to Move';
                }else{
                    $data[$key]->construction_status = '';
                }

                // Maping Map Passed
                if($val->state == 'approved'){
                    $data[$key]->map_passed = 1;
                }elseif($val->state == 'draft'){
                    $data[$key]->map_passed = 0;
                }elseif($val->state == null){
                    $data[$key]->map_passed = null;
                }else{
                    $data[$key]->map_passed = null;
                }

                // Location Maping
                $state = State::where('name',$val->city)->first();
                $city = Cities::where('name','like', '%'.$val->community.'%')->first();
                $city = json_decode(json_encode($city), true);
                // echo "<pre>"; print_r($city);die;
                $data[$key]->state_id = $city['state_id'];
                $data[$key]->country = $state->country;
                $data[$key]->city = $city['id'];

                // Amenities Maping
                $ame = array();
                $i = 0;
                foreach(explode(',',$val->amenities_name) as $am){
                    $amenity = Amenity::where('name','like','%'.$am.'%')->get();
                    $amenity = json_decode(json_encode($amenity), true);
                    // $amenities_name = $amenity->amenity_code;
                    // $data[$key]->amenities_name = $amenity['amenity_code'];
                    foreach($amenity as $amty){
                        $amenities_name = $amty['amenity_code'];
                        if(!empty($amty['amenity_code'])){
                            $amenities_name = $amty['amenity_code']; 
                            $ame[$i] = $amenities_name;
                            $i++;
                        }else{
                            $amenities_name = '';
                        }
                    }
                    $amenities_name = implode(',' , $ame); 
                    $data[$key]->amenities_name = $amenities_name;
                }

                // $data = json_decode(json_encode($data), true);
                // echo "<pre>"; print_r($data);die;
                
            }

            foreach($data as $da)
            {
                DB::beginTransaction();
                try {
                    // insert property to database
                    $value = Property::create([
                        'property_name'         => $da->pro_title,
                        'property_url'          => $da->slug,
                        'property_type_id'      => $da->t_name,
                        'property_code'         => $da->reference,
                        'property_price'        => $da->price_value,
                        'description'           => $da->pro_description,
                        'commercial'            => $da->t_category,
                        'amenities'             => $da->amenities_name,
                        'map_pass'              => $da->map_passed,
                        'furnish_type'          => $da->furnished,
                        'parea'                 => $da->plot_size,
                        'construction_status'   => $da->construction_status,
                        'bedrooms'              => $da->bedrooms,
                        'bathrooms'             => $da->bathrooms,
                        'address1'              => $da->sub_community,
                        'address2'              => $da->tower,
                        'locality'              => $da->community,
                        'country'               => $da->country,
                        'state'                 => $da->state_id,
                        'city'                  => $da->city,
                        'add_by'                => '1',
                        'service_id'            => $da->offering_type,
                        'agent'                 => '1',
                        'meta_title'            => $da->pro_title,
                    ]);
                }catch(ValidationException $e){
                    DB::rollback();
                    return Redirect()->back()->withErrors($e->getErrors())->withInput();
                }catch(\Exception $e){
                    DB::rollback();
                    throw $e;
                }

                try{
                    // Dounloading Property images to folder and saving name to database
                    foreach($data as $key => $val){
                        if($val->images_flink != ''){
                            $image_full = explode(',',$val->images_flink);
                            $image_count = count($image_full);
                        }elseif($val->images_flink == ''){
                            $image_full = '';
                            $image_count = 0;
                        }

                        // echo "<pre>"; print_r($image_count);die;

                        $array_len = $image_count;
                        if($array_len >= 5){
                            for ($j = 0; $j < 5; $j++) {
                                $filename = basename($image_full[$j]);
                                $large_image_path = public_path('images/backend_images/property_images/large/' . $filename);
                                Image::make($image_full[$j])->save($large_image_path);
                                // Image::make($image_full[$j])->save(public_path('/images/dubai_images/' . $filename));
                                
                                // Store image in property folder
                                $propertyimage = PropertyImages::create([
                                    'image_name' => $filename,
                                    // 'image_size' => $image_size,
                                    'property_id' => $value->id,
                                ]);
                            }
                        }elseif($array_len < 5 && $array_len > 0){
                            for ($j = 0; $j < $array_len; $j++) {
                                $filename = basename($image_full[$j]);
                                $large_image_path = public_path('images/backend_images/property_images/large/' . $filename);
                                Image::make($image_full[$j])->save(public_path('/images/dubai_images/' . $filename));
                                
                                // Store image in property folder
                                $propertyimage = PropertyImages::create([
                                    'image_name' => $filename,
                                    // 'image_size' => $image_size,
                                    'property_id' => $value->id,
                                ]);
                            }
                        }elseif($array_len == 0){
                            $filename = "default.jpg";
                            // $property->image = "default.jpg";
                            $propertyimage = PropertyImages::create([
                                'image_name' => $filename,
                                'image_size' => '7.4',
                                'property_id' => $value->id,
                            ]);
                        }
                    }
                }catch(ValidationException $e){
                    DB::rollback();
                    return Redirect()->back()->withErrors($e->getErrors())->withInput();
                }catch(\Exception $e){
                    DB::rollback();
                    throw $e;
                }

                DB::commit();
            }
            // echo "<pre>"; print_r($data);die;
            echo "\nPhase $k Completed...!\n";

        }
        // die;
    }
}

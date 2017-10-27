<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array("Samsung J7 Prime", "Samsung J6", "Samsung J5", "Samsung J4", "Samsung J3", "Samsung J1");

        for ($i=0; $i < 6; $i++){
        	DB::table('products')->insert([
        		'name'=> $products[$i],
                'path'=> "../img/abc.jpeg",
        		'description'=> "This is Android Samsung Model",
        		'category_id'=> "1",
        		'price'=> rand(1,50).".00",
        		'stocks'=> rand(5, 10),
        		'barcode'=> "SAMSUNG".str_random(5),
        		'created_at'=>Carbon::now()
        	]);
        	echo $i+1;
        }
    }
}

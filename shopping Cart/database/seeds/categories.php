<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = array("Samsung", "ASUS", "Cherry Mobile", "iPhone", "VIVO");
        $i = 0;

        while ($i < 5) {
        	DB::table('product_categories')->insert([
        		'name'=> $categories[$i],
        		'created_at'=>Carbon::now()
        	]);

        	$i++;
        	echo $i;
        }

    }
}

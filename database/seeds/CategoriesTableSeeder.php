<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Мобильные телефоны',
                'code' => 'mobiles',
                'description' => 'В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!',
                'image' => 'categories/mobile.jpeg'
            ],
            [
                'name' => 'Портативная техника',
                'code' => 'portable',
                'description' => 'Раздел с портативной техникой.',
                'image' => 'categories/portable.jpeg'
            ],
            [
                'name' => 'Бытовая техника',
                'code' => 'technics',
                'description' => 'Раздел с бытовой техникой',
                'image' => 'categories/appliance.jpeg'
            ]
        ]);
    }
}

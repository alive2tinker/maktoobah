<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ['name_en' =>"Saudi Arabia", 'name_ar' => "المملكة العربية السعودية"],
            ['name_en' =>"United Arab Emirates", 'name_ar' => "الإمارات العربية المتحدة"],
            ['name_en' =>"Kuwait", 'name_ar' => "الكويت"],
            ['name_en' =>"Bahrain", 'name_ar' => "البحرين"],
            ['name_en' =>"Oman", 'name_ar' => "عمان"],
        ]);
    }
}

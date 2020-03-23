<?php

use Illuminate\Database\Seeder;

use App\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name' => 'Fergie\'s Blog',
            'phone_number' => '156-59-809061',
            'email'=> 'Akinfergie@gmail.com',
            'address' => 'Baoan District, Shenzhen, China',
            'about' => 'This blog is written by Fergie as one of his latest laravel projects. To see more of his projects,
                        visit his git at github.com/olusegunakindipe'
        ]);
    }
}

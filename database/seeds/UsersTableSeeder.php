<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'name' => 'Fergie',
            'email'=> 'Akinfergie@gmail.com',
            'password' => bcrypt('11111111'),
            'admin' => 1
        ]);

        App\Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/pics.jpg',
            'about' => 'This is about the administrator of this page',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'
        ]);
    }
}

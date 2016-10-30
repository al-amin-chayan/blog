<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //Source: https://packagist.org/packages/fzaninotto/faker           
        factory(User::class, 5)->create()->each(function ($user) {
            $user->profile()->save(factory(Profile::class)->make());
        });
    }

}

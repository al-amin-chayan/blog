<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //Article::truncate();
        
        User::all()->each(function ($user) {
            $user->articles()->saveMany(factory(Article::class, 5)->make());
        });
    }

}

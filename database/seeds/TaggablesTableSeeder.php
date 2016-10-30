<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Video;
use App\Models\Tag;

class TaggablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $articles = Article::all();
        foreach ($articles as $article) {
            $article->tags()->attach($faker->randomElements(Tag::pluck('id')->toArray(), mt_rand(2, 4)));
        }
        
        $videos = Video::all();
        foreach ($videos as $video) {
            $video->tags()->attach($faker->randomElements(Tag::pluck('id')->toArray(), mt_rand(2, 4)));
        }
    }
}

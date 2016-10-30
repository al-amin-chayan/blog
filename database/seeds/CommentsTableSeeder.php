<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Video;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //Comment::truncate();
        
        $articles = Article::all();
        foreach ($articles as $article) {
            $article->comments()->saveMany(factory(Comment::class, mt_rand(2, 8))->make());
        }
        
        $videos = Video::all();
        foreach ($videos as $video) {
            $video->comments()->saveMany(factory(Comment::class, mt_rand(2, 8))->make());
        }
    }

}

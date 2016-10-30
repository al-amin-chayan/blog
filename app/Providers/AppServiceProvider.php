<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap(array(
            'articles' => \App\Models\Article::class,
            'videos' => \App\Models\Video::class,
            'galleries' => \App\Models\Gallery::class,
            'professions' => \App\Models\Profession::class,
            'subjects' => \App\Models\Subject::class,
            'tags' => \App\Models\Tag::class,
            'users' => \App\Models\User::class,
        ));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

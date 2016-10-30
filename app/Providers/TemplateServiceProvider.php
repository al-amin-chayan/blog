<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TemplateServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        /*
         * If you don't want to share same data in both  views, than
         * it is better to use different composer
         */
        View::composer(
            ['layouts.nav', 'layouts.sidebar'], 'App\Http\ViewComposers\TemplateComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}

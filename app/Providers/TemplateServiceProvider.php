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
        /**
         * View composers are called when a view is rendered.
         * 1. It can not replaced during run time (in controller).
         * 2. After run return View::make() - which means the view is 'created', and then returned to the Laravel core where it is then *    'composed' to screen. This is when the View::composer() is called (i.e. after the view has returned).
         **/
        View::composer('layouts.sidebar', 'App\Http\ViewComposers\ProfessionComposer');

        /**
         * View Creator executed immediately after the view is instantiated before it is render.
         * 1. It can be replaced during run time (in controller).
         * 2. View::creators() are called when a view is instantiated - and during the View::make() command. And before the View::make()
         *    function is returned.
         * 3. Another difference is that an Exception thrown within a ViewCreator will bubble back up to the Controller. This is handy *    for authorizations. In the ViewCreator you can get permissions data, then if the user is not authorized for that page, *     throw an exception and let the controller handle it.
         **/
        View::creator('layouts.nav', 'App\Http\ViewCreators\SubjectCreator');
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

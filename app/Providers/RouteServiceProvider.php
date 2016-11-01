<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\Article;
use Auth;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $apiNamespace = 'App\Http\Controllers\Front';
    
    protected $webNamespace = 'App\Http\Controllers\Front';
    
    protected $adminNamespace = 'App\Http\Controllers\Admin';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot() {
        parent::boot();
        $this->bind('article', function ($id) {
            return Article::where([
                        ['id', $id],
                        ['user_id', Auth::user()->id],
                    ])->firstOrFail();
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map() {
        $this->mapApiRoutes();
        $this->mapAdminRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes() {
        Route::group([
            'prefix' => 'admin',
            'middleware' => 'web',
            'namespace' => $this->adminNamespace,
                ], function ($router) {
            require base_path('routes/admin.php');
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes() {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->webNamespace,
                ], function ($router) {
            require base_path('routes/web.php');
        });
    }
    
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes() {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->apiNamespace,
            'prefix' => 'api',
                ], function ($router) {
            require base_path('routes/api.php');
        });
    }

}

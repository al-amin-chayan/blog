<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Models\Gallery;

class FrontController extends Controller {

    private $galleries;
    
    public function __construct() {

        $this->setGalleries();
        
        /*
         * View::share is really straight forward it sets a variable which can be 
         * used within any of the views, think of it like a global variable.
         * It simply sets a variable
         */     
        //View::share('galleries', $this->getGalleries());

        /*
         * View::composer registers an event which is called when the view is rendered
         * It is a callback function.
         */
        View::composer('layouts.sidebar', function ($view) {
            $view->with('galleries', $this->getGalleries());
        });
    }

    private function setGalleries() {
        $this->galleries = Gallery::whereHas('videos', function ($query) {
                    $query->where('display', 'Y');
                })->where('display', 'Y')
                ->withCount(['videos' => function ($query) {
                    $query->where('display', 'Y');
                }])
                ->get();
    }

    protected function getGalleries() {
        return $this->galleries;
    }
}

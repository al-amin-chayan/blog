<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController AS Controller;
use App\Models\Tag;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::whereHas('views', function ($query) {
                    $query->orderBy('view_count', 'desc');
                })->with(['views' => function($query) {
                    $query->select('view_count');
                }])->select(['id', 'name', 'slug'])
                        ->take(5)
                        ->get();
        return view('admin.welcome.index');
    }
}

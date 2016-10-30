<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController AS Controller;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.welcome.index');
    }
}

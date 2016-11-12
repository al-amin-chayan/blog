<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use View;

class AdminController extends Controller
{
    public function __construct() {

        View::share('layouts', 'admin.layouts.app');
    }
}

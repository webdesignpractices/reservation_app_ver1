<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class AdminMenuController extends Controller
{
    public function index(){
        $menus = Service::all();
        return view('admin.nav.menu',['menus' => $menus]);
    }
}

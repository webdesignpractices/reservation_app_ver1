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

    public function create(){
        return view(route('admin.menu.create'));
    }

    public function store(){
        return redirect()->route('');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\Admin\NewMenuCreate;

class AdminMenuController extends Controller
{
    public function index(){
        $menus = Service::all();
        return view('admin.nav.menu',['menus' => $menus]);
    }

    public function create(){
        return view('admin.menu.menu_create');
    }

    public function store(NewMenuCreate $request){
        $validated = $request->validated();
        Service::create($validated);

        return redirect()->route('admin.nav.menus.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\Admin\NewMenuCreate;

class AdminMenuController extends Controller
{
    public function index(){
        $menus = Service::where('is_active',true)->get();
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

    public function archive(Request $request, Service $menu){
        $menu->update(['is_active' => false,]);
        return redirect()->route('admin.archived.menu');
    }

    public function archivedMenu(){
        $archivedMenus = Service::where('is_active' , false)->get();
        return view('admin.menu.archived_menu',['archivedMenus' => $archivedMenus]);
    }
}

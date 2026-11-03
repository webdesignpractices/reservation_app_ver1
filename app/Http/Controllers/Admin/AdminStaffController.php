<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;

class AdminStaffController extends Controller
{
    public function index(){
        $staff_s = Staff::all();
        return view('admin.nav.staff',['staff_s' => $staff_s]);
    }

    public function edit(Staff $staff){
        return view('admin.menu.staff_edit',['staff' => $staff]);
    }

    public function update(Request $request ,Staff $staff){
        $staff->update([
            'name' => $request->update_name,
            'description' => $request->update_description,
        ]);

        return redirect()->route('admin.staff.index',['staff' => $staff]);
    }
}

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
}

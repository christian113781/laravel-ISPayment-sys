<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOmadaController extends Controller
{
    public function index (){
        return view('admin.pages.omadacloud_manage');
    }
}

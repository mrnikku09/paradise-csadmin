<?php

namespace App\Http\Controllers\csadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Hash;
use File;
use Session;



class DashboardController extends Controller{
    public function index()
    {
        $title="Dashboard";
        return view('csadmin.dashboard.index',compact('title'));
    }

}
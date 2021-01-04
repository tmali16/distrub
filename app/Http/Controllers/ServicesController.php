<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //

    public function index()
    {
        $page = "Справочники";
        return view("directory.index", ['page'=>$page]);
    }
}

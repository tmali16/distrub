<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistrubController extends Controller
{
    //
    private $page = "Главная";

    public function index()
    {
        $page = "Нарушения";
        return view('distrub.page', array("page"=>$page));
    }
}

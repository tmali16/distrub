<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    //

    public function index()
    {
        $page = "Видео";

        return view('media.index', ['page'=>$page]);
    }
}

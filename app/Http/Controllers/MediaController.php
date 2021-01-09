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
        
        try {
            //$fi = "2021/1/37737";
            //$f = Storage::disk('public')->directories();//Storage::disk('media')->files($fi);     
            //dd($f);       
        } catch (Exception $th) {
            print_r($th->getMessage());
        }
        // foreach ($f as $key => $value) {
        //     echo $value."<br>";
        // }
        $g =  Storage::disk("media")->url($f[0]);
        //dd($g);
        return view('media.index', ['page'=>$page, 'video'=>$f[0], 'g'=>$g]);
    }
}

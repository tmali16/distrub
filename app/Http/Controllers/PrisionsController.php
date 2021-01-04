<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prisions;
use App\Models\Services;
use App\Models\DistrubType;


class PrisionsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function list()
    {
        $prisison =Prisions::all();
        $service = Services::all();
        $DistrubType = DistrubType::all();
        $data = [
          'prision'=>$prisison,
          'service'=>$service,
          'distrubType'=>$DistrubType
        ];
        return response()->json($data, 200);
    }
}

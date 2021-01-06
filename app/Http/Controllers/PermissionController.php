<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;

class PermissionController extends Controller
{
    //

    private $status = 200;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $page = "Роли";
        
        return view('admin.role', compact( 'page'));
    }
    public function list()
    {
        $role = Role::all();
        $data =[
            'status'=>$this->status,
            'data'=>[
                'roles'=>$role
            ]
        ];
        return response($data);
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;

use Illuminate\Support\Str;

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
        $role = Role::with('users.userPermissions', 'permissions')->get();
        $permission = Permission::with('users', 'roles')->get();
        $model = $this->getClass();
        $data =[
            'status'=>$this->status,
            'data'=>[
                'roles'=>$role,
                'permissions'=>$permission,
                'models'=>$model
            ]
        ];
        return response($data);
    }
    public function getClass()
    {
        $name = [];
        $storage = array_diff(scandir(base_path("app\Models\\"), 1), ['..','.']); //('local')->directories();
        foreach ($storage as $key => $value) {
            $name[] = Str::of($value)->replace('_',' ')->split("/\./")[0];
        }
        return ($name);
    }
    public function create(Request $request)
    {
        //dd($request->all());
        try{
            if ($request->id != null) {
                if($request->model != null && $request->level == null){
                    $model = Permission::find($request->id);
                    $model->model = $request->model;
                }
                else if($request->model == null && $request->level != null){
                    $model = Role::find($request->id);
                    $model->level = $request->level;
                }else{
                    $this->status = 200;
                    $data = [
                        'status'=>$this->status,
                        'data'=>'Ошибка измененияб выберите данные'
                    ];
                }
            } else {
                if($request->model != null && $request->level == null){
                    $model = new Permission();
                    $model->model = $request->model;
                }
                else if($request->model == null && $request->level != null){
                    $model = new Role();
                    $model->level = $request->level;
                }else{
                    $this->status = 200;
                    $data = [
                        'status'=>$this->status,
                        'data'=>'Ошибка измененияб выберите данные'
                    ];
                }
            }
            $model->name = $request->name;
            $model->slug = $request->slug;
            $model->description = $request->description;
            $model->save();
            if($request->model == null && $request->level != null && !empty($request->permissions)){
                // $model->detuchAllPermissions();
                foreach ($request->permissions as $key => $value) {
                    $model->attachPermission($value['id']);
                }
            }
            $this->status = 200;
            $data = [
                'status'=>$this->status,
                'data'=>'Данные сохранены'
            ];
        }catch(\Exception $ex){
            $this->status = 500;
            $data = [
                'status' =>$this->status,
                'data' =>$ex->getMessage(),
            ];
        }
        return response($data);
    }

    public function update(Request $request)
    {
        try{
            $this->create($request);
            if ($this->status == 200) {
                $data = [
                    'status'=>$this->status,
                    'data'=>'Данные обновлены успешно'
                ];
            } else {
                $data = [
                    'status'=>$this->status,
                    'data'=>'Ошибка обновления данных'
                ];
            }
        }catch(\Exception $ex){
            $this->status = 500;
            $data = [
                'status' =>$this->status,
                'data' =>$ex->getMessage(),
            ];
        }
        return response($data);
    }
    public function deleteRole(Request $request)
    {
        try{
            if($request->model == null && $request->level != null){
                $model = Role::find($request->id);
            }else{
                $model = Permission::find($request->id);
            }
            $model->delete();
            $this->status = 200;
            $data = [
                'status'=>$this->status,
                'data'=>'Данные удалены успешно'
            ];
        }catch(\Exception $ex){
            $this->status = 500;
            $data = [
                'status' =>$this->status,
                'data' =>$ex->getMessage(),
            ];
        }
        return response($data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prisions;
use App\Models\Services;
use App\Models\DistrubType;


class PrisionsController extends Controller
{
    //
    private $status = 200;
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

    
    public function get(Request $request)
    {
        $limit = $request->limit ?? 10;
        $prisison =Prisions::paginate($limit);
        return response()->json($prisison);
    }

    public function all()
    {
        $prisison =Prisions::all();
        return response()->json($prisison);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {        
        try {
            if($request->id != null){
                $Prisions = Prisions::find($request->id);
            }else{
                $Prisions = new Prisions();
            }
            $Prisions->name = $request->name;            
            if($Prisions->save()){
                $this->status = 200;
                $data = [
                    'status'=>$this->status,
                    'data'=>'Данные добавлены успешно'
                ];
            }else{
                $this->status = 500;
                $data = [
                    'status'=>$this->status,
                    'data'=>'Ошибка добавление данных'
                ];
            }
        } catch (\Exception $th) {
            $this->status = 500;
            $data = [
                'status'=>$this->status,
                'data'=>'Ошибка при добавлении данных: '.$th->getMessage()
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $this->create($request);
        if($this->status == 200){
            $data = [
                'status'=>$this->status,
                'data'=>'Данные обновлены'
            ];
        }else{
            $data = [
                'status'=>$this->status,
                'data'=>'Ошибка обновления данных'
            ];
        }
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $Prisions = Prisions::find($id);
            if(!empty($Prisions)){
                $Prisions->delete();
                $this->status = 200;
                $data = [
                    'status'=>$this->status,
                    'data'=>'Запись удалена успешно'
                ];
            }else{
                $this->status = 500;
                $data = [
                    'status'=>$this->status,
                    'data'=>'Ошибка удаления записи'
                ];
            }

        } catch (\Exception $th) {
            $this->status = 500;
            $data = [
                'status'=>$this->status,
                'data'=>'Ошибка при добавлении данных: '.$th->getMessage()
            ];
        }
        return response()->json($data);
    }
}

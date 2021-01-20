<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\DistrubType;
use App\Models\VideoRecorder;

class ServicesController extends Controller
{
    //
    private $status = 200;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $page = "Справочники";
        return view("directory.index", ['page'=>$page]);
    }

    public function response()
    {
        $services = Services::all();
        $distrubType = DistrubType::all();
        $dvr = VideoRecorder::all();
        $this->status = 200;

        $data = [
            'status'=>$this->status,
            'data'=>[
                'services'=>$services,
                'distrubType'=>$distrubType,
                'dvr'=>$dvr
            ]
        ];

        return response()->json($data, 200);
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
                $services = Services::find($request->id);
            }else{
                $services = new Services();
            }
            $services->fullname = $request->fullname;
            $services->shortname = $request->shortname;
            if($services->save()){
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DistrubType  $distrubType
     * @return \Illuminate\Http\Response
     */
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
            $services = Services::find($id);
            if(!empty($services)){
                $services->delete();
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

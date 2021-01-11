<?php

namespace App\Http\Controllers;

use App\Models\DistrubType;
use Illuminate\Http\Request;

class DistrubTypeController extends Controller
{

    private $status = 200;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                $distrub_type = DistrubType::find($request->id);
            }else{
                $distrub_type = new DistrubType();
            }
            $distrub_type->name = $request->name;
            if($distrub_type->save()){
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DistrubType  $distrubType
     * @return \Illuminate\Http\Response
     */
    public function show(DistrubType $distrubType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DistrubType  $distrubType
     * @return \Illuminate\Http\Response
     */
    public function edit(DistrubType $distrubType)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DistrubType  $distrubType
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $distrub_type = DistrubType::find($id);
            if(!empty($distrub_type)){
                $distrub_type->delete();
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

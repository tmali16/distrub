<?php

namespace App\Http\Controllers;

use App\Events\Monitor;
use Illuminate\Http\Request;
use App\Models\Prisions;
use App\Models\VideoRecorder;

class VideoRecorderController extends Controller
{
    //
    private $status = 200;
    public function getPrisions()
    {
        $prisions = Prisions::with('dvr')->get();        
        $d = collect($prisions)->map(function($item, $key){
            $ret['name'] = $item['name'];
            $ret['dvr']=collect($item->dvr)->map(function ($it, $ke) 
                        {                            
                            $status['name']= $it['name'];
                            $status['obj_id']= $it['obj_id'];
                            $status['status'] = $this->parsePrtg($it['obj_id'])['sensordata'];
                            return $status;
                        });
            return $ret;
        });
        // dd($d);
        
        return response()->json($d, 200);
    }

    public function all(Request $request)
    {
        $limit = $request->limit ?? 10;
        $dvr = VideoRecorder::paginate($limit);
        return response()->json($dvr);        
    }
    public function create(Request $request)
    {
        try {
            if($request->id != null){
                $dvr = VideoRecorder::find($request->id);
            }else{
                $dvr = new VideoRecorder();
            }
            $dvr->name = $request->name;
            $dvr->obj_id = $request->obj_id;
            $dvr->prision_id = $request->prision['id'];
            if($dvr->save()){
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
            $dvr = VideoRecorder::find($id);
            if(!empty($dvr)){
                $dvr->delete();
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
    public function parsePrtg($id)
    {
        $hash = 3488256850;
        try {
            $client = new \GuzzleHttp\Client(['base_uri' => 'http://10.9.22.25/api/']);            
            $resp = $client->request('GET', 'getsensordetails.json?id='.$id.'&username=desmi&passhash='.$hash);
            $res = (string)($resp->getBody());
        } catch (\Throwable  $th) {
            $res = [
                'status'=>500,
                'data'=>($th->getMessage())
            ];
        }
        
        return json_decode($res, true);
    }

    public function Notify(Request $request)
    {
        $te = $request->all();
        Monitor::dispatch($te);        
        return $te;
    }
}

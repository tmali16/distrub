<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Distrub;
use App\Models\DistrubType;
use App\Models\Services;
use App\Models\Operators;
use App\Models\Media;
use App\Models\Prisions;
use Illuminate\Support\Str;
use Exception;

use function React\Promise\reduce;

class DistrubController extends Controller
{
    //
    private $page = "Главная";
    private $ActStatus = 200;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $page = "Нарушения";
        return view('distrub.page', array("page"=>$page));
    }

    public function list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'limit' => ['required', 'integer','min:10'],
        ]);
        if($validator->fails()){
            $this->ActStatus = 500;
            $data = [
                'status'=>$this->ActStatus,
                'data'=>$validator->messages()
            ];
        }else{
            $limit = $request->limit;
            $distrub = Distrub::all();
            $this->ActStatus = 200;
            $data = [
                'status'=>$this->ActStatus,
                'data'=>$distrub
            ];
        }
        return response()->json($data, 200);
    }
    public function chart(Request $request)
    {

        $start = date("Y-m-d",strtotime($request->start));
        $end =date("Y-m-d",strtotime($request->end));;
        $label = [];
        $distrub = Distrub::whereBetween('dates', [$start, $end])->orderBy('dates')->get();
        $dat = [];
        $monthes = array(
            '01' => 'Января', '02' => 'Февраля', '03' => 'Марта', '04' => 'Апреля',
            '05' => 'Мая', '06' => 'Июня', '07' => 'Июля', '08' => 'Августа',
            '09' => 'Сентября', '10' => 'Октября', '11' => 'Ноября', '12' => 'Декабря'
        );
        foreach ($distrub as $key =>$i) {
            $dt = date("d-m-Y",strtotime($i->dates));
            if(!in_array($dt, $label)){
                $label[] = $dt;
                $dat[] = $distrub->where('dates', $i->dates)->count();
            }
        }
        $data = [
            'labels'=>$label,
            'datasets'=>[[
                'type'=> '',
                'label'=>'Нарушения',
                'backgroundColor'=>'rgba(255, 0, 0, 0.3)',
                'borderColor'=>'#269dff',
                'data'=>$dat,
                'borderWidth'=> 2,
                'pointRadius'=>2

            ],
        ],
        ];
        return response()->json($data, 200);
    }

    public function asPrison(Request $request)
    {
        // $start = date("Y-m-d",strtotime($request->start));
        // $end =date("Y-m-d",strtotime($request->end));
        $label = [];
        //$distrub = Distrub::whereBetween('dates', [$start, $end])->orderBy('dates')->get();
        $dat = [];
        $color = [];
        $prisions = Prisions::all();
        $datasets= [];

        foreach ($prisions as $key => $p) {
            $label[] = $p->name;
            $dat[] = Distrub::where('prision_id', $p->id)->count();
            $color = 'rgba('.random_int(0, 255).', '.random_int(0, 255).', '.random_int(0, 255).', 1)';
        }

        $data = [
            'labels'=>$label,
            'datasets'=>[
                [
                    'label'=>'Нарушение',
                    'backgroundColor'=>$color,
                    'borderColor'=>'#269dff',
                    'data'=>$dat,
                    'borderWidth'=> 2,
                    'pointRadius'=>2
                ]
            ]
        ];

        return response()->json($data, 200);
    }
    
    public function create()
    {
        $this->page = "Новое нарушение";
        $operator = Operators::all();
        $distrub = new Distrub();
        $services = Services::all();
        $distrub_types = DistrubType::all();
        $prisions = Prisions::all();
        return view("distrub.create",[
            'page'=>$this->page, 
            'operator'=>$operator, 
            'distrub'=>$distrub,
            'services'=>$services,
            'DistrubTypes'=>$distrub_types,
            'prisions'=>$prisions,
        ]);
    }

    public function storeNew(Request $request)
    {
        $data = ['data'=>''];
        if($request->id != null){
            $distrub = Distrub::findOrFail($request->id);
        }else{
            $distrub = new Distrub();
        }
        $validated  = $request->validate([
            'descript' => 'required',
            'prision' => 'required',
            'operator' => 'required',
            'reg_num' => 'required',
            'reg_date' => 'required',        
        ]);
        if($validated ){
            
            $distrub->descript = $request->get("descript");
            $distrub->dates = date("Y-m-d", strtotime($request->get("date_time")));
            $distrub->times = date("H:i:s", strtotime($request->get("date_time")));
            $distrub->whom = $request->get("whom");
            $distrub->serviced = $request->get("services");
            $distrub->reg_num = $request->get("reg_num");
            $distrub->reg_date = $request->get("reg_date");
            $distrub->dvr_type = $request->get("dvr_type");
            $distrub->dvr_num = $request->get("dvr_num");
            $distrub->distrub_type = $request->get("distrub_type");
            $distrub->prision_id = $request->get("prision");
            $distrub->operator_id = $request->get("operator");
            $distrub->user_id = auth()->user()->id;
            try{
                $distrub->save();                
                if($request->file('file')[0] != null){
                    $files = $request->file('file');                    
                    foreach ( $files as $value) {                        
                        $r = $this->saveImgAsFile($value);                        
                        $media = new Media();
                        $media->path = $r;                        
                        $media->save();
                        $distrub->media()->attach($media->id);
                    }
                }
                $this->ActStatus = 200;
                $data = [
                    'status'=>$this->ActStatus,
                    'data'=>"Нарушение добавлено"
                ];
            }catch(\Exception $ex){
                $this->ActStatus = 500;
                
                return redirect()->back()->withErrors($ex->getMessage(), 'Excep');
            }
        }
        return redirect()->back()->with('status', $data['data']);
        
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descript' => ['required', 'string'],
            'reg_num' => ['required'],
            'reg_date' => ['required'],
        ]);
        if($validator->fails()){
            $this->ActStatus = 500;
            $data = [
                'status'=>$this->ActStatus,
                'data'=>$validator->messages()
            ];
        }else{
            if($request->id != null){
                $distrub = Distrub::findOrFail($request->id);
            }else{
                $distrub = new Distrub();
            }

            $distrub->descript = $request->descript;
            $distrub->dates = date("Y-m-d", strtotime($request->datetime));
            $distrub->times = date("H:i:s", strtotime($request->datetime));
            $distrub->whom = $request->whom;
            $distrub->serviced = $request->service['id'];
            $distrub->reg_num = $request->reg_num;
            $distrub->reg_date = $request->reg_date;
            $distrub->dvr_type = $request->dvr_type;
            $distrub->dvr_num = $request->dvr_num;
            $distrub->distrub_type = $request->distrub_type['id'];
            $distrub->prision_id = $request->prision['id'];
            $distrub->operator_id = $request->operator['id'];
            $distrub->user_id = auth()->user()->id;

            try{
                $distrub->save();
                if($request->file != null){
                    foreach ($request->file as $key => $value) {
                        $r = $this->saveImg($value);
                        $media = new Media();
                        $media->path = $r;
                        $media->save();
                        $distrub->media()->attach($media->id);
                    }
                }
                $this->ActStatus = 200;
                $data = [
                    'status'=>$this->ActStatus,
                    'data'=>"Нарушение добавлено"
                ];
            }catch(\Exception $ex){
                $this->ActStatus = 500;
                $data = [
                    'status'=>$this->ActStatus,
                    'data'=>"Ошибка сохранение нарушения: ".$ex->getMessage()
                ];
            }
        }
        return response()->json($data, 200);
    }
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:App\Models\Distrub,id'],
        ]);
        if($validator->fails()){
            $data = [
                'status'=>500,
                'data'=>$validator->messages()
            ];
        }else{
            try{
                $re = $this->store($request);
                if($this->ActStatus == 200){
                    $this->ActStatus = 200;
                    $data = [
                        'status'=>$this->ActStatus,
                        'data'=>"Обновление добавлено"
                    ];
                }else{
                    $data = $re;
                }
            }catch(\Exception $ex){
                $this->ActStatus = 500;
                $data = [
                    'status'=>$this->ActStatus,
                    'data'=>"Ошибка обновления нарушения: ".$ex->getMessage()
                ];
            }
        }
        return response()->json($data, 200);
    }
    public function show($id)
    {
        $distrub = Distrub::findOrFail($id);
        $distrubs = Distrub::all();
        $page = "Просмотр нарушения";

        return view('distrub.view', ['distrub'=>$distrub, 'page'=>$page, 'distrubs'=>$distrubs]);
    }
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:App\Models\Distrub,id'],
        ]);
        if($validator->fails()){
            $data = [
                'status'=>500,
                'data'=>$validator->messages()
            ];
        }else{
            try{
                $distrub = Distrub::findOrFail($request->id);
                $distrub->delete();
                $this->ActStatus = 200;
                $data = [
                    'status'=>$this->ActStatus,
                    'data'=>"Запись удалена успешно"
                ];

            }catch(\Exception $ex){
                $this->ActStatus = 500;
                $data = [
                    'status'=>$this->ActStatus,
                    'data'=>"Ошибка удаления нарушения: ".$ex->getMessage()
                ];
            }
        }
        return response()->json($data, 200);
    }
    private function saveImg($ph)
    {
        
        $d = explode(',', $ph);
        preg_match("/image\/(\w+)/",$d[0], $res);
        $path ="storage/img/".Str::slug(Str::uuid()).'.'.strtolower($res[0]);
        $f = fopen($path, 'wb');
        fwrite($f, base64_decode($d[1]));
        fclose($f);        
        return $path;
    }
    private function saveImgAsFile($ph)
    {        
        $mim = $ph->getClientOriginalExtension();
        $path ="storage/img/";
        $fname = Str::slug(Str::uuid()).'.'.strtolower($mim);
        $ph->move($path, $fname);
        return $path.$fname;
    }
}

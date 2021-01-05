<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Operators;
use App\Models\Rank;


class OperatorsController extends Controller
{
    //
    private $page = "Сотрудники";
    public function __construct()
    {
        $this->middleware('auth');
    }  
    public function index()
    {
        $page = "Сотрудники";
        return view("employe.index", ["page"=>$page]);
    }
    public function all()
    {
        $data = Operators::with('rank')->get();
        
        return response()->json($data);
    }
    public function list()
    {
        $data = Operators::with('rank')->paginate(10);
        $headers = [];
        return response()->json($data, 200, $headers);
    }

    public function getRanks()
    {
        $data = Rank::all();
        $headers = [];
        return response()->json($data, 200, $headers);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => ['required', 'min:3'],
            'name' => ['required', 'min:3'],
            'rank.id' => ['required'],
        ]);
        if($validator->fails()){
            $data = [
                'status'=>500,
                'data'=>$validator->messages()
            ];
        }else{
            $operat = new Operators();
            $operat->fname = $request->input("fname");
            $operat->name = $request->input("name");
            $operat->lname = $request->input("lname") ?? null;
            $operat->rank_id = $request->input("rank")['id'];
            if($operat->save()){
                $data = [
                    "status"=>200,
                    'data'=>"Оператор добавлен"
                ];
            }else{
                $data = [
                    "status"=>500,
                    'data'=>"Ошибка добавления оператора"
                ];
            }
        }
        return response()->json($data, 200);
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:App\Models\Operators,id'],
            'fname' => ['required', 'min:3'],
            'name' => ['required', 'min:3'],
            'rank.id' => ['required'],
        ]);
        if($validator->fails()){
            $data = [
                'status'=>500,
                'data'=>$validator->messages()
            ];
        }else{
            $id = $request->input("id");
            $operat = Operators::find($id);
            $operat->fname = $request->input("fname");
            $operat->name = $request->input("name");
            $operat->lname = $request->input("lname") ?? null;
            $operat->rank_id = $request->input("rank")['id'];
            if($operat->save()){
                $data = [
                    "status"=>200,
                    'data'=>"Данные оператора обновлены"
                ];
            }else{
                $data = [
                    "status"=>500,
                    'data'=>"Ошибка обновления данных оператора"
                ];
            }
        }
        return response()->json($data, 200);
    }
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:App\Models\Operators,id'],
            'fname' => ['required', 'min:3'],
            'name' => ['required', 'min:3'],
            'rank.id' => ['required'],
        ]);
        if($validator->fails()){
            $data = [
                'status'=>500,
                'data'=>$validator->messages()
            ];
        }else{
            $id = $request->input("id");
            $operat = Operators::find($id);
            if($operat->delete()){
                $data = [
                    "status"=>200,
                    'data'=>"Данные оператора удалены"
                ];
            }else{
                $data = [
                    "status"=>500,
                    'data'=>"Ошибка удаления данных оператора"
                ];
            }
        }
        return response()->json($data, 200);
    }
}

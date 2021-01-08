<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class HomeController extends Controller
{
    private $page = "Главная";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = "Главная";
        return view('home', ['page' => $page]);
    }

    public function users()
    {
        $users = User::all();
        $page = "Пользователи";

        return view('admin.user', ['users' => $users, "page" => $page]);
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        $pass = 0;
        $page = "Пользователи";
        $roles = Role::all();
        return view('admin.user_edit', ['user' => $user, 'pass' => $pass, 'page' => $page, 'roles' => $roles]);
    }
    public function userEditStore(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->get("name");
        $user->username = $request->get("username");
        $user->update();
        if(!$user->checkRole($request->get('role'))){
            $user->detachAllRoles();
            $user->attachRole($request->get('role'));
        }
        return redirect()->route('users')->with('status', "Пользователь добавлен");
    }
    public function userPassEdit(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
        $user = User::findOrFail($request->get('id'))->update([
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect()->route('users')->with('status', "Пароль изменена");
    }
    public function userDelete(Request $request)
    {
        $id = $request->get("id");
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users')->with('status', "Пользователь удален");
    }
}

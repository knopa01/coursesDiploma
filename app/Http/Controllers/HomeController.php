<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
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
        return view('home');
    }
    public function  settings_form() {
        $user_info = User::find(Auth::id());
        $groups = Group::all();
        $group_name = Group::where('id', '=', $user_info->user_group_id)->get();
        if($group_name->count() != 0) {
            $group_name = $group_name[0]->group_name;
        }
        $msg = request()->msg;

        return view("layouts.settings", compact('user_info', 'groups', 'group_name', 'msg'));

    }

    public function  save_settings() {
    //dd(request());
    //dd(User::where('email', '=', request()->email)->get());
        $validator = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', function($attribute, $value, $fail){
                if($user = User::find(Auth::id())->email != request()->email) {
                    if(count(User::where('email', '=', request()->email)->get()) != 0) {
                        //dd(User::where('email', '=', request()->email)->get());
                        $fail('Данная почта уже зарегистрирована!');
                    }
                }
            }],
            'usergroup' => function($attribute, $value, $fail) {
                //dd(request()->usergroup);

                if(request()->usertype == "student") {
                    if(request()->usergroup == null) {
                        //dd(request()->usergroup);
                        //return "Выберите значение";
                        //dd("tut");
                        $fail('Выберете группу!');
                    }

                }


            },
            'password' => function($attribute, $value, $fail) {


                if(is_string(request()->password) == false) {
                    $fail('Пароль должен быть строкой!');
                }
                if(request()->password == "" || request()->password == null) {
                    $fail('Введите пароль!');
                }
                if(strlen(request()->password) < 8 ) {
                    $fail('Пароль должен быть не меньше 8 символов!');
                }
                if(request()->password != request()->password_confirmation) {
                    $fail("Пароли не совпадают!");
                }
            },
        ],[
            'usergroup' => "Выберите значение!",
            'email.required' => "Введите e-mail!",

        ]);
        $email = request()->email;
        $password = request()->password;

        $usergroup = request()->usergroup;
        //dd($usergroup);
        $user = User::find(Auth::id());
        if($user->email != $email || $user->password != $password || $usergroup != $user->user_group_id) {
            $user->email = $email;
            if($password != "") {
                $user->password = Hash::make($password);
            }

            $user->user_group_id = $usergroup;
            $user->save();
            $msg = "Данные изменены успешно!";
        }
        $msg = "Данные не изменились.";
        /*
        $user_info = User::find(Auth::id());
        $groups = Group::all();
        $group_name = Group::where('id', '=', $user_info->user_group_id)->get();
        if($group_name->count() != 0) {
            $group_name = $group_name[0]->group_name;
        }
        */
        return redirect(route("settings_form", ['msg'=>$msg]));
        //return view("layouts.settings", compact('user_info', 'groups', 'group_name', 'msg'));
    }
}

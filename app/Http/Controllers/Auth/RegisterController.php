<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Group;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function register_form()
    {
        $groups = Group::all();
        /*
        if(count($groups) != 0) {
            dd($groups);
        } else {
            dd("групп нет");
        }
        */

        return view('auth.register', compact('groups'));
    }
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'usertype' => ['required', 'string','max:10', function($attribute, $value, $fail) {
                //dd(request()->usertype);
                if(request()->usertype != "student" && request()->usertype != "teacher") {
                    //dd("tut");
                    $fail('Выберите тип пользователя!');
                }
            }],
            'usergroup' => function($attribute, $value, $fail) {
                //dd(request()->usergroup);

                if(request()->usertype == "student") {
                    if(request()->usergroup == "Выберите значение") {
                        //dd(request()->usergroup);
                        //return "Выберите значение";
                        //dd("tut");
                        $fail('Выберете группу!');
                    }

                }


            },
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'usergroup' => "Выберите значение!",
            'name.required' => "Введите имя!",
            'usertype' => "Выберите значение!",
            'email.required' => "Введите e-mail!",
            'email.unique' => "Данная почта уже зарегистрирована!",
            'password.required' => "Введите пароль!",
            'password.confirmed' => "Пароли не совпадают!",
            'password.min' => "Минимальная длина пароля 8 символов!",

        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'usertype' => $data['usertype'],
            'user_group' => $data['usergroup'],

            'password' => Hash::make($data['password']),
        ]);
    }
}

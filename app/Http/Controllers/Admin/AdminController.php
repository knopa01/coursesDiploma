<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use http\Env\Request;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use App\Models\Group;

class AdminController extends Controller {
    public function index() {
        return view("admin.index");
    }
    public function show_groups() {

        $groups = Group::all();
        $msg = "";
        return view("admin.groups", compact('groups', 'msg'));
    }
    public function edit_form() {
        $group_id = request()->group_info;
        $group_info = Group::where('id', '=', $group_id)->get()[0];
        //dd($group_id);
        return view("admin.edit_group", compact('group_info'));
    }
    public function create_form() {



        return view("admin.create_group");
    }
    public function create_group() {
        $validator = request()->validate([

            'group_name' => ['required', 'unique:groups,group_name'],

        ],[
            'group_name.required' => 'Это поле обязательно для заполенения!',
            'group_name.unique' => ' Такая группа уже существует!',

        ]);

        $group = new Group();
        $group->group_name = request()->group_name;
        $group->save();
        $msg = "Данные успешно добавлены!";
        $groups = Group::all();
        return view("admin.groups", compact('groups', 'msg'));

    }
    public function edit_group() {
        $validatedData = request()->validate([

            'group_name' => ['required','unique:groups,group_name'],
        ],
        ['group_name.required' => 'Это поле обязательно для заполенения!',
        'group_name.unique' => 'Такая группа уже существует!']);
        $group_id = request()->group_id;
        $group_name = request()->group_name;
        $msg = "";

        $group_info = Group::where('id', '=', $group_id)->get()[0];

        if ($group_info->group_name != $group_name) {
            $group = Group::find($group_id);
            $group->group_name = $group_name;
            $group->save();
            $msg = "Сохранено";
        }
        $groups = Group::all();
        //dd($group_info);
        return view("admin.groups", compact('groups', 'msg'));
    }
    public function delete_group() {
        $group_id = request()->group_id;
        //dd($group_id, 'aboba' );
        $group = Group::find($group_id);
        if($group) {
            $group->delete();
        }
        //dd($group);

        $groups = Group::all();
        $msg = "Группа удалена";
        return view("admin.groups", compact('groups', 'msg'));
    }

}

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
        $groups = [];
        $groups = Group::all();

        return view("admin.groups", compact('groups'));
    }
    public function edit_form() {
        $group_id = request()->group_info;
        $group_info = Group::where('id', '=', $group_id)->get()[0];
        //dd($group_info);
        return view("admin.edit_group", compact('group_info'));
    }
    public function edit_group() {
        $group_id = request()->group_info;
        $group_info = Group::where('id', '=', $group_id)->get()[0];
        //dd($group_info);
        return view("admin.edit_group", compact('group_info'));
    }
}

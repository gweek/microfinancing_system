<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
// use Illuminate\Support\Collection;

class CustomUserRoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

    	$roles = DB::table('roles')->select('id','name' )->get();

    	return view('roles.index', compact('roles'));
    }

    public function store(Request $request){

    	$validate = $request->validate([
    		'name' => 'required|unique:roles|max:15'
    	]);

    	$role = Role::create([ 'name' => $validate['name'] ]);

    	return redirect()->route('roles.index')->withStatus(__('Role successfully created.'));

    }

    public function delete($name){

    	$role = Role::findByName($name);
    	$role->delete();

    	return redirect()->route('roles.index')->withStatus(__('Role successfully deleted.'));

    }

}

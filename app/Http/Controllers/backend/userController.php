<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;

class userController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function UserView(){
        //$allData = User::all();
        $data['allData'] = User::all();
        return view('backend.user.view_user', $data);
    }

    public function AddUser(){
        $data['userRoles'] = Roles::all();
        return view('backend.user.add_user', $data);
    }

    public function StoreUser(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'full_name' => 'required',
            // 'username' => 'required|unique:users',
            // 'password' > 'required',
            // 'usertype' => 'required',
        ]);

        $data  = new User();
        $data->usertype = $request->usertype;
        $data->name = $request->full_name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('user.view');
    }

    public function EditUser($id){
        $editData = User::find($id);
        return view('backend.user.edit_user', compact('editData'));
    }

    public function UpdateUser(Request $request, $id){
        $data  = User::find($id);
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;        
        $data->save();

        return redirect()->route('user.view');
    }

    public function DeleteUser($id){
        $deletData = User::find($id);
        $deletData->delete();
        return redirect()->route('user.view');
    }

    public function UserProfile($id){
        $viewData = User::find($id);
        return view('backend.user.view_profile', compact('viewData'));
    }
}

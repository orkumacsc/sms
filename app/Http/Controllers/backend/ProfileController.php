<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;


class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function ProfileView(){
        $id = Auth::user()->id;
        $viewData = User::find($id);
        return view('backend.user.view_profile', compact('viewData'));
    }
}

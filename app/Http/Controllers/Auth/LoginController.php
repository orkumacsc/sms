<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        
        if(!Auth::user()) {
            return redirect()->route('main_login');
        }

        switch (Auth::user()->usertype) {
            case 1:                
                return redirect('dashboard');
                break;

            case 3:                
                return redirect('Staff_Dashboard');
                break;
        
            case 7:
                return redirect('admissions_dashboard');
                break;
            default:
                
                break;
        }
    }
}

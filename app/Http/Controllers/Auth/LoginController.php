<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmergencyContact;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {

        if (!Auth::user()) {
            return redirect()->route('main_login');
        }
        $authenticated_user_role = Auth::user()->usertype;

        switch ($authenticated_user_role) {
            case 1:
                return redirect('dashboard');
                break;

            case 3:
                return redirect('Teacher');
                break;
                
            case 7:
                return redirect('Admissions');
                break;
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    function userHome(){
        return view('home');
    }
    function tops(){
        return view('tops');
    }
    function bottoms(){
        return view('bottoms');
    }
    function bna(){
        return view('bna');
    }
    function cargoPants(){
        return view('cargo');
    }
    function hats(){
        return view('hats');
    }
    function footwear(){
        return view('footwear');
    }

    function adminLogin(){
        if(View::exists('admin.login')){
            return view('admin.login');
        }else{
            abort(404, 'Not Found');
        }
    }

    function login(){
        if(View::exists('login')){
            return view('login');
        }
        if(View::exists('signup')){
            return view('signup');
        }else{
            abort(404, 'Not Found');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginpixanController extends Controller
{
    public function authenticate(){

      $v = \Validator::make(Input::all(), [
          'email' => 'required|string|email|max:255',
          'password' => 'required|string|min:1',
      ]);

      if ($v->fails())
        return \Response::json(array('status' => 'error', 'messages' => $v->errors()));

      if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
      {
         return response()->json([
             'status' => 'success',
             'message' => 'login success'
           ]);
      }
      else {
        return response()->json([
            'status' => 'error',
            'message' => 'login failed'
          ]);
      }

    }

    public function logout(){
      Auth::logout();
    }
}

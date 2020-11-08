<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth');
    }


    //フォロー処理
    public function store($id)
    {
      \Auth::user()->follow($id);
      return back();
    }

    //フォロー外す処理
    public function destroy($id)
    {
      \Auth::user()->unfollow($id);
      return back();
    }




}

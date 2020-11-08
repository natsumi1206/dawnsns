<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\Post;
use App\Follow;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function counts($user) {
      //フォロー中のユーザーの数
      $count_followings = $user->followings()->count();

      //フォロワーの数
      $count_followers = $user->followers()->count();

      return [
        'count_followings' => $count_followings,
        'count_followers' => $count_followers,
      ];
    }
}

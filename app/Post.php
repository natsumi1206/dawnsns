<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Follow;

class Post extends Model
{
    /**
    * 登録・更新を許可
    *@var array
    */
    protected $fillable = [
      'post'
    ];


    //Userモデルに1対多リレーションを定義
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    //Followモデルに1対多リレーションを定義
    public function follow()
    {
      return $this->belongsTo(Follow::class, 'user_id', 'follow_id');
    }



}

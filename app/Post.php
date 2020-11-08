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


    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $connection = 'dawnSNS';

    //Userモデルに1対多リレーションを定義
    public function user()
    {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //Followモデルに1対多リレーションを定義
    public function follow()
    {
      return $this->belongsTo(Follow::class, 'user_id', 'follow_id');
    }

  



}

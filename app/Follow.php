<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class Follow extends Model
{
    //
    protected $fillable = [
      'follow_id', 'user_id'
    ];

    //Userモデルに多対多リレーションを定義
    public function user()
    {
      return $this->belongsToMany(User::class, 'follow_id', 'user_id');
    }

    //Postモデルに1対多リレーションを定義
    public function post()
    {
      return $this->hasMany(Post::class);
    }

    // public $timestamps = false;
    // public $incrementing = false;


}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Follow;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'images','bio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * The table associated with the model.
    *
    * @var string
    */
    // protected $table = 'users';
    //database.phpでつくったconnection名を追加することで、データベースに接続できる

    protected $primaryKey = 'id';


    //Postモデルに1対多リレーションを定義
    public function posts()
    {
      return $this->hasMany(Post::class);
    }

    //Followモデルに多対多リレーションを定義
    public function followings() //あるユーザーがフォローしているユーザーを取得：$user->followings
    {
      return $this->belongsToMany(User::class, 'follows', 'user_id', 'follow_id')
      ->withTimestamps();

    }

    public function followers() //あるユーザーをフォローしているユーザーを取得：$user->followers
    {
      return $this->belongsToMany(User::class, 'follows', 'follow_id', 'user_id')
      ->withTimestamps();

    }

    public function is_following($userId)
    {
      return $this->followings()->where('follow_id', $userId)->exists();
    }

    public function follow($userId)
    {
      //すでにフォローしていないか？
      $existing = $this->is_following($userId);
      //フォローする相手がユーザー自身であってはいけない
      $myself = $this->id == $userId;

      //フォロー済みではない、かつフォロー相手がユーザー自身では無い場合、フォローできる:$user->follow($userId)
      if (!$existing && !$myself) {
        $this->followings()->attach($userId);
      }
    }

    public function unfollow($userId)
    {
      //すでにフォローしていないか？
      $existing = $this->is_following($userId);
      //フォローする相手がユーザー自身であってはいけない
      $myself = $this->id == $userId;

      //すでにフォロー済みならば、フォローをはずす:$user->unfollow($userId)
      if ($existing && !$myself) {
        $this->followings()->detach($userId);
      }


    }


}

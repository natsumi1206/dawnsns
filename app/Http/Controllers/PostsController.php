<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth');
    }


    public function top(){
        return view('posts.top');
    }

    //ツイート一覧
    public function show()
    {
      $post = User::query()
      ->join('posts','user_id', '=', 'users.id')
      ->orderBy('posts.created_at', 'desc')
      ->get();
      return view('posts.top', ['post' => $post]);
    }



    // 新規ツイート入力
    public function create(Request $request)
    {
      $post = new Post();
      $post->user_id = Auth::user() ->id;
      $post->post = $request->input('newPost');
      $post->save();

      return redirect('/top');
    }


    //ツイート編集処理(topページ)
    public function update(Request $request)
    {
      $id = $request->input('id');
      $up_post = $request->input('upPost');
      Post::query()
      ->where('id', $id)
      ->update(
        ['post' => $up_post]
      );

      return redirect('/top');
    }

    //ツイート編集処理(profileページ)
    public function uppost(Request $request)
    {
      $id = $request->input('id');
      $up_post = $request->input('upPost');
      Post::query()
      ->where('id', $id)
      ->update(
        ['post' => $up_post]
      );

      return redirect()->back();
    }


    //ツイート削除処理
    public function delete($id)
    {
        Post::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect()->back();
    }



}

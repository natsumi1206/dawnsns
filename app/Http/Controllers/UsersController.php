<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }



    public function index(Request $request)
    {
      $keyword = $request->input('keyword');

      //もしキーワードが入力されている場合
      if(!empty($keyword))
      {
        $all_users = User::query()
          ->where('username', 'like', '%'.$keyword.'%')
          ->get();
      }else{//もしキーワードが入力されていなかったら
        $all_users = User::query()
          ->where('id', '<>', Auth::id() )//自分以外のユーザーを一覧表示
          ->get();
      }

      return view('users.search', [
        'all_users' => $all_users,
        'keyword' => $keyword,
      ]);
    }

    //フォロー一覧
    public function followings()
    {
      $id = Auth::user()->id;
      $user = User::find($id);

      $followings = $user->followings()->get()->all();
      // dd($followings);

      //フォロー中のユーザーの投稿を取得
      $posts = User::query()
        ->join('posts','user_id', '=', 'users.id')
        ->whereIn('user_id', Auth::user()->followings()->pluck('follow_id'))
        ->orderBy('posts.created_at', 'desc')
        ->get();
        // dd($posts);

        $data = [
            'user' => $user,
            'users' => $followings,
            'posts' => $posts,
        ];

        $data += $this->counts($user);
        // dd($followings);


        return view('follows.followList', $data);
    }

    //フォロワー一覧
    public function followers()
    {
      $id = Auth::user()->id;
      $user = User::find($id);
      $followers = $user->followers()->get()->all();

      $posts = User::query()
        ->join('posts','user_id', '=', 'users.id')
        ->whereIn('user_id', Auth::user()->followers()->pluck('user_id'))
        ->orderBy('posts.created_at', 'desc')
        ->get();
        // dd($posts);

        $data = [
            'user' => $user,
            'users' => $followers,
            'posts' => $posts,
        ];
        $data += $this->counts($user);

        return view('follows.followerList',  $data);
    }





    //プロフィール表示
    public function profileIndex($id)
    {

      $user = User::query()->where('id', $id)->first();
      $user_id = Auth::id();
      // dd($user);
      $post = User::query()
      ->join('posts','user_id', '=', 'users.id')
      ->where('user_id', $id)
      ->orderBy('posts.created_at', 'desc')
      ->get()
      ->all();
      // dd($post);


      return view('users.profile', [ 'user' => $user, 'post' =>$post, 'user_id' =>$user_id]);
    }

    //マイプロフィール編集ページ
    public function edit()
    {

      return view('users.profileEdit', ['user' => Auth::user() ]);
    }

    //マイプロフィールの編集を保存
    public function update(Request $request)
    {
      $rules = [
        'username' => 'required|string|max:12',
        'mail' => 'required|string|min:4|email',
        'bio' => 'string|max:200|nullable',
        'images' => 'nullable',
        // 'images' => 'image|mimes:jpg,jpeg,png,svg,bmp'
      ];

      $this->validate($request, $rules);

      $user = Auth::user();
      $user->username = $request->input('username');
      $user->mail = $request->input('mail');
      $user->bio = $request->input('bio');
      // $user->images = base64_encode(file_get_contents($request->input('images')));
      $user->images = $request->input('images');
      $images = $request->input('images');
      //不要なtokenの削除
      // unset($user_form['_token']);
      $message='できてるよ';
      //保存
      if(!isset($images)){//何も選択せずにボタンを押した場合、アイコンは既存のままにする
        $user_img = User::query()
          ->where('id', Auth::id())
          ->value('images');//valueメソッドでカラムの値を直接返す
          // dd($user_img);
        $user->images = $user_img;
        $user->save();
      }
      $user->save();
      //リダイレクト
      return redirect()->back()->with('status', 'プロフィールを更新しました');
    }


    //パスワード変更ページ表示
    public function showChangePasswordForm()
    {
      return view('users.password');
    }
    //パスワード変更処理
    public function changePassword(Request $request)
    {
      //現在のパスワードが正しいかどうかを調べる
      if(!(Hash::check($request->get('current-password'), Auth::user()->password))){
        return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています。');
      }

      //現在のパスワードと新しいパスワードが間違っているかを調べる
      if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
      }

      //パスワードのバリデージョン
      $validated_data = $request->validate([
        'current-password' => 'required',
        'new-password' => 'required|string|min:4|max:12|regex:/^[a-zA-Z0-9]+$/|confirmed',
      ]);

      //パスワードを変更
      $user = Auth::user();
      $user->password = bcrypt($request->get('new-password'));
      $user->save();

      return redirect()->back()->with('change_password_success', 'パスワードを変更しました。');
    }




}

@extends('layouts.login')

@section('content')


<div class="my_plofile">
  <p class="page_title">PROFILE</p>
  <div class="profile_wrapper">
  <div class="profile_icon_ather">

    <div class="profile_icon">
      <img class="image-circle profile_image" src="{{ asset('images/' . $user->images ) }}" alt="ユーザーアイコン">
    </div>
    <div class="profile_ather">
      <div class="profile_flex">
        <p class="profile_tit black">USER NAME :</p>
        <p class="profile_tit black">E-MAIL :</p>
        <p class="profile_tit black">BIO :</p>
      </div>
      <div class="profile_flex">
        <p class="black">{{ $user->username }}</p>
        <p class="black">{{ $user->mail }}</p>
        <p class="profile_bio black">{!! nl2br(e($user->bio)) !!}</p>
      </div>
    </div>
    <div class="profile_if">
        <!-- 自分だった時表示 -->
      @if( $user->id == Auth::user()->id )
      <p class="side_bar_btn">
        <a class="side_bar_link" href="/profileEdit">
          PROFILE EDIT
        </a>
      </p>
      @else
      <!-- 自分以外だった時フォロー・フォロー解除ボタンを表示 -->
      <div class="profile_follow_btn">
        @include('follows.follow_button', ['user'=>$user])
      </div>
      @endif
      <!-- ここまで -->
    </div>

  </div>
</div>


  <div class="usersPosts">
    @if($post !== [])
    @foreach($post as $post)
    <div class="post_index">
      <div class="post_icon_ather">
        <div class="post_icon">
          <img class="image-circle" src="{{ asset('images/' . $post->images ) }}" alt="ユーザーアイコン">
        </div>
        <div class="post_ather">
          <p class="post_username">{{ $post->username }}</p>
          <p class="post_post">{!! nl2br(e($post->post)) !!}</p>
        </div>
        <p class="post_created_at">{{ $post->created_at->format('Y/m/d') }}</p>
      </div>
      @if(Auth::id()==$post->user_id)
        <div class="post_auth_menu">
          <div class="post_edit">
            <button type="button" class="btn" data-toggle="modal" data-target="#Modal" data-whatever="{{ $post->post }}" data-post-id="{{$post->id}}">
              <img class="edit_img" src="{{ asset('images/edit.png') }}" alt="編集" >
            </button>
          </div>
          <div class="post_dele">
            <button type="button" class="btn trash_img" name="button">
              <a class="" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの呟きを削除します。よろしいでしょうか？')">
                <img src="{{ asset('images/trash_h.png') }}" alt="削除"　>
                <img src="{{ asset('images/trash.png') }}" alt="削除"　>
              </a>
            </button>
          </div>
        </div>
      @endif
    </div>
    @endforeach
    @else
    <div class="post_index">
      <p>まだ投稿がありません</p>
    </div>
    @endif

  </div>
</div>

@if($post !== [] )
<!-- ツイート編集用モーダル -->
<div class="modal fade" id="Modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">編集</h4>
      </div>
      <form action="{{ route('upPost', ['id' => $post->id ]) }}" method="post">

      <div class="modal-body">
        <input id="id" class="form-control" type="hidden" name="id" value="">
        <textarea id="post" class="form-control" name="upPost" value="" maxlength="140"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" name="button">
          <img src="{{ asset('images/edit.png') }}" alt="編集" width="25px">
        </button>
       </div>
       {{ csrf_field() }}
      </form>
    </div>
  </div>
</div>
@endif

@endsection

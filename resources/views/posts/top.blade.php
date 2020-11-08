@extends('layouts.login')

@section('content')
<p class="page_title">HOME</p>
  <div class="new_post">
    <div class="auth_icon">
      <img class="image-circle profile_image" src="{{ asset('images/' . Auth::user()->images ) }}" alt="アイコン">
    </div>


    {!! Form::open(['url' => '/top']) !!}
    <div class="form-group new_post_input">
      {!!Form::textarea(

          'newPost',
          null,
          ['required',
           'class' => 'form-control',
           'maxLength' => '140',
           'placeholder' => 'いまどうしてる？',
          ]
        )!!}
    </div>

    <button type="submit" class="pull-right" name="">
      <img src="{{ asset('images/post.png') }}" alt="投稿ボタン">
    </button>

    {!! Form::close() !!}
  </div>


  @foreach ($post as $post)
    <div class="post_index">
      <div class="post_icon_ather">
        <div class="post_icon">
          <a href="{{$post->user_id}}/profile"><img class="image-circle" src="{{ asset('images/' . $post->images ) }}" alt="ユーザーアイコン"></a>
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




  <!-- ツイート編集用モーダル -->
<div class="modal fade" id="Modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">編集</h4>
      </div>

      <form action="{{ route('updatePost', ['id' => $post->id ]) }}" method="post">
        <input type="hidden" name="_method" value="PUT">
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








@endsection

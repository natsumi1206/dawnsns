@extends('layouts.login')

@section('content')
<p class="page_title">FOLLOW LIST</p>


<div class="">
<div class="flex_wrap">
  @if($users !== [])
  @foreach($users as $users)

      <div class="following_icon">
        <a href="/{{$users->id}}/profile">
        <img class="image-circle" src="{{ asset('images/' . $users->images) }}" alt="">
        </a>
      </div>

  @endforeach
  @else
  <div class="">
    <p>まだ誰もフォローしていません。ユーザーを検索しましょう！</p>
    <p class="side_bar_btn">
    <a class="side_bar_link" href="/search" >SEARCH</a>
    </p>
  </div>
  @endif
</div>


  @foreach($posts as $posts)
  <div class="post_index">
    <div class="post_icon_ather">
      <div class="post_icon">
        <a href="{{$posts->user_id}}/profile"><img class="image-circle" src="{{ asset('images/' . $posts->images ) }}" alt="ユーザーアイコン"></a>
      </div>
      <div class="post_ather">
        <p class="post_username">{{ $posts->username }}</p>
        <p class="post_post">{!! nl2br(e($posts->post)) !!}</p>
      </div>
      <p class="post_created_at">{{ $posts->created_at->format('Y/m/d') }}</p>
    </div>
  </div>
  @endforeach

</div>



@endsection

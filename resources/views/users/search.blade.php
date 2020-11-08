@extends('layouts.login')

@section('content')
<p class="page_title">USER SEARCH</p>
<div class="search_wrapper">

  <div class="search_form">
    <form class="form-group">
      <div class="search_input">
        <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="ユーザー名">
        <button type="submit" class="search_submit" name="">
          <img src="{{ asset('images/search.png') }}" alt="検索ボタン" width="25px" height="25px">
        </button>
        <p class="search_word">SEARCH WORD : {{ $keyword }}</p>
      </div>
    </form>

  </div>





  <div class="userIndex">
      @foreach ($all_users as $user)
      <div class="users">
        <div class="users_icon">
          <a href="/{{ $user->id }}/profile"><img class="image-circle search_image" src="{{ asset('images/' . $user->images ) }}" alt=""></a>
        </div>
        <div class="users_username">
          <p>{{ $user->username }}</p>
        </div>
        <div class="follow_button">
          @include('follows.follow_button', ['user'=>$user])
        </div>
      </div>
      @endforeach
  </div>
</div>




@endsection

@extends('layouts.login')

@section('content')

<p class="page_title">PROFILE EDIT</p>
<div class="profile_edit">
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  <div class="profile_edit_flex">
    <div class="now_icon">
      <p>
        <img class="image-circle profile_image" src="{{ asset('images/' . Auth::user()->images ) }}" alt="ユーザーアイコン">
      </p>
      <p>現在のアイコン</p>
    </div>

    <div class="edit_form">
      <form class="" action="{{ route('updateProfile', 'id') }}" method="post"　enctype="multipart/form-data">
        @isset ($filename)
        <div>
          <img class="image-circle" src="{{ asset('images/' . Auth::user()->images ) }}" alt="ユーザーアイコン">
        </div>
        @endisset
        <div>
          <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        </div>

        <div class="pro_edit_form-group">
          <label for="username">
            USER NAME
          </label>
          <div>
            <input class="form-control" type="text" name="username" value="{{ Auth::user()->username }}">
            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
          </div>

        </div>
        <div class="pro_edit_form-group">
          <label for="mail">
            E-MAIL
          </label>
          <div>
            <input class="form-control" type="text" name="mail" value="{{ Auth::user()->mail }}">
            @if ($errors->has('mail'))
                <span class="help-block">
                    <strong>{{ $errors->first('mail') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="pro_edit_form-group">
          <label for="bio">
            BIO
          </label>
          <div>
            <textarea class="form-control"  name="bio" value="" >{{ Auth::user()->bio }}</textarea>
          </div>
          @if ($errors->has('bio'))
              <span class="help-block">
                  <strong>{{ $errors->first('bio') }}</strong>
              </span>
          @endif
        </div>
        <div class="pro_edit_form-group">
          <label for="images">
            ICON IMAGE
          </label>
          <div>
            <input type="file" enctype="multipart/form-data" name="images" >
            @if ($errors->has('images'))
                <span class="help-block">
                    <strong>{{ $errors->first('images') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <button type="submit" class="btn-primary btn mt-1 profile_edit_btn" class="user-btn" name="button">EDIT</button>
        {{ csrf_field() }}
      </form>
    </div>

    <div class="pass">
      <p class="side_bar_btn">
        <a class="side_bar_link" href="/password">
          パスワードを変更
        </a>
      </p>
    </div>
  </div>


  <p class="">
    <a class="" href="/{{ Auth::id() }}/profile">
      << BACK
    </a>
  </p>
</div>

@endsection

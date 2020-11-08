@extends('layouts.login')

@section('content')


<div class="">
  <div class="">


        <div class="page_title">PASSWORD EDIT</div>
        <div class="pass_edit">
          @if (session('change_password_error'))
            <div id="" class="">
              <div class="alert alert-danger">
                {{session('change_password_error')}}
              </div>
            </div>
          @endif

          @if (session('change_password_success'))
            <div id="" class="">
              <div class="alert alert-success">
                {{session('change_password_success')}}
              </div>
            </div>
          @endif

          <div class="">
            <form class="" action="{{ route('changePassword') }}" method="post">
              {{ csrf_field() }}
              <div class="pro_edit_form-group">
                <label for="current">
                  現在のパスワード
                </label>
                <div class="">
                  <input id="current" class="form-control" type="password" name="current-password" required autofocus>
                </div>
              </div>

              <div class="pro_edit_form-group">
                <label for="password">
                  新しいパスワード
                </label>
                <div class="">
                  <input id="password" type="password" class="form-control" name="new-password" required>
                  @if ($errors->has('new-password'))
                    <span id="" class="help-block">
                      <strong>{{ $errors->first('new-password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="pro_edit_form-group">
                <label for="confirm">
                  新しいパスワード（確認用）
                </label>

                <div class="">
                  <input id="confirmation" type="password" class="form-control" name="new-password_confirmation" required>
                </div>
              </div>

              <div>
                  <button type="submit" class="btn btn-primary mt-1 profile_edit_btn">
                    CHANGE
                  </button>
              </div>


            </form>

          </div>


        </div>
        <p class="pass_back">
          <a href="/profileEdit">
            << BACK
          </a>
        </p>




    </div>
  </div>





@endsection

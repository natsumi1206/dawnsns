@extends('layouts.logout')

@section('content')

<div class="login-menu">
{!! Form::open() !!}


<h2 class="menu-title txt">新規ユーザー登録</h2>


<div class="txt">{{ Form::label('user name') }}</div>
<div class="txt">{{ Form::text('username',null,['class' => 'input']) }}</div>
@if ($errors->has('username'))
    <span class="help-block">
        <strong>{{ $errors->first('username') }}</strong>
    </span>
@endif



<div class="txt">{{ Form::label('e-mail') }}</div>
<div class="txt">{{ Form::text('mail',null,['class' => 'input']) }}</div>
@if ($errors->has('mail'))
    <span class="help-block">
        <strong>{{ $errors->first('mail') }}</strong>
    </span>
@endif


<div class="txt">{{ Form::label('password') }}</div>
<div class="txt">{{ Form::password('password',null,['class' => 'input']) }}</div>
@if ($errors->has('password'))
    <span class="help-block">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
@endif


<div class="txt">{{ Form::label('password-confirm') }}</div>
<div class="txt">{{ Form::password('password_confirmation',null,['class' => 'input']) }}</div>


<div class="txt">{{ Form::submit('Register', ['class'=>'login-btn']) }}</div>

<p class="txt"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}
</div>


@endsection

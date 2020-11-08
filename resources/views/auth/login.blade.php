@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div class="login-menu">

<p class="menu-title txt">DAWNSNSへようこそ</p>

<div class="txt">{{ Form::label('e-mail') }}</div>
<div class="txt">
  {{ Form::text('mail',null,['class' => 'input']) }}
  @if ($errors->has('mail'))
      <span class="help-block">
          <strong>{{ $errors->first('mail') }}</strong>
      </span>
  @endif
</div>
<div class="txt">{{ Form::label('password') }}</div>
<div class="txt">
  {{ Form::password('password',['class' => 'input']) }}
  @if ($errors->has('password'))
      <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
      </span>
  @endif
</div>

<div class="txt">{{ Form::submit('Login', ['class'=>'login-btn']) }}</div>

<p class="txt"><a class="" href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}
</div>
@endsection

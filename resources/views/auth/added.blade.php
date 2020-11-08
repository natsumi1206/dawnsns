@extends('layouts.logout')

@section('content')


<div id="clear">
<p class="txt">{{ $list->username }}さん</p>

<p class="txt">ようこそ！DAWNSNSへ！</p>
<p class="txt">ユーザー登録が完了しました。</p>
<p class="txt">さっそく、ログインをしてみましょう。</p>

<p class="btn txt"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection

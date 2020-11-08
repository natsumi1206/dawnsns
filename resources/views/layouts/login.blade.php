<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="SNSをつかってコミュニケーションをとりましょう" />
    <title>dawnSNS</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="css/style.css" type="text/css"> -->
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <!-- <link rel="stylesheet" href="css/reset.css" type="text/css"> -->

    <link rel='stylesheet' href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/media480.css') }}" media="screen and (max-width:480px)">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>


    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"> -->
    <!--サイトのアイコン指定-->
    <link rel="icon" href="/images/main_logo_icon.png" sizes="16x16" type="image/png" />
    <link rel="icon" href="/images/main_logo_icon.png" sizes="32x32" type="image/png" />
    <link rel="icon" href="/images/main_logo_icon.png" sizes="48x48" type="image/png" />
    <link rel="icon" href="/images/main_logo_icon.png" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="/images/main_logo_icon.png" />
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <!--OGPタグ/twitterカード-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header>

        <div id = "head">
          <a class="head_logo" href="/top"><img class="logo_img" src="{{ asset('images/main_logo.png') }}"></a>
        </div>
        <div id="menu">
            <div id="toggleMenuButton" class="">
                <p class="menuBtn_name">{{ Auth::user()->username }} さん</p><img class="image-circle head_icon" src="{{ asset('images/' . Auth::user()->images ) }}">
            </div>
              <div id="toggleMenu" class="">
                  <p class="submenu_item"><a href="/top">HOME</a></p>
                  <p class="submenu_item"><a href="/{{ Auth::id() }}/profile">PROFILE</a></p>
                  <p class="submenu_item"><a href="/logout">LOGOUT</a></p>
              </div>
        </div>
        <!-- レスポンシブ -->
        <div id="wrapper-media">
          <p class="btn-gnavi">
            <span></span>
            <span></span>
            <span></span>
          </p>
          <nav id="global-navi">
            <ul class="menu-media">
              <p class="mm-content">
                <a href="/{{ Auth::id() }}/profile"><img class="image-circle head_icon" src="{{ asset('images/' . Auth::user()->images ) }}">
                {{ Auth::user()->username }} さん
                </a>
              </p>
              <p class="mm-follow"><a href="/followList">{{ $count_followings }}  フォロー中</a></p>
              <p class="mm-follow"><a href="/followerList">{{ $count_followers }}  フォロワー</a></p>
              <li> <a href="/top"><i class="fa fa-home "></i>  ホーム</a> </li>
              <li> <a href="/{{ Auth::id() }}/profile"><i class="fa fa-user "></i>  プロフィール</a> </li>
              <li> <a href="/search"><i class="fa fa-search "></i> ユーザー検索</a> </li>
              <li> <a href="/logout">ログアウト</a> </li>
            </ul>
          </nav>
        </div>
    </header>


    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
          <div class="fixed">
            <div id="confirm">
                <div class="fukidashi">
                  <p class="black side_bar_name">{{ Auth::user()->username }} さんの</p>
                </div>
                <div class="following">
                  <p class="following_count black">フォロー数</p>
                  <p class="black">{{ $count_followings }}名</p>
                </div>
                <p class="side_bar_btn"><a class="side_bar_link" href="/followList">FOLLOW LIST</a></p>
                <div class="follower">
                  <p class="follower_count black">フォロワー数</p>
                  <p class="black">{{ $count_followers }}名</p>
                </div>
                <p class="side_bar_btn"><a class="side_bar_link" href="/followerList">FOLLOWER LIST</a></p>
            </div>
            <div class="search_btn">
              <p class="side_bar_btn"><a class="side_bar_link" href="/search">SEARCH</a></p>
            </div>
          </div>
        </div>
    </div>
    <footer>
    </footer>
    <!-- js/app.js -->

    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('js/dawn.js') }}"></script>
</body>
</html>

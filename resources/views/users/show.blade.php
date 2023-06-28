<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>ユーザー詳細（{{ $user->name }}）</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>Shift Superview</h1>
            <nav>
                <ul>
                    <li><a href='/'>ホーム</a></li>
                    <li><a href='/create'>新規報告</a></li>
                    <li><a href='/documents/index'>書類提出</a></li>
                </ul>
            </nav>
            <div>ログイン中：<a href='/profile'>{{ Auth::user()->name }}</a></div>
        </header>
        
        <div class='pagetitle'>
            <h2>ユーザー詳細（{{ $user->name }}）</h2>
        </div>
        
        <div class="user_detail">
            <iframe src="{{ $user->image_path }}" width="100%" height="100%"></iframe>
            @if ($user == Auth::user())
            <form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file" name="profile_image">
                <input type="submit" value="アップロード">
            </form>
            @endif
            <p class="roll">{{ $user->roll }}</p>
            <h3>連絡用メールアドレス</h3>
            <p class="mail">{{ $user->mail }}</p>
            <h3>参加中のグループ</h3>
            <ul>
            @foreach ($user->groups as $group)
                <li><a href='/groups/{{ $group->id }}'>{{ $group->name }}</a></li>
            @endforeach
            </ul>
            <p><a href='/groups/search'>新しいグループに参加（検索）</a></p>
            <h3>登録日</h3>
            <p class="register_at">{{ $user->created_at }}</p>
        </div>
    </body>
</html>

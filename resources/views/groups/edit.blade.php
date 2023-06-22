<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>グループ詳細</title>
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
            <h2>グループ編集（{{ $group->name }}）</h2>
        </div>
        
        <form action="/groups/{{ $group->id }}" method="POST">
            @csrf
            @method('put')
            <div class='name'>
                <h3>グループ名</h3>
                <input type="text" name="group[name]">
            </div>
            
            <h3>参加メンバー</h3>
            <div class="member_list">
                <ul>
                    @foreach ($group->users as $user)
                    <li>{{ $user->name }}</li>
                    @endforeach
                </ul>
            </div>
            <input type="submit" value="保存"/>
        </form>
        
    </body>
</html>

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
            <h2>グループ詳細（{{ $group->name }}）</h2>
        </div>
        
        <div>
            @foreach ($group->users as $user)
                @continue ($user->id !== Auth::id())
                @if ($user->id == Auth::id())
                    <p>参加済み</p>
                    @break
                @else
                <form action="/groups/register" method="POST">
                @csrf
                    <input type="number" name="group" value="{{ $group->id }}" readonly>
                    <input type="submit" value="グループに参加する"/>
                </form>
                @endif
            @endforeach
            <h3>グループ管理者</h3>
            <div class="member_list">
                <ul>
                    @foreach ($group->users as $user)
                        @if ($user->roll == 1)
                        <li>{{ $user->name }}</li>
                        @else
                        @endif
                    @endforeach
                </ul>
            </div>
            
            <h3>参加メンバー</h3>
            <div class="member_list">
                <ul>
                    @foreach ($group->users as $user)
                    <li>{{ $user->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <br>
        @canany (['admin', 'leader'])
        <div class='edit'>
            <a href='/groups/{{ $group->id }}/edit'>編集</a>
        </div>
        @endcan
        
    </body>
</html>

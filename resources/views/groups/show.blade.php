<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>グループ詳細</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/reset.css" >
        <link rel="stylesheet" href="/css/style.css" >
    </head>
    <body>
        <header>
            <section>
                <div class="header main">
                    <h1 class="app-name">Shift Superview</h1>
                    <nav>
                        <ul>
                            <li><a href='/'>ホーム</a></li>
                            <li><a href='/create'>新規報告</a></li>
                            <li><a href='/documents/index'>書類提出</a></li>
                            @if (Auth::user()->roll != 2)
                            <li><a href='/documents/create'>新規書類作成</a></li>
                            <li><a href='/groups/create'>新規グループ作成</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="header menu">
                    <p>ログイン中：<a href='/profile'>{{ Auth::user()->name }}</a></p>
                    <p><a href='/users/{{ Auth::user()->id }}'>ユーザープロフィール</a></p>
                    <p><form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('ログアウト') }}
                        </x-dropdown-link>
                    </form></p>
                </div>
            </section>
        </header>
        <div class="main-aside">
            <main>
                <h2 class='pagetitle'>グループ詳細（{{ $group->name }}）</h2>
                <section>
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
                    <ul>
                        @foreach ($group->users as $user)
                            @if ($user->roll == 1)
                            <li>{{ $user->name }}</li>
                            @else
                            @endif
                        @endforeach
                    </ul>
                    <h3>参加メンバー</h3>
                    <ul>
                        @foreach ($group->users as $user)
                        <li>{{ $user->name }}</li>
                        @endforeach
                    </ul>
                    @canany (['admin', 'leader'])
                    <br>
                    <a href='/groups/{{ $group->id }}/edit'>編集</a>
                    @endcan
                </section>
            </main>
            <aside>
                <nav>
                    <h3>参加中のグループ</h3>
                    @foreach (Auth::user()->groups as $group)
                    <ul>
                        <li><a href="/groups/{{ $group->id }}">{{ $group->name }}</a></li>
                    </ul>
                    @endforeach
                </nav>
            </aside>
        </div>
        <footer>
            <section class="footer content">
                <small>
                    <p>フッター</p>
                </small>
            </section>
        </footer>
    </body>
</html>

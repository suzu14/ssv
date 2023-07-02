<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>グループ検索</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/reset.css" >
        <link rel="stylesheet" href="/css/style.css" >
    </head>
    <body>
        <header>
            <section class="header content">
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
                <h2 class='pagetitle'>グループ検索</h2>
                <form action="/groups/search" method="GET">
                    @csrf
                    <input class="text" type="search" id="group_search" name="search" value="@if (isset($search)) {{ $search }} @endif">
                    <button class="submit">検索</button>
                </form>
                <table class='table'>
                    <thead>
                        <tr>
                            <th class="name">グループ</th>
                            <th class="leader">管理者</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                        <tr>
                            <td class="name"><a href="/groups/{{ $group->id }}">{{ $group->name }}</a></td>
                            @foreach ((array)$group->user as $user)
                                @if ($user->roll == 1)
                                <td class="leader"><a href='/users/{{ $user->id }}'>{{ $user->name }}</a></td>
                                @endif
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

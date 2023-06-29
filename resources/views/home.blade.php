<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>活動履歴一覧</title>
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
                    <p><a href='/users/{{ $user->id }}'>ユーザープロフィール</a></p>
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
                <h2 class='pagetitle'>活動履歴一覧</h2>
                <table class='activities'>
                    <thead>
                        <tr>
                            <th class="time">活動日時</th>
                            <th class="name">活動内容</th>
                            <th class="status">ステータス</th>
                            <th class="group">グループ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->groups as $group)
                            @foreach ($user->activities as $activity)
                            <tr>
                                <td class="time">{{ $activity->start_at }}</td>
                                <td class="name"><a href='/activities/{{ $activity->id }}'>{{ $activity->name }}</a></td>
                                <td class="status">
                                    @if ($activity->status == 1)
                                        活動中
                                    @elseif ($activity->status == 2)
                                        承認待ち
                                    @elseif ($activity->status == 3)
                                        承認済み
                                    @endif
                                </td>
                                <td class="group"><a href="/groups/{{ $group->id }}">{{ $activity->group->name }}</a></td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </main>
            <aside class='groups'>
                <nav>
                    <h3>参加中のグループ</h3>
                    @foreach ($user->groups as $group)
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

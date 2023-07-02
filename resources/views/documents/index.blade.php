<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>書類提出</title>
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
                <h2 class='pagetitle'>書類提出</h2>
                @if (Auth::user()->roll != 2)
                    <a class="submit" href='/documents/create'>新規書類登録</a>
                @endif
                <table class='table'>
                    <thead>
                        <tr>
                            <th class="groupname">グループ</th>
                            <th class="name">内容</th>
                            <th class="status">ステータス</th>
                            <th class="deadline">提出期限</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->documents as $document)
                        <tr>
                            <td class="groupname">{{ $document->group->name }}</td>
                            <td class="name"><a href='/documents/{{ $document->id }}'>{{ $document->name }}</a></td>
                            <td class="status">
                                @if ($document->status == 1)
                                未提出
                                @elseif ($document->status == 2)
                                承認待ち
                                @elseif ($document->status == 3)
                                承認済み
                                @else
                                @endif
                            </td>
                            <td class="deadline">{{ $document->deadline }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
            <aside class='groups'>
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

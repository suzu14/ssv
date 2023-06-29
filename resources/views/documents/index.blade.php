<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>書類提出</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
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
                <h2 class='pagetitle'>書類提出</h2>
                <table class='activities'>
                    <thead>
                        <tr>
                            <th>グループ</th>
                            <th>内容</th>
                            <th>ステータス</th>
                            <th>提出期限</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->documents as $document)
                        <tr>
                            <td>{{ $document->group->name }}</td>
                            <td><a href='/documents/{{ $document->id }}'>{{ $document->name }}</a></td>
                            <td>
                                @if ($document->status == 1)
                                未提出
                                @elseif ($document->status == 2)
                                承認待ち
                                @elseif ($document->status == 3)
                                承認済み
                                @else
                                @endif
                            </td>
                            <td>{{ $document->deadline }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='create'>
                    <a href='/documents/create'>新規書類登録</a>
                </div>
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

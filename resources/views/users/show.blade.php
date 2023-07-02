<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ユーザー詳細（{{ $user->name }}）</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/reset.css" >
        <link rel="stylesheet" href="/css/style.css" >
        <link rel="icon" 
            href="https://res.cloudinary.com/dilvltfbr/image/upload/v1688201046/favicon_kddmlg.png" 
            type="image/png">
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
                <h2 class='pagetitle'>ユーザー詳細（{{ $user->name }}）</h2>
                <section class="user_detail">
                    @if ($user->roll ==2)
                    <button disabled class="roll">一般ユーザー</button>
                    @elseif ($user->roll ==1)
                    <button disabled class="roll">グループ管理者</button>
                    <p>※グループ管理者は既存のグループへの参加はできません</p>
                    @elseif ($user->roll ==0)
                    <button disabled class="roll">管理者</button>
                    @else
                    <p class="roll"></p>
                    @endif
                    <h3>プロフィール画像</h3>
                    <iframe class="icon" src="{{ $user->image_path }}" width="100%" height="100%"></iframe>
                    @if ($user == Auth::user())
                    <form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="profile_image">
                        <input class="submit" type="submit" value="アップロード">
                    </form>
                    @endif
                    <h3>参加中のグループ</h3>
                    <ul>
                    @foreach ($user->groups as $group)
                        <li><a href='/groups/{{ $group->id }}'>{{ $group->name }}</a></li>
                    @endforeach
                    </ul>
                    @if (Auth::user()->roll != 1)
                    <p><a href='/groups/search'>>>新しいグループに参加（検索）<<</a></p>
                    @endif
                    <h3>登録日</h3>
                    <p class="register_at">{{ $user->created_at }}</p>
                    <br/>
                    <a href="/profile">>>名前・パスワード変更へ<<</a>
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

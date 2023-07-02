<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>新規活動報告</title>
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
                <h2 class='pagetitle'>新規活動報告</h2>
                <form action="/activities" method="POST">
                    @csrf
                    <h3>開始時刻</h3>
                    <input class="text" type="datetime-local" name="activity[start_at]"/>
                    <h3>グループ</h3>
                    <select name="activity[group_id]">
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <h3>活動内容</h3>
                    <input class="text" type="text" name="activity[name]">
                    <h3>参加者</h3>
                    @foreach ($group->users as $user)
                        <label class="checkbox">
                            {{-- valueを'$userのid'に、nameを'配列名[]'に --}}
                            <input class="checkbox-Input" type="checkbox" value="{{ $user->id }}" name="users_array[]"></input>
                            <span class="checkbox-DummyInput"></span>
                            <span class="checkbox-LabelText">{{ $user->name }}</span>
                        </label>
                    @endforeach
                    <h3>メモ</h3>
                    <textarea name="activity[comment]"></textarea>
                    <h3>開始報告者</h3>
                    <input class="text" type="text" name="start_user_id" value="{{ Auth::user()->name }}" readonly>
                    <input type="hidden" value=1 name="activity[status]">
                    <br/>
                    <input class="submit" type="submit" value="保存"/>
                </form>
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

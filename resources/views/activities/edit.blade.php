<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>編集（{{ $activity->name }}）</title>
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
                <h2>編集（{{ $activity->name }}）</h2>
                <form action="/activities/{{ $activity->id }}" method="POST">
                    @csrf
                    @method('put')
                    <p class='message'>
                    @if ($activity->end_at == NULL)
                        <p>※活動終了報告をしてください</p>
                    @else
                        <p>※報告済みの項目を修正する際はグループ管理者に確認をとってください</p>
                    @endif
                    </p>
                    
                    <div class='start_time'>
                        <h3>開始時刻</h3>
                        <input type="text" name="activity[start_at]" value="{{ $activity->start_at }}" readonly>
                    </div>
                    <div class='end_time'>
                        <h3>終了時刻</h3>
                        @if ($activity->end_at == NULL)
                            <input type="datetime-local" name="activity[end_at]">
                        @else
                            <input type="text" name="activity[end_at]" value="{{ $activity->end_at }}" readonly>
                        @endif
                    </div>
                    <div class='group'>
                        <h3>グループ</h3>
                        <p>{{ $activity->group->name }}</p>
                    </div>
                    <div class='name'>
                        <h3>活動内容</h3>
                        <input type="text" value="{{ $activity->name }}" readonly>
                    </div>
                    <div class='participants'>
                        <h3>参加者</h3>
                        @foreach ($activity->users as $user)
                            <p>{{ $user->name }}</p>
                        @endforeach
                    </div>
                    <div class='comment'>
                        <h3>メモ</h3>
                        <textarea name="activity[comment]"></textarea>
                    </div>
                    <div class='start_user'>
                        <h3>開始報告者</h3>
                        <p>{{ $activity->user_start->name }}</p>
                    </div>
                    <div class='end_user'>
                        <h3>終了報告者</h3>
                        @if ($activity->end_user_id == NULL)
                            <select name="activity[end_user_id]">
                                <option></option>
                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                            </select>
                        @else
                            <p>{{ $activity->user_end->name }}</p>
                        @endif
                    </div>
                    <div class='status'>
                        <input type="hidden" value=2 name="activity[status]">
                    </div>
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
    
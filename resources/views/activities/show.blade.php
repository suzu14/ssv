<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>活動詳細（{{ $activity->name }}）</title>
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
                <h2 class='pagetitle'>活動詳細（{{ $activity->name }}）</h2>   
                <section class='message'>
                    @if ($activity->end_at == NULL)
                        <p>※活動終了報告をしてください</p>
                    @else
                        <p>※報告済みの項目を修正する際はグループ管理者に確認をとってください</p>
                    @endif
                </section>
                <section class="activity_detail">
                    <div class='start_time'>
                        <h3>開始時刻</h3>
                        <p>{{ $activity->start_at }}</p>
                    </div>
                    <div class='end_time'>
                        <h3>終了時刻</h3>
                        @if ($activity->end_at == NULL)
                            <p>未報告</p>
                        @else
                            <p>{{ $activity->end_at }}</p>
                        @endif
                    </div>
                    <div class='group'>
                        <h3>グループ</h3>
                        <p>{{ $activity->group->name }}</p>
                    </div>
                    <div class='name'>
                        <h3>活動内容</h3>
                        <p>{{ $activity->name }}</p>
                    </div>
                    <div class='participants'>
                        <h3>参加者</h3>
                        @foreach ($activity->users as $user)
                            <p><a href='/users/{{ $user->id }}'>{{ $user->name }}</a></p>
                        @endforeach
                    </div>
                    <div class='comment'>
                        <h3>メモ</h3>
                        <p>{{ $activity->comment }}</p>
                    </div>
                    <div class='start_user'>
                        <h3>開始報告者</h3>
                        <p>{{ $activity->user_start->name }}</p>
                    </div>
                    <div class='end_user'>
                        <h3>終了報告者</h3>
                        @if ($activity->end_at == NULL)
                            <p>未報告</p>
                        @else
                            <p>{{ $activity->user_end->name }}</p>
                        @endif
                    </div>
                </section>
                <div class='edit'>
                    <a href='/activities/{{ $activity->id }}/edit'>編集</a>
                </div>
                @canany ('admin', 'leader')
                <form action="/activities/{{ $activity->id }}" method="POST">
                @csrf
                @method('put')
                <div class='approval'>
                    @if ($activity->status == 2)
                        <button type="submit" name="activity[status]" value=3 onclick="submitApproval({{ $activity->id }})">承認</button>
                    @elseif ($activity->status == 3)
                        <button type="button" disabled>承認済み</button>
                    @endif
                </div>
                </form>
                @endcan
                <form action="/activities/{{ $activity->id }}" id="form_{{ $activity->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deleteActivity({{ $activity->id }})">削除</button> 
                </form>
                
                <div class='comment'>
                    <h2>新規コメント追加</h2>
                    <form action="/activities/{{ $activity->id }}" method="POST">
                        @csrf
                        <input name="comment[activity_id]" type="hidden" value="{{ $activity->id }}">
                        <input name="comment[user_comment]" type="hidden" value="{{ Auth::user()->name }}" readonly>
                        <div class='title'>
                            <h3>コメントタイトル</h3>
                            <input type="text" name="comment[title]">
                        </div>
                        <div class='body'>
                            <h3>コメント本文</h3>
                            <textarea name="comment[body]"></textarea>
                        </div>
                        <input type="submit" value="コメントする"/>
                    </form>
                </div>
                <div class='comment_list'>
                    <h3>コメント一覧</h3>
                    @forelse($activity->comments as $comment)
                        <div>
                            <p>{{ $comment->created_at }}</p>
                            <h4>{{ $comment->title }}</h4>
                            <p>{{ $comment->body }}</p>
                            <h4>by {{ $comment->user->name }}</h4>
                            <!--
                            @if($comment->user_id == Auth::user()->id)
                                <form action="/activities/{{ $activity->id }}" id="form_{{ $comment->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteComment({{ $comment->id }})">コメント削除</button> 
                                </form>
                            @endif
                            -->
                        </div>
                    @empty
                        <p>コメントはまだありません</p>
                    @endforelse
                </div>
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
        <script>
            function submitApproval(id) {
                document.getElementById("activity[status]").submit();
            }
            
            function deleteActivity(id) {
                'use strict'
                if (confirm('活動報告削除\n削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $document->name }}</title>
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
                <h2 class='pagetitle'>{{ $document->name }}</h2>
                <section class="submit-status">
                    @if ($document->path == NULL)
                    <p>ファイルが未提出です</p>
                    @else
                    <p>以下のファイルが提出済みです</p>
                    <div>
                        <iframe src="{{ $document->path }}" width="100%" height="500vh"></iframe>
                    </div>
                    @endif
                    @section('preview')
                    @if ($document->path)
                        <img src="{{ $document->path }}">
                    @endif
                    @endsection
                </section>
                <section class="submit-form">
                    <form action="/documents/{{ $document->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="document_file">
                        <input type="hidden" name="document[status]" value=2>
                        <input class="submit" type="submit" value="アップロード">
                    </form>
                </section>
                @canany ('admin', 'leader')
                <section class="approval-form">
                    <form action="/documents/{{ $document->id }}" method="POST">
                        @csrf
                        @method('put')
                        @if ($document->path)
                        @if ($document->status == 2)
                        <button class="submit" type="submit" name="document[status]" value=3 onclick="submitApproval({{ $document->id }})">承認</button>
                        @elseif ($document->status == 3)
                        <button class="submit" type="button" disabled>承認済み</button>
                        @else
                        @endif
                        @endif
                    </form>
                </section>
                <section class="delete-form">
                <form action="/documents/{{ $document->id }}" id="form_{{ $document->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="submit" type="button" onclick="deleteDocument({{ $document->id }})">削除</button> 
                </form>
                </section>
                @endcan
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
        
        <script>
            function submitApproval(id) {
                document.getElementById("document[status]").submit();
            }
            
            function deleteDocument(id) {
                'use strict'
                if (confirm('活動報告削除\n削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        
    </body>
</html>

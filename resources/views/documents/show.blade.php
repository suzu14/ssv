<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>{{ $document->name }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>Shift Superview</h1>
            <nav>
                <ul>
                    <li><a href='/'>ホーム</a></li>
                    <li><a href='/create'>新規報告</a></li>
                    <li><a href='/documents/index'>書類提出</a></li>
                </ul>
            </nav>
            <div>ログイン中：<a href='/profile'>{{ Auth::user()->name }}</a></div>
        </header>
        
        <div class='pagetitle'>
            <h2>{{ $document->name }}</h2>
        </div>
        
        @if ($document->path == NULL)
        <p>ファイルが未提出です</p>
        @else
        <p>以下のファイルが提出済みです</p>
        <div>
            <img src="{{ $document->path }}" alt="画像が読み込めません"/>
        </div>
        @endif
        
        @section('preview')
        @if ($document->path)
            <img src="{{ $document->path }}">
        @endif
        @endsection
        
        <form action="/documents/{{ $document->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="file" name="document_file">
            @if ($document->path != NULL)
                <input type="text" name="document[path]" value="{{ $document->path }}" readonly
            @endif
            <input type="text" name="document[status]" value=2>
            <input type="submit" value="アップロード">
        </form>
        
        @canany ('admin', 'leader')
            <form action="/documents/{{ $document->id }}" method="POST">
                @csrf
                @method('put')
                    <div class='approval'>
                        @if ($document->status == 2)
                            <button type="submit" name="document[status]" value=3 onclick="submitApproval({{ $document->id }})">承認</button>
                        @elseif ($document->status == 3)
                            <button type="button" disabled>承認済み</button>
                        @else
                        @endif
                    </div>
            </form>
        
            <form action="/documents/{{ $document->id }}" id="form_{{ $document->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deleteDocument({{ $document->id }})">削除</button> 
            </form>
        @endcan
        
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

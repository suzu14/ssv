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
            <div>ログイン中：<a href='/profile'>{{ $user->name }}</a></div>
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
            <input type="submit" value="アップロード">
        </form>
        
    </body>
</html>

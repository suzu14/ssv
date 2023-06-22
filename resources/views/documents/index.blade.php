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
            <h2>書類提出</h2>
        </div>
        <table class='activities'>
            <thead>
                <tr>
                    <th>グループ</th><th>内容</th><th>ステータス</th><th>提出期限</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                <tr>
                    <td>{{ $document->group->name }}</td><td><a href='/documents/{{ $document->id }}'>{{ $document->name }}</a></td><td>{{ $document->status }}</td><td>{{ $document->deadline }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class='groups'>
            <h3>参加中のグループ</h3>
            @foreach ($user->groups as $group)
            <ul>
                <li><a href="/groups/{{ $group->id }}">{{ $group->name }}</a></li>
            </ul>
            @endforeach
        </div>
    </body>
</html>

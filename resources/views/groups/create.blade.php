<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>新規グループ作成</title>
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
        </header>
        
        <div class='pagetitle'>
            <h2>新規グループ作成</h2>
        </div>
        
        <form action="/groups" method="POST">
            @csrf
            <div class='group'>
                <h3>グループ名</h3>
                <input type="text" name="group[name]">
            </div>
            <input type="submit" value="新規グループ作成"/>
        </form>
    </body>
</html>

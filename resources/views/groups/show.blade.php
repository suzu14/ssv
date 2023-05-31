<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>グループ詳細</title>
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
                    <li>書類提出</li>
                </ul>
            </nav>
        </header>
        
        <div>
            <h3 class="group_name">
                {{ $group->name }}
            </h3>
            <div class="member_list">
                <ul>
                    @foreach ($group->users as $user)
                    <li>{{ $user->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>活動履歴一覧</title>
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
            <h2>活動履歴一覧</h2>
        </div>
        
        <table class='activities'>
            
            <thead>
                <tr>
                    <th>活動日時</th>
                    <th>活動内容</th>
                    <th>ステータス</th>
                    <th>グループ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->groups as $group)
                    @foreach ($user->activities as $activity)
                    <tr>
                        <td>{{ $activity->start_at }}</td>
                        <td><a href='/activities/{{ $activity->id }}'>{{ $activity->name }}</a></td>
                        <td>
                            @if ($activity->status == 1)
                                活動中
                            @elseif ($activity->status == 2)
                                承認待ち
                            @elseif ($activity->status == 3)
                                承認済み
                            @endif
                        </td>
                        <td><a href="/groups/{{ $group->id }}">{{ $activity->group->name }}</a></td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        
        @can('general')
        <div class='groups'>
            <h3>参加中のグループ</h3>
            @foreach ($user->groups as $group)
            <ul>
                <li><a href="/groups/{{ $group->id }}">{{ $group->name }}</a></li>
            </ul>
            @endforeach
        </div>
        @endcan
    </body>
</html>

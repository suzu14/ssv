<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>活動履歴一覧</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/reset.css" >
        <link rel="stylesheet" href="/css/style.css" >
    </head>
    <body>
        <header>
            <h1>Shift Superview</h1>
            <nav>
                <ul>
                    <li><a href='/'>ホーム</a></li>
                    <li><a href='/create'>新規報告</a></li>
                    <li><a href='/documents/index'>書類提出</a></li>
                    @if (Auth::user()->roll == 1)
                    <li><a href='/groups/create'>新規グループ作成</a></li>
                    @endif
                </ul>
            </nav>
                <p>ログイン中：<a href='/profile'>{{ $user->name }}</a></p>
                <p><a href='/users/{{ $user->id }}'>プロフィール</a></p>
        </header>
        
        <div>
            <main>
                <h2 class='pagetitle'>活動履歴一覧</h2>
            
                <table class='activities'>
                    <thead>
                        <tr>
                            <th class="time">活動日時</th>
                            <th class="name">活動内容</th>
                            <th class="status">ステータス</th>
                            <th class="group">グループ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->groups as $group)
                            @foreach ($user->activities as $activity)
                            <tr>
                                <td class="time">{{ $activity->start_at }}</td>
                                <td class="name"><a href='/activities/{{ $activity->id }}'>{{ $activity->name }}</a></td>
                                <td class="status">
                                    @if ($activity->status == 1)
                                        活動中
                                    @elseif ($activity->status == 2)
                                        承認待ち
                                    @elseif ($activity->status == 3)
                                        承認済み
                                    @endif
                                </td>
                                <td class="group"><a href="/groups/{{ $group->id }}">{{ $activity->group->name }}</a></td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </main>
        
        
            @canany(['general', 'admin'])
                <aside class='groups'>
                    <h3>参加中のグループ</h3>
                    @foreach ($user->groups as $group)
                    <ul>
                        <li><a href="/groups/{{ $group->id }}">{{ $group->name }}</a></li>
                    </ul>
                    @endforeach
                </aside>
            @endcan
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>グループ検索</title>
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
            <h2>グループ検索</h2>
        </div>
        
        <div class="searchform">
            <form action="/groups/search" method="GET">
                @csrf
                <label for="group_search">グループを検索</label>
                <input type="search" id="group_search" name="search" value="@if (isset($search)) {{ $search }} @endif">
                <button>検索</button>
            </form>
            <table class='groups'>
                <thead>
                    <tr>
                        <th class="name">グループ</th>
                        <th class="leader">管理者</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                    <tr>
                        <td class="name"><a href="/groups/{{ $group->id }}">{{ $group->name }}</a></td>
                        @foreach ((array)$group->user as $user)
                            @if ($user->roll == 1)
                            <td class="leader"><a href='/users/{{ $user->id }}'>{{ $user->name }}</a></td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <script>
            function submitApproval(id) {
                var group_id = document.getElementById("groupRegister");
                var user_id = kintone.getLoginUser()
                document.getElementById("groupRegister").submit();
            }
        </script>
    </body>
</html>

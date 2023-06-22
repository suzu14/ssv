<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>新規書類登録</title>
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
            <h2>新規書類登録</h2>
        </div>
        
        <form action="/documents" method="POST">
            @csrf
            <div class='group'>
                <h3>グループ</h3>
                <select name="document[group_id]">
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class='title'>
                <h3>内容</h3>
                <input type="text" name="document[name]">
            </div>
            <div class='deadline'>
                <h3>提出期限</h3>
                <input type="datetime-local" name="document[deadline]"/>
            </div>
            <div class='user'>
                <h3>提出者</h3>
                @foreach ($group->users as $user)
                    <label>
                        {{-- valueを'$userのid'に、nameを'配列名[]'に --}}
                        <input type="checkbox" value="{{ $user->id }}" name="users_array[]">
                            {{ $user->name }}
                        </input>
                    </label>
                @endforeach
            </div>
            <div class='status'>
                <input type="text" value=2 name="document[status]" readonly>
            </div>
            <input type="submit" value="保存"/>
        </form>
        
    </body>
</html>

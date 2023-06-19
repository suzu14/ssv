<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>新規活動報告</title>
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
            <h2>新規活動報告</h2>
        </div>
        
        <form action="/activities" method="POST">
            @csrf
            <div class='start_time'>
                <h3>開始時刻</h3>
                <input type="datetime-local" name="activity[start_at]"/>
            </div>
            <div class='group'>
                <h3>グループ</h3>
                <select name="activity[group_id]">
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class='name'>
                <h3>活動内容</h3>
                <input type="text" name="activity[name]">
            </div>
            <div class='participants'>
                <h3>参加者</h3>
                @foreach ($users as $user)
                    <label>
                        {{-- valueを'$userのid'に、nameを'配列名[]'に --}}
                        <input type="checkbox" value="{{ $user->id }}" name="users_array[]">
                            {{ $user->name }}
                        </input>
                    </label>
                @endforeach
            </div>
            <div class='comment'>
                <h3>メモ</h3>
                <textarea name="activity[comment]"></textarea>
            </div>
            <div class='start_user'>
                <h3>開始報告者</h3>
                <input type="text" name="start_user_id" value="{{ Auth::user()->name }}" readonly>
            </div>
            <input type="submit" value="保存"/>
        </form>
    </body>
</html>

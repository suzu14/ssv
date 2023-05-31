<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>編集（{{ $activity->name }}）</title>
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
        
        <div class='pagetitle'>
            <h2>編集（{{ $activity->name }}）</h2>
        </div>
        
        <form action="/activities/{{ $activity->id }}" method="POST">
            @csrf
            @method('put')
            <p class='message'>
            @if ($activity->end_at == NULL)
                <p>活動終了報告をしてください</p>
            @else
                <p>報告済みの項目を修正する際はグループ管理者に確認をとってください</p>
            @endif
            </p>
            
            <div class='start_time'>
                <h3>開始時刻</h3>
                <input type="text" name="activity[start_at]" value="{{ $activity->start_at }}" readonly>
            </div>
            <div class='end_time'>
                <h3>終了時刻</h3>
                @if ($activity->end_at == NULL)
                    <input type="datetime-local" name="activity[end_at]">
                @else
                    <input type="text" name="activity[end_at]" value="{{ $activity->end_at }}" readonly>
                @endif
            </div>
            <div class='group'>
                <h3>グループ</h3>
                <p>{{ $activity->group->name }}</p>
            </div>
            <div class='name'>
                <h3>活動内容</h3>
                <input type="text" value="{{ $activity->name }}" readonly>
            </div>
            <div class='participants'>
                <h3>参加者</h3>
                @foreach ($activity->users as $user)
                    <p>{{ $user->name }}</p>
                @endforeach
            </div>
            <div class='comment'>
                <h3>メモ</h3>
                <textarea name="activity[comment]"></textarea>
            </div>
            <div class='start_user'>
                <h3>開始報告者</h3>
                <p>{{ $activity->user_start->name }}</p>
            </div>
            <div class='end_user'>
                <h3>終了報告者</h3>
                @if ($activity->end_user_id == NULL)
                    <select name="activity[end_user_id]">
                        <option></option>
                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                    </select>
                @else
                    <p>{{ $activity->user_end->name }}</p>
                @endif
                
            </div>
            <input type="submit" value="保存"/>
        </form>
    </body>
</html>
    
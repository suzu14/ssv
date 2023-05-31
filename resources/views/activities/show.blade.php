<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            活動詳細（{{ $activity->name }}）
        </h2>
    </x-slot>
    
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
        <h2>{{ $activity->name }}</h2>
    </div>
    
    <div class="activity_detail">
        <div class='start_time'>
            <h3>開始時刻</h3>
            <p>{{ $activity->start_at }}</p>
        </div>
        <div class='end_time'>
            <h3>終了時刻</h3>
            @if ($activity->end_at == NULL)
                <p>未報告</p>
            @else
                <p>{{ $activity->end_at }}</p>
            @endif
        </div>
        <div class='group'>
            <h3>グループ</h3>
            <p>{{ $activity->group->name }}</p>
        </div>
        <div class='name'>
            <h3>活動内容</h3>
            <p>{{ $activity->name }}</p>
        </div>
        <div class='participants'>
            <h3>参加者</h3>
            @foreach ($activity->users as $user)
                <p>{{ $user->name }}</p>
            @endforeach
        </div>
        <div class='comment'>
            <h3>メモ</h3>
            <p>{{ $activity->comment }}</p>
        </div>
        <div class='start_user'>
            <h3>開始報告者</h3>
            <p>{{ $activity->user_start->name }}</p>
        </div>
        <div class='end_user'>
            <h3>終了報告者</h3>
            @if ($activity->end_at == NULL)
                <p>未報告</p>
            @else
                <p>{{ $activity->user_end->name }}</p>
            @endif
        </div>
    </div>
    <div class='edit'>
        <a href='/activities/{{ $activity->id }}/edit'>編集</a>
    </div>
    
    <form action="/activities/{{ $activity->id }}" id="form_{{ $activity->id }}" method="post">
        @csrf
        @method('DELETE')
        <button type="button" onclick="deleteActivity({{ $activity->id }})">削除</button> 
    </form>
    
    <script>
        function deleteActivity(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>

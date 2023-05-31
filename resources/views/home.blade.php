<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ホーム
        </h2>
    </x-slot>

    <header>
        <h1>Shift Superview</h1>
        <nav>
            <ul>
                <li>ホーム</li>
                <li><a href='/create'>新規報告</a></li>
                <li>書類提出</li>
            </ul>
        </nav>
    </header>
    
    <div class='pagetitle'>
        <h2>全履歴</h2>
    </div>
    <table class='activities'>
        <thead>
            <tr>
                <th>活動日時</th><th>活動内容</th><th>ステータス</th><th>グループ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activities as $activity)
            <tr>
                <td>{{ $activity->start_at }}</td><td><a href='/activities/{{ $activity->id }}'>{{ $activity->name }}</a></td><td>{{ $activity->status }}</td><td>{{ $activity->group->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class='paginate'>
        {{ $activities->links() }}
    </div>
    <div class='groups'>
        <h3>参加中のグループ</h3>
        @foreach ($groups as $group)
        <ul>
            <li><a href="/groups/{{ $group->id }}">{{ $group->name }}</a></li>
        </ul>
        @endforeach
    </div>
</x-app-layout>

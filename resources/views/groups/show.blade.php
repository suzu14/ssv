<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            グループ詳細
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
    
    <div>
        <h3 class="group_name">
            {{ $group->name }}
        </h3>
        <div class="participants">
        </div>
    </div>
</x-app-layout>

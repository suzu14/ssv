<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            新規グループ作成
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
        <h2>新規グループ作成</h2>
    </div>
    
    <form action="/groups" method="POST">
        @csrf
        <div class='group'>
            <h3>グループ名</h3>
            <input type="text" name="group[name]">
        </div>
        <input type="submit" value="新規グループ作成"/>
    </form>
    
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>

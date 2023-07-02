<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>新規書類登録</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/reset.css" >
        <link rel="stylesheet" href="/css/style.css" >
        <link rel="icon" 
            href="https://res.cloudinary.com/dilvltfbr/image/upload/v1688201046/favicon_kddmlg.png" 
            type="image/png">
    </head>
    <body>
        <header>
            <section>
                <div class="header main">
                    <h1 class="app-name">Shift Superview</h1>
                    <nav>
                        <ul>
                            <li><a href='/'>ホーム</a></li>
                            <li><a href='/create'>新規報告</a></li>
                            <li><a href='/documents/index'>書類提出</a></li>
                            @if (Auth::user()->roll != 2)
                            <li><a href='/documents/create'>新規書類作成</a></li>
                            <li><a href='/groups/create'>新規グループ作成</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="header menu">
                    <p>ログイン中：<a href='/profile'>{{ Auth::user()->name }}</a></p>
                    <p><a href='/users/{{ Auth::user()->id }}'>ユーザープロフィール</a></p>
                    <p><form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('ログアウト') }}
                        </x-dropdown-link>
                    </form></p>
                </div>
            </section>
        </header>
        <div class="main-aside">
            <main>
                <h2 class='pagetitle'>新規書類登録</h2>
                <form action="/documents" method="POST">
                    @csrf
                    <h3>グループ</h3>
                    <select class="text" id="group_id" name="document[group_id]">
                        <option value="" style="display: none;">選択してください</option>
                        @foreach (Auth::user()->groups as $group)
                            <option value="{{ $group->id }}"  {{ old('document[group_id]') === "$group->id" ? 'selected' : '' }} >
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                    <h3>内容</h3>
                    <input class="text" type="text" name="document[name]">
                    <h3>提出期限</h3>
                    <input class="text" type="datetime-local" name="document[deadline]"/>
                    <h3>提出者</h3>
                    @foreach ($users as $user)
                        <label id="user_id">
                            {{-- valueを'$userのid'に、nameを'配列名[]'に --}}
                            <input class="checkbox-Input" type="checkbox" value="{{ $user->id }}" name="users_array[]"></input>
                            <span class="checkbox-DummyInput"></span>
                            <span class="checkbox-LabelText">{{ $user->name }}</span>
                        </label>
                    @endforeach
                    <input type="hidden" value=2 name="document[status]">
                    <br/>
                    <input class="submit" type="submit" value="保存"/>
                </form>
            </main>
            <aside>
                <nav>
                    <h3>参加中のグループ</h3>
                    @foreach (Auth::user()->groups as $group)
                    <ul>
                        <li><a href="/groups/{{ $group->id }}">{{ $group->name }}</a></li>
                    </ul>
                    @endforeach
                </nav>
            </aside>
        </div>
        <footer>
            <section class="footer content">
                <small>
                    <p>フッター</p>
                </small>
            </section>
        </footer>
        <script>
            $('#group_id').change(function () {
                var group_val = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/webapi',
                    type: 'GET',
                    data: {'user_val' : group_val},
                    datatype: 'json',
                })
                .done(function(data) {
                    $('#users_id option').remove();
                    // DBから受け取ったデータを子カテゴリのoptionにセット
                    console.log(data);
                    $.each(data, function(key, value) {
                        $('#user_id').append($('<checkbox>').text(value).attr('value', key));
                    });
                })
                .fail(function() {
                    console.log('失敗');
                });
            });
        </script>
    </body>
</html>

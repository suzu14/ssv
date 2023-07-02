<section>
        <h2>
            {{ __('アカウントを削除する') }}
        </h2>

        <p>
            {{ __('アカウントを削除すると、データがすべて削除されます。\n保持したいデータは事前にダウンロードしてください。') }}
        </p>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('アカウント削除') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <h2>
                {{ __('本当にアカウントを削除しますか？') }}
            </h2>

            <p>
                {{ __('アカウントを削除すると、データがすべて削除されます。操作を続ける場合は、パスワードを入力してください。') }}
            </p>

            <div>
                <x-input-label for="password" value="{{ __('パスワード') }}" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('パスワード') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div>
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('キャンセル') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('アカウント削除') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

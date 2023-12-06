<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex justify-between items-center">
                <a style="text-decoration: underline" class="font-semibold text-gray-900 dark:text-gray-100"
                   href="{{ route('admin.users.edit', $user->id) }}">
                    Upraviť
                </a>
                <div class="flex">
                    @if(!$user->isApproved())
                        <form method="POST" action="{{ route('admin.users.approve', $user->id) }}">
                            @csrf
                            @method('patch')

                            <x-primary-button class="ml-4">
                                {{ __('Potvrdiť') }}
                            </x-primary-button>
                        </form>
                    @endif
                    @if($user->isBanned())
                        <form method="POST" action="{{ route('admin.users.unban', $user->id) }}">
                            @csrf
                            @method('patch')

                            <x-primary-button class="ml-4">
                                {{ __('Unban') }}
                            </x-primary-button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.users.ban', $user->id) }}">
                            @csrf
                            @method('patch')

                            <x-primary-button class="ml-4">
                                {{ __('Ban') }}
                            </x-primary-button>
                        </form>
                    @endif
                </div>
            </div>
            <x-input-error :messages="$errors->get('ban')" class="mt-2" />
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Email</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->email }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Rola</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->role }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Dátum registrovania</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->created_on }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Dátum posledného prihlásenia</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->logged_at }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">IP adresa pri registrovaní</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->reg_ip}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">IP adresa pri prihlásení</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->last_ip}}</dd>
                </div>
                <div class="px-4 pt-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Status</dt>
                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->status }}</dd>
                </div>
            </dl>
        </div>
    </div>
</x-layouts.admin>

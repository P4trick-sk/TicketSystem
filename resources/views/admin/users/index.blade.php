<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Panel') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
        <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Zoznam užívateľov:</h3>
        <a class="font-semibold text-gray-900 dark:text-gray-100 ml-auto"
           href="{{ route('admin.users.create') }}">
            Pridať užvateľa
        </a>
    </div>

    @if(isset($status))
        <div class="pt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ $status }}
                </div>
            </div>
        </div>
    @endif

    @if($users->first())
        @foreach($users as $user)
            <div class="pt-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <a style="text-decoration: underline" class="font-semibold text-gray-900 dark:text-gray-100"
                           href="{{ route('admin.users.show', $user->id) }}">
                            {{ $user->name }}
                        </a>
                        <div class="text-gray-900 dark:text-gray-100">
                            {{ $user->role }}
                        </div><dl class="divide-y divide-gray-100">
                            <div class="sm:grid sm:grid-cols-3">
                                <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Email</dt>
                                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->email }}</dd>
                                </div>
                                <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Naposledy prihlásený</dt>
                                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->logged_at }}</dd>
                                </div>
                                <div class="px-4 pt-6 sm:gap-4 sm:px-0">
                                    <dt class="text-gray-900 dark:text-gray-100 font-semibold text-sm font-medium leading-6 text-gray-900">Status</dt>
                                    <dd class="text-gray-900 dark:text-gray-100 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $user->status }}</dd>
                                </div>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        @endforeach
            <div class="pt-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $users->links() }}
                </div>
            </div>
    @else
        <div class="pt-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Žiaden užívateľ!
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-layouts.admin>

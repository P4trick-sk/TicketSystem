<x-app-layout>
    <div class="pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('tickets.update', $ticket->id) }}">
                @method('patch')
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="subject" value="Predmet" />
                    <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="$ticket->subject" required autofocus />
                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="description" value="Popis problému" />

                    <x-text-input id="description" class="block mt-1 w-full"
                                  type="text"
                                  name="description"
                                  :value="$ticket->description"
                                  required />

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <x-primary-button class="mt-4">
                    Uložiť ticket
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>

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

                <div class="sm:grid sm:grid-cols-3">
                    <div class="mt-4">
                        <x-input-label for="assigned_to" :value="__('Priradené')" />
                        <div class="mt-2">
                            <select id="assigned_to" name="assigned_to" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option disabled="disabled">Vyberte</option>
                                @foreach($teachers as $teacher)
                                    <option {{$teacher->id == $ticket->assignedTo->id ? 'selected' : null}} value="{{$teacher->id}}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="priority" :value="__('Priorita')" />
                        <div class="mt-2">
                            <select id="priority" name="priority" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option disabled="disabled">Vyberte</option>
                                @foreach($priorities as $priority)
                                    <option {{$priority == $ticket->$priority ? 'selected' : null}} value="{{$priority}}">{{ $priority }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <x-primary-button class="mt-4">
                    Uložiť ticket
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>

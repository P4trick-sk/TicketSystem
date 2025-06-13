<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Ticket Info Sidebar -->
        <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6 md:mb-0">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Ticket Details</h2>
            <div class="mb-2">
                <span class="font-semibold">Status:</span>
                <span class="inline-block px-2 py-1 rounded text-xs font-bold
                    @if(!$ticket->is_completed) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 @else bg-gray-200 text-gray-600 dark:bg-gray-800 dark:text-gray-400 @endif">
                    @if(!$ticket->is_completed)
                        Open
                    @else
                        Closed
                    @endif
                </span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">Priority:</span>
                <span class="inline-block px-2 py-1 rounded text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    {{ ucfirst($ticket->priority ?? 'normal') }}
                </span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">Subject:</span>
                <span class="ml-2 text-gray-900 dark:text-gray-200">{{ $ticket->subject }}</span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">Created by:</span>
                <span class="ml-2 text-gray-900 dark:text-gray-200">{{ $ticket->createdBy->name ?? 'Unknown' }}</span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">Created at:</span>
                <span class="ml-2 text-gray-900 dark:text-gray-200">{{ $ticket->created_at->format('Y-m-d H:i') }}</span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">Last updated:</span>
                <span class="ml-2 text-gray-900 dark:text-gray-200">{{ $ticket->updated_at->format('Y-m-d H:i') }}</span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">Assigned Agent(s):</span>
                <ul class="list-disc ml-5">
                    @forelse($ticket->assignees as $agent)
                        <li>{{ $agent->name }}</li>
                    @empty
                        <li><span class="text-gray-400">Unassigned</span></li>
                    @endforelse
                </ul>
            </div>
            <!-- Ticket Actions -->
            <div class="mt-4 flex flex-col gap-2">
                @if(!$ticket->is_completed)
                    <button type="button" class="w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Close Ticket</button>
                    <button type="button" class="w-full px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Escalate</button>
                @endif
            </div>
        </div>

        <!-- Chat/Main Section -->
        <div class="md:col-span-2 flex flex-col bg-white dark:bg-neutral-900 shadow rounded-lg p-6 h-[70vh]">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Conversation</h2>

            <div id="conversation-container" class="flex-1 space-y-4 overflow-y-auto mb-4 pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 dark:scrollbar-thumb-neutral-700 dark:scrollbar-track-neutral-900" style="scrollbar-gutter: stable;">
                <!-- Ticket Description as First Message -->
                <div class="flex">
                    <div class="border rounded-lg p-3 bg-gray-50 dark:bg-neutral-800 max-w-xl">
                        <div class="flex items-center mb-1">
                            <span class="font-semibold text-sm text-blue-700 dark:text-blue-400">{{ $ticket->createdBy->name ?? 'Author' }}</span>
                            <span class="ml-2 text-xs text-gray-400">{{ $ticket->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="text-sm text-gray-800 dark:text-neutral-200 whitespace-pre-line">
                            {{ $ticket->description }}
                        </div>
                    </div>
                </div>

                @foreach($ticket->messages as $message)
                    <div class="flex @if($message->user_id === auth()->id()) justify-end @endif">
                        <div class="border rounded-lg p-3 @if($message->user_id === auth()->id()) bg-blue-100 dark:bg-blue-900 @else bg-gray-50 dark:bg-neutral-800 @endif max-w-xl">
                            <div class="flex items-center mb-1 @if($message->user_id === auth()->id()) justify-end @endif">
                                <span class="font-semibold text-sm @if($message->user_id === auth()->id()) text-green-700 dark:text-green-400 @else text-blue-700 dark:text-blue-400 @endif">
                                    @if($message->user_id === auth()->id())
                                        You
                                    @else
                                        {{ $message->user->name ?? 'Support Agent' }}
                                    @endif
                                </span>
                                <span class="ml-2 text-xs text-gray-400">{{ $message->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <div class="text-sm text-gray-800 dark:text-neutral-200">
                                {{ $message->message }}
                            </div>
                            @if(!empty($message->attachments))
                                <div class="mt-2">
                                    <span class="font-semibold text-xs">Attachments:</span>
                                    <ul class="list-disc ml-5">
                                        @foreach((array)$message->attachments as $attachment)
                                            <li><a href="{{ asset('storage/' . $attachment) }}" class="text-blue-600 underline" target="_blank">{{ basename($attachment) }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <form wire:submit.prevent="sendMessage" class="mt-auto">
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">Add a response</label>
                <textarea wire:model="message" id="message" rows="3" class="block w-full rounded-md border-gray-300 dark:border-neutral-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:text-neutral-100" placeholder="Write your response..."></textarea>

                <div class="mt-2">
                    <label for="attachments" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">Attachments (optional)</label>
                    <input type="file" wire:model="attachments" id="attachments" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:text-neutral-300" />
                </div>

                <div class="mt-2 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        <span wire:loading.remove wire:target="sendMessage">Send</span>
                        <span wire:loading wire:target="sendMessage">Sending...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @script
    <script>
    document.addEventListener('livewire:initialized', function() {
        // Scroll to bottom on initial load
        scrollToBottom();

        // Listen for new messages
        $wire.on('messageSent', scrollToBottom);
    });

    function scrollToBottom() {
        setTimeout(() => {
            const conversationContainer = document.getElementById('conversation-container');
            if (conversationContainer) {
                conversationContainer.scrollTop = conversationContainer.scrollHeight;
            }
        }, 100); // Small delay to ensure DOM has updated
    }
    </script>
    @endscript
</div>

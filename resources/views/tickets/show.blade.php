<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
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
                        {{-- FIx: Ensure the route is correct for closing the ticke --}}
                        <form method="POST" action="{{ route('tickets.show', $ticket) }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Close Ticket</button>
                        </form>
                        {{-- FIx: Ensure the route is correct for closing the ticket --}}
                        <form method="POST" action="{{ route('tickets.show', $ticket) }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Escalate</button>
                        </form>
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
                <form id="message-form" class="mt-auto" method="POST" action="{{ route('tickets.message', $ticket) }}">
                    @csrf
                    <label for="message" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">Add a response</label>
                    <textarea id="message" name="message" rows="3" class="block w-full rounded-md border-gray-300 dark:border-neutral-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:text-neutral-100" placeholder="Write your response..."></textarea>
                    <div class="mt-2 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Message template
        function createMessageTemplate(message, isCurrentUser) {
            const date = new Date(message.created_at);
            const formattedDate = date.toISOString().split('T')[0] + ' ' +
                                  date.toTimeString().split(' ')[0].substring(0, 5);
            const userName = isCurrentUser ? 'You' : message.user.name;
            const userClass = isCurrentUser ? 'text-green-700 dark:text-green-400' : 'text-blue-700 dark:text-blue-400';
            const bgClass = isCurrentUser ? 'bg-blue-100 dark:bg-blue-900' : 'bg-gray-50 dark:bg-neutral-800';
            const justifyClass = isCurrentUser ? 'justify-end' : '';

            let attachmentsHtml = '';
            if (message.attachments && message.attachments.length > 0) {
                let attachmentsList = '';
                message.attachments.forEach(attachment => {
                    const fileName = attachment.split('/').pop();
                    attachmentsList += `<li><a href="${window.location.origin}/storage/${attachment}" class="text-blue-600 underline" target="_blank">${fileName}</a></li>`;
                });

                attachmentsHtml = `
                    <div class="mt-2">
                        <span class="font-semibold text-xs">Attachments:</span>
                        <ul class="list-disc ml-5">
                            ${attachmentsList}
                        </ul>
                    </div>
                `;
            }

            return `
                <div class="flex ${justifyClass}">
                    <div class="border rounded-lg p-3 ${bgClass} max-w-xl">
                        <div class="flex items-center mb-1 ${justifyClass}">
                            <span class="font-semibold text-sm ${userClass}">${userName}</span>
                            <span class="ml-2 text-xs text-gray-400">${formattedDate}</span>
                        </div>
                        <div class="text-sm text-gray-800 dark:text-neutral-200">
                            ${message.message}
                        </div>
                        ${attachmentsHtml}
                    </div>
                </div>
            `;
        }

        // Scroll to the bottom of the conversation
        function scrollToBottom() {
            const conversationContainer = document.getElementById('conversation-container');
            if (conversationContainer) {
                conversationContainer.scrollTop = conversationContainer.scrollHeight;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initial scroll to bottom
            scrollToBottom();

            // AJAX form submission
            const form = document.getElementById('message-form');
            const messageInput = document.getElementById('message');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Create FormData object
                const formData = new FormData(form);

                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Send message via AJAX
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Clear the input
                            messageInput.value = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Continue anyway since the websocket will update the UI
                        messageInput.value = '';
                    });
            });

            // Listen for messages
            window.Echo.private('ticket.{{ $ticket->id }}')
                .listen('NewTicketMessage', (e) => {
                    const conversationContainer = document.getElementById('conversation-container');
                    const isCurrentUser = e.user.id === {{ auth()->id() }};

                    // Create and append new message
                    const messageHtml = createMessageTemplate(e, isCurrentUser);
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message-item';
                    messageDiv.innerHTML = messageHtml;
                    conversationContainer.appendChild(messageDiv);

                    // Scroll to the bottom
                    scrollToBottom();
                });
        });
    </script>
</x-app-layout>

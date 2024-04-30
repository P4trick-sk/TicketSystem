<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Evidencia') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
        <h3 class="text-xl text-gray-800 dark:text-gray-200 leading-tight">Zoznam tried:</h3>
        <a class="font-semibold text-gray-900 dark:text-gray-100 ml-auto"
           href="{{ route('admin.classrooms.create') }}">
            Pridať triedu
        </a>
    </div>

            <div class="pt-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <style>
                        .hide {
                        display: none;
                        }

                        /* Table container */
                    .table-container {
                        max-width: 90%;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: #fff;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        border-radius: 8px;
                    }

                    /* Table Styles */
                    .table-evidence {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 20px 0;
                    }

                    .table-evidence th, .table-evidence td {
                        border: 1px solid #ccc;
                        padding: 10px;
                        text-align: left;
                    }

                    .table-evidence th {
                        background-color: #006699;
                        color: #ffffff;
                    }

                    .table-evidence tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }

                    .table-evidence tr:hover {
                        background-color: #e8f4f8;
                    }

                    /* Button Styles */
                    .button {
                        padding: 10px 20px;
                        border: none;
                        border-radius: 5px;
                        background-color: #007BFF;
                        color: white;
                        text-transform: uppercase;
                        cursor: pointer;
                        margin-right: 10px;
                    }

                    .button:hover {
                        background-color: #0056b3;
                    }

                    /* Responsive Design */
                    @media (max-width: 768px) {
                        .table-evidence, .table-evidence th, .table-evidence td {
                            display: block;
                            width: 100%;
                        }

                        .button {
                            width: 100%;
                            margin-top: 10px;
                        }

                        .table-container {
                            padding: 10px;
                        }
                    </style>

                <!-- Buttons for time ranges -->
                <button id="last24HoursBtn">Last 24 Hours</button>
                <button id="last7DaysBtn">Last 7 Days</button>
                <button id="last30DaysBtn">Last 30 Days</button>

                @php
                    $last24HoursTickets = \App\Models\Ticket::where('created_on', '>=', now()->subHours(24))->get();
                @endphp

                <div id="last24HoursTickets table-container" class="hide ticket-table">
                    @if($last24HoursTickets->isNotEmpty())
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Created By</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <!-- Add more table headers as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($last24HoursTickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->created_by }}</td>
                                        <td>{{ $ticket->subject }}</td>
                                        <td>{{ $ticket->description }}</td>
                                        <!-- Add more table cells for other ticket attributes -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No tickets created in the last 24 hours.</p>
                    @endif
                </div>

                <!-- Tickets for the last 7 days -->
                @php
                    $last7DaysTickets = \App\Models\Ticket::where('created_on', '>=', now()->subDays(7))->get();
                @endphp

                <div id="last7DaysTickets table-container" class="hide ticket-table">
                    @if($last7DaysTickets->isNotEmpty())
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Created By</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <!-- Add more table headers as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($last7DaysTickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->created_by }}</td>
                                        <td>{{ $ticket->subject }}</td>
                                        <td>{{ $ticket->description }}</td>
                                        <!-- Add more table cells for other ticket attributes -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No tickets created in the last 7 days.</p>
                    @endif
                </div>

                <!-- Tickets for the last 30 days -->
                @php
                    $last30DaysTickets = \App\Models\Ticket::where('created_on', '>=', now()->subDays(30))->get();
                @endphp

                <div id="last30DaysTickets table-container" class="hide ticket-table">
                    @if($last30DaysTickets->isNotEmpty())
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Created By</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <!-- Add more table headers as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($last30DaysTickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->created_by }}</td>
                                        <td>{{ $ticket->subject }}</td>
                                        <td>{{ $ticket->description }}</td>
                                        <!-- Add more table cells for other ticket attributes -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No tickets created in the last 30 days.</p>
                    @endif
                </div> 
                    </div>
                </div>
            </div>

            <script>
        // Function to toggle visibility of ticket tables based on selected time range
        function toggleTicketTables(timeRange) {
            console.log(timeRange);
            document.querySelectorAll('.ticket-table').forEach(table => {
            console.log(table);
                if (table.id === timeRange + 'Tickets') {
                    table.classList.remove('hide');
                    console.log("test1");
                } else {
                    table.classList.add('hide');
                    console.log("test2");
                }
            });
        }

        // Event listeners for time range buttons
        document.getElementById('last24HoursBtn').addEventListener('click', function() {
            toggleTicketTables('last24Hours');
            console.log("test1");
        });

        document.getElementById('last7DaysBtn').addEventListener('click', function() {
            toggleTicketTables('last7Days');
            console.log("test2");
        });

        document.getElementById('last30DaysBtn').addEventListener('click', function() {
            toggleTicketTables('last30Days');
            console.log("test3");
        });
    </script>

</x-layouts.admin>

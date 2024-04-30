<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Evidencia') }}
        </h2>
    </x-slot>

            <div class="pt-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <style>
                        .hide {
                        display: none;
                        }

                    /* Style for the entire table */
                    table {
                        width: 100%; /* Full-width */
                        border-collapse: collapse; /* Collapses the border */
                        margin: 20px 0; /* Spacing above and below the table */
                        font-size: 16px; /* Font size for text in the table */
                        text-align: left; /* Aligns text to the left */
                    }

                    /* Style for table headers */
                    th {
                        background-color: #f2f2f2; /* Light grey background */
                        color: #333; /* Dark grey text */
                        font-weight: bold; /* Bold font for headers */
                        padding: 12px 15px; /* Padding inside the header cells */
                        border: 1px solid #ddd; /* Light grey border */
                    }

                    /* Style for table rows */
                    tr {
                        border: 1px solid #ddd; /* Light grey border */
                    }

                    /* Style for table cells */
                    td {
                        padding: 8px 15px; /* Padding inside the cells */
                        border: 1px solid #ddd; /* Light grey border */
                    }

                    /* Hover effect for rows */
                    tr:hover {
                        background-color: #f5f5f5; /* Very light grey background on hover */
                    }

                    <style>
                    .dropdown {
                        position: relative;
                        display: inline-block;
                    }

                    .dropbtn {
                        padding: 10px 20px;
                    }

                    .dropdown-content {
                        display: none;
                        position: absolute;
                        background-color: #f9f9f9;
                        min-width: 160px;
                        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                        z-index: 1;
                    }

                    .dropdown-content button {
                        color: black;
                        padding: 12px 16px;
                        text-decoration: none;
                        display: block;
                        background-color: transparent;
                        border: none;
                        width: 100%;
                        text-align: left;
                    }

                    .dropdown-content button:hover {
                        background-color: #f1f1f1;
                    }

                    .dropdown:hover .dropdown-content {
                        display: block;
                    }

                    .dropdown:hover .dropbtn {
                        background-color: #016bff;
                        color: #fff;
                    }

                    </style>

                <!-- Dropdown menu for time range buttons -->
                <div class="dropdown">
                    <button class="dropbtn">Select Time Range</button>
                    <div class="dropdown-content">
                        <button id="last24HoursBtn">Last 24 Hours</button>
                        <button id="last7DaysBtn">Last 7 Days</button>
                        <button id="last30DaysBtn">Last 30 Days</button>
                    </div>
                </div>

                @php
                    $last24HoursTickets = \App\Models\Ticket::where('created_on', '>=', now()->subHours(24))->get();
                @endphp

                <div id="last24HoursTickets" class="hide ticket-table">
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
                                        <td>{{ $ticket->createdBy->name }}</td>
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

                <div id="last7DaysTickets" class="hide ticket-table">
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
                                        <td>{{ $ticket->createdBy->name }}</td>
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

                <div id="last30DaysTickets" class="hide ticket-table">
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
                                        <td>{{ $ticket->createdBy->name }}</td>
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

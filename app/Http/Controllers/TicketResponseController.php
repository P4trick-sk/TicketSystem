<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketResponseRequest;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketResponse;

class TicketResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketResponseRequest $request, Ticket $ticket)
    {
        $this->authorize('canRespond', $ticket);

        TicketResponse::create([
            'response_by' => $request->user()->id,
            'ticket_id' => $ticket->id,
            'response' => $request->response,
        ]);

        return to_route('tickets.show', $ticket->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketResponse $ticketResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketResponse $ticketResponse)
    {
        $this->authorize('update', $ticketResponse);

        return view('response.edit')->with('response', $ticketResponse);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketResponse $ticketResponse)
    {
        $request->validate([
            'response' => ['required', 'string', 'max:2000'],
        ]);

        $this->authorize('update', $ticketResponse);

        $ticketResponse->fill($request->only('response'));

        $ticketResponse->fill([
            'updated_on' => now()
        ]);

        $ticketResponse->save();

        return to_route('tickets.show', $ticketResponse->ticket->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketResponse $ticketResponse)
    {
        //
    }
}

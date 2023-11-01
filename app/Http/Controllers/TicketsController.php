<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketCreateRequest;
use App\Models\User;
use App\Models\Ticket;
use App\Repositories\TicketRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TicketsController extends Controller
{
    public function __construct(TicketRepositoryInterface $ticketRepository) {
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        /*dd($request->user()->hasVerifiedEmail());*/
        /*dd($request->user()->responses()->first()->subject);*/
        $tickets = $this->ticketRepository->getAllUserTickets($request->user()->id);
        return view('dashboard')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketCreateRequest $request): RedirectResponse
    {
        $ticket = $this->ticketRepository->createTicket([
            'subject' => $request->subject,
            'description' => $request->description,
            'created_by' => $request->user()->id
        ]);

        /*event(new Registered($user));*/

        // TODO: Pridať kartu ticketu ako component do blade

        return to_route('tickets.show', $ticket->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $ticket = $this->ticketRepository->getTicketById($id);
        return view('tickets.show')->with('ticket', $ticket);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Ticket;
use App\Repositories\TicketRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
        return view('dashboard')->with([
            'myTickets' => $this->ticketRepository->getAllTicketsCreatedByUser($request->user()->id),
            'myAssignedTickets' => $this->ticketRepository->getAllTicketsAssignedToUser($request->user()->id),
            'unassignedTickets' => $this->ticketRepository->getAllUnassignedTickets(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tickets.create')->with([
            'categoryTypes' => CategoryType::where('status', 'active')->get(),
            'classrooms'=> Classroom::where('status', 'active')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request): RedirectResponse
    {
        $this->authorize('create', Ticket::class);

        $ticket = $this->ticketRepository->createTicket([
            'subject' => $request->subject,
            'description' => $request->description,
            'created_by' => $request->user()->id,
            'classroom_id' => $request->classroom,
            'category_id' => $request->category
        ]);

        /*event(new Registered($user));*/

        return to_route('tickets.show', $ticket->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket): View
    {
        $this->authorize('view', $ticket);

        return view('tickets.show')->with('ticket', $ticket);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        return view('tickets.edit')->with([
            'ticket' => $ticket,
            'teachers' => User::whereIn('role', [UserRole::Teacher, UserRole::Admin])->get(),
            'priorities' => ['low', 'medium', 'high'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $teachers = User::whereIn('role', [UserRole::Teacher, UserRole::Admin])->pluck('id')->toArray();

        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'assigned_to' => ['required', 'int', Rule::in($teachers)],
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
        ]);

        $this->authorize('update', $ticket);

        $ticket->fill($request->only('subject', 'description', 'assigned_to', 'priority'));

        $ticket->save();

        return to_route('tickets.show', $ticket->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

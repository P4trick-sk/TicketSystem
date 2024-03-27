<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Events\TicketAssigned;
use App\Events\TicketClosed;
use App\Events\TicketCreated;
use App\Events\TicketUpdated;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateAdvancedTicketInfoRequest;
use App\Http\Requests\UpdateBasicTicketInfoRequest;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Classroom;
use App\Models\Group;
use App\Models\User;
use App\Models\Ticket;
use App\Repositories\TicketRepositoryInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TicketsController extends Controller
{
    use SoftDeletes;

    public function __construct(TicketRepositoryInterface $ticketRepository) {
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function indexCreated(Request $request): View
    {
        return view('dashboard.created')->with([
            'tickets' => $this->ticketRepository->getAllTicketsCreatedByUser($request->user()->id),
        ]);
    }

    public function indexAssigned(Request $request): View
    {
        return view('dashboard.assigned')->with([
            'tickets' => $this->ticketRepository->getAllTicketsAssignedToUser($request->user()->id),
        ]);
    }

    public function indexCreatedClosed(Request $request)
    {
        return view('dashboard.createdClosed')->with([
            'tickets' => Ticket::where('status', 'closed')->where('created_by', $request->user()->id)->get(),
        ]);
    }

    public function indexAssignedClosed(Request $request)
    {
        return view('dashboard.assignedClosed')->with([
            'tickets' => Ticket::where('status', 'closed')->where('assigned_to', $request->user()->id)->get(),
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

        if (Category::find($request->category_id)->categoryType->is_dynamic) {
            $request->validate([
                'classroom_id' => ['required'],
            ]);
        }

        $files = [];

        if ($request->file('attachments')) {
            foreach ($request->file('attachments') as $file)
            {
                $path = $file->store('attachments');
                array_push($files, $path);
            }
        }

        $ticket = $this->ticketRepository->createTicket([
            'subject' => $request->subject,
            'description' => $request->description,
            'created_by' => $request->user()->id,
            'classroom_id' => $request->classroom_id,
            'category_id' => $request->category_id,
            'attachments' => json_encode($files),
            'status' => 'waiting_for_teacher'
        ]);

        event(new TicketCreated($ticket));

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
            'categoryTypes' => CategoryType::all(),
            'classrooms' => Classroom::all(),
            'groups' => Group::all(),
        ]);
    }

    public function updateSummary(Request $request, Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $request->validate([
            'summary' => ['string', 'nullable']
        ]);

        $ticket->summary = $request->summary;
        $ticket->save();

        return to_route('tickets.show', $ticket->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateBasicInfo(UpdateBasicTicketInfoRequest $request, Ticket $ticket)
    {
        $this->authorize('updateBasic', $ticket);
        $files = json_decode($ticket->attachments);

        if ($request->file('attachments')) {
            foreach ($request->file('attachments') as $file)
            {
                $path = $file->store('attachments');
                array_push($files, $path);
            }
        }

        $ticket->fill($request->only('subject', 'description'));
        $ticket->attachments = json_encode($files);
        $ticket->updated_on = now();
        $ticket->save();

        event(new TicketUpdated($ticket));

        return to_route('tickets.show', $ticket->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAdvancedInfo(UpdateAdvancedTicketInfoRequest $request, Ticket $ticket)
    {
        $this->authorize('updateAdvanced', $ticket);

        if (Category::find($request->category_id)->categoryType->is_dynamic) {
            $request->validate([
                'classroom_id' => ['required'],
            ]);
        }

        $ticket->fill($request->only('classroom_id', 'category_id', 'priority'));

        if ($ticket->isDirty('classroom_id') || $ticket->isDirty('category_id'))
        {
            $this->ticketRepository->reAssignTicket($ticket);
        }

        $ticket->updated_on = now();
        $ticket->save();

        event(new TicketUpdated($ticket));

        return to_route('tickets.show', $ticket->id);
    }

    public function assignTicketToUser(Request $request, Ticket $ticket)
    {
        $this->authorize('updateAdvanced', $ticket);

        $teachers = User::whereIn('role', [UserRole::Teacher, UserRole::Admin])->pluck('id')->toArray();
        $request->validate([
            'assigned_to' => ['required', Rule::in($teachers)],
        ]);

        $ticket->fill($request->only('assigned_to'));
        $ticket->updated_on = now();
        $ticket->save();

        event(new TicketAssigned($ticket));

        return to_route('tickets.index.assigned');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $request->validate([
            'summary' => ['string', 'nullable']
        ]);

        $ticket->summary = $request->summary;
        $ticket->status = 'closed';
        $ticket->deleted_at = now();
        $ticket->save();

        event(new TicketClosed($ticket));

        return to_route('tickets.index.assigned');
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\TicketResponseSent;
use App\Http\Requests\StoreTicketResponseRequest;
use App\Models\Group;
use App\Models\GroupTicket;
use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GroupTicketsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Ticket $ticket)
    {
        $this->authorize('updateAdvanced', $ticket);

        $groups = Group::all()->pluck('id')->toArray();
        $request->validate([
            'group_id' => ['required', Rule::in($groups)]
        ]);

        if (GroupTicket::where('group_id', $request->group_id)->where('ticket_id', $ticket->id)->first() == null)
        {
            GroupTicket::create([
                'group_id' => $request->group_id,
                'ticket_id' => $ticket->id,
                'assigned_by' => $request->user()->id,
            ]);
        }

        return to_route('groups.show', $request->group_id);
    }

    public function sendResponse(StoreTicketResponseRequest $request, Group $group)
    {
        $this->authorize('update', $group);

        $files = [];

        if ($request->file('attachments')) {
            foreach ($request->file('attachments') as $file)
            {
                $path = $file->store('attachments');
                array_push($files, $path);
            }
        }

        foreach ($group->tickets as $ticket) {
            $response = TicketResponse::create([
                'response_by' => $request->user()->id,
                'ticket_id' => $ticket->id,
                'response' => $request->response,
                'attachments' => json_encode($files),
            ]);

            event(new TicketResponseSent($response));

            $response->ticket->status = 'waiting_for_student';
            $response->ticket->save();
        }

        return to_route('groups.show', $group->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group, Ticket $ticket)
    {
        $this->authorize('update', $group);

        $groupTicket = GroupTicket::where('group_id', $group->id)->where('ticket_id', $ticket->id)->first();
        $groupTicket->forceDelete();

        return to_route('groups.show', $group->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function closeTickets(Request $request, Group $group)
    {
        $this->authorize('update', $group);

        $request->validate([
            'summary' => ['string', 'nullable']
        ]);

        foreach ($group->tickets as $ticket) {
            $ticket->summary = $request->summary;
            $ticket->status = 'closed';
            $ticket->deleted_at = now();
            $ticket->save();

            $groupTicket = GroupTicket::where('group_id', $group->id)->where('ticket_id', $ticket->id)->first();
            $groupTicket->forceDelete();
        }

        return to_route('groups.show', $group->id);
    }
}

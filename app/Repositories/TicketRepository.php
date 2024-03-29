<?php

namespace App\Repositories;

use App\Events\TicketAssigned;
use App\Models\ClassroomManager;
use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface
{
    public function getAllTickets()
    {
        return Ticket::all();
    }

    public function getPaginatedTickets(int $perPage)
    {
        return Ticket::paginate($perPage);
    }

    public function getTicketById($ticketId)
    {
        return Ticket::findOrFail($ticketId);
    }

    public function getAllTicketsCreatedByUser($userId) {
        return Ticket::where('created_by', $userId)->whereNot('status', 'closed')->get();
    }

    public function getAllTicketsAssignedToUser($userId) {
        return Ticket::where('assigned_to', $userId)->whereNot('status', 'closed')->get();
    }

    public function deleteTicket($ticketId)
    {
        // TODO: Implement deleteTicket() method.
    }

    public function createTicket(array $ticketData)
    {
        $ticket = Ticket::create($ticketData);
        $this->reAssignTicket($ticket);
        return $ticket;
    }

    public function updateTicket($ticketId, array $ticketData)
    {
        // TODO: Implement updateTicket() method.
    }

    public function reAssignTicket(Ticket $ticket)
    {
        $manager = ClassroomManager::where('classroom_id', $ticket->classroom?->id)->where('category_type_id', $ticket->category->categoryType->id)->first();
        if ($manager)
        {
            $user = $manager->assignedTo;
        } else {
            $user = $ticket->category->categoryType->assignedTo;
        }

        $ticket->assigned_to = $user->id;
        $ticket->updated_on = now();
        $ticket->save();

        event(new TicketAssigned($ticket));
    }
}

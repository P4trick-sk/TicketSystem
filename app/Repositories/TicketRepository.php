<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface
{
    public function getAllTickets()
    {
        return Ticket::all();
    }

    public function getTicketById($ticketId)
    {
        return Ticket::findOrFail($ticketId);
    }

    public function getAllTicketsCreatedByUser($userId) {
        return Ticket::where('created_by', $userId)->get();
    }

    public function getAllTicketsAssignedToUser($userId) {
        return Ticket::where('assigned_to', $userId)->get();
    }

    public function getAllUnassignedTickets() {
        return Ticket::where('assigned_to', null)->get();
    }

    public function deleteTicket($ticketId)
    {
        // TODO: Implement deleteTicket() method.
    }

    public function createTicket(array $ticketData)
    {
        return Ticket::create($ticketData);
    }

    public function updateTicket($ticketId, array $ticketData)
    {
        // TODO: Implement updateTicket() method.
    }
}

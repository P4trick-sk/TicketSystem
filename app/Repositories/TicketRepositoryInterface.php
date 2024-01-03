<?php

namespace App\Repositories;

use App\Models\Ticket;

interface TicketRepositoryInterface
{
    public function getAllTickets();
    public function getTicketById($ticketId);
    public function deleteTicket($ticketId);
    public function createTicket(array $ticketData);
    public function updateTicket($ticketId, array $ticketData);
    public function reAssignTicket(Ticket $ticket);
}

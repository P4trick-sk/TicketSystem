<?php

namespace App\Repositories;

interface TicketRepositoryInterface
{
    public function getAllTickets();
    public function getTicketById($ticketId);
    public function deleteTicket($ticketId);
    public function createTicket(array $ticketData);
    public function updateTicket($ticketId, array $ticketData);
}

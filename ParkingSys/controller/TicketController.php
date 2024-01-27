<!-- TicketController.php -->
<?php
require_once __DIR__ . "/../model/Ticket.php";

class TicketController {

    public function createTicket($ticketType, $ticketPrice, $issueDate, $expiredDate, $customerID, $slotID) {
        $ticket = new Ticket(null,$ticketType, $ticketPrice, $issueDate, $expiredDate, $customerID, $slotID);
        $success = $ticket->create();
        if ($success) {
            // If the creation was successful, retrieve the ID of the newly inserted record
            $newTicketID = $ticket->ticketID;
            return $newTicketID;
        } else {
            return false;
        }
    }

    public function getTicketByID($ticketID) {
        $ticket = new Ticket(null,null,null,null,null,null,null); // Pass default values
        return $ticket->getByID($ticketID);
    }

    public function getAllTickets() {
        $ticket = new Ticket(null,null,null,null,null,null,null); // Pass default values
        return $ticket->getAll();
    }

    public function updateTicket($ticketID, $ticketType, $ticketPrice, $issueDate, $expiredDate, $customerID, $slotID) {
        $ticket = new Ticket(null,$ticketType, $ticketPrice, $issueDate, $expiredDate, $customerID, $slotID);
        $ticket->ticketID = $ticketID;
        return $ticket->update();
    }

    public function deleteTicket($ticketID) {
        $ticket = new Ticket($ticketID,null,null,null,null,null,null); // Pass default values
        return $ticket->delete();
    }

    public function deleteTicketByCustomerID($customerID) {
        $ticket = new Ticket(null,null,null,null,null,$customerID,null); // Pass default values
        return $ticket->deleteByCustomerID();
    }

    public static function getTicketByCustomerID($customerID) {
        $ticket = new Ticket(null,null,null,null,null,null,null); // Pass default values
        return $ticket->getTicketByCustomerID($customerID);
    }
}
?>

<!-- Ticket.php -->
<?php
require_once __DIR__ . "/../core/Connection.php";

class Ticket {
    public $ticketID;
    public $ticketType;
    public $ticketPrice;
    public $issueDate;
    public $expiredDate;
    public $customerID;
    public $slotID;

    public function __construct($ticketID,$ticketType, $ticketPrice, $issueDate, $expiredDate, $customerID, $slotID) {
        $this->ticketID = $ticketID;
        $this->ticketType = $ticketType;
        $this->ticketPrice = $ticketPrice;
        $this->issueDate = $issueDate;
        $this->expiredDate = $expiredDate;
        $this->customerID = $customerID;
        $this->slotID = $slotID;
    }

    public function getAll() {
        $result = [];
        $conn = DBConnection::Connect();
        $sql = "SELECT * FROM ticket";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($ticketID, $ticketType, $ticketPrice, $issueDate, $expiredDate, $customerID, $slotID);
        while ($stmt->fetch()) {
            $ticket = new Ticket($ticketID,$ticketType, $ticketPrice, $issueDate, $expiredDate, $customerID, $slotID);
            $ticket->ticketID = $ticketID;
            $result[] = $ticket;
        }
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function getByID($ticketID) {
        $conn = DBConnection::Connect();
        $query = "SELECT * FROM ticket WHERE ticketID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $ticketID);

        // Execute the query
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if ($data) {
            // Create a new Ticket object with the retrieved data
            $ticket = new Ticket($data['ticketID'],$data['ticketType'], $data['ticketPrice'], $data['issueDate'], $data['expiredDate'], $data['customerID'], $data['slotID']);
            $ticket->ticketID = $data['ticketID'];
            return $ticket;
        } else {
            // Return null if no result is found
            return null;
        }
    }

    public static function getTicketByCustomerID($customerID) {
        $conn = DBConnection::Connect();
        $sql = "SELECT * FROM ticket WHERE customerID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $stmt->bind_result($ticketID, $ticketType, $ticketPrice, $issueDate, $expiredDate, $customerID, $slotID);

        // Fetch the first result
        $stmt->fetch();

        if ($ticketID !== null) {
            $ticket = new Ticket($ticketID, $ticketType, $ticketPrice, $issueDate, $expiredDate, $customerID, $slotID);
            $ticket->ticketID = $ticketID;
        } else {
            // Return null if no ticket found
            $ticket = null;
        }

        $stmt->close();
        $conn->close();
        return $ticket;
    }


    public function create() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "INSERT INTO ticket (ticketType, ticketPrice, issueDate, expiredDate, customerID, slotID) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siissi", $this->ticketType, $this->ticketPrice, $this->issueDate, $this->expiredDate, $this->customerID, $this->slotID);
        $result = $stmt->execute();
        if ($result) {
            // If the insertion was successful, retrieve the ID of the newly inserted record
            $this->ticketID = $stmt->insert_id;
        }
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function update() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "UPDATE ticket SET ticketType=?, ticketPrice=?, issueDate=?, expiredDate=?, customerID=?, slotID=? WHERE ticketID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siissii", $this->ticketType, $this->ticketPrice, $this->issueDate, $this->expiredDate, $this->customerID, $this->slotID, $this->ticketID);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function delete() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "DELETE FROM ticket WHERE ticketID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->ticketID);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function deleteByCustomerID(){
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "DELETE FROM ticket WHERE customerID = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->customerID);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}

?>

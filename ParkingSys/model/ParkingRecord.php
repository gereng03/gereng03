<?php
require_once __DIR__ . "/../core/Connection.php";

class ParkingRecord {
    public $recordID;
    public $ticketID;
    public $timeIN;
    public $timeOut;
    public $paidStatus;

    public function __construct($recordID, $ticketID, $timeIN, $timeOut, $paidStatus) {
        $this->recordID = $recordID;
        $this->ticketID = $ticketID;
        $this->timeIN = $timeIN;
        $this->timeOut = $timeOut;
        $this->paidStatus = $paidStatus;
    }

    public function getAll() {
        $result = [];
        $conn = DBConnection::Connect();
        $sql = "SELECT * FROM parkingRecord";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($recordID, $ticketID, $timeIN, $timeOut, $paidStatus);
        while ($stmt->fetch()) {
            $parkingRecord = new ParkingRecord($recordID, $ticketID, $timeIN, $timeOut, $paidStatus);
            $result[] = $parkingRecord;
        }
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function getById($recordID) {
        $conn = DBConnection::Connect();
        $query = "SELECT * FROM parkingRecord WHERE recordID=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $recordID);
        $stmt->execute();
        $stmt->bind_result($ticketID, $timeIN, $timeOut, $paidStatus, $recordID);
        $stmt->fetch();
        $parkingRecord = new ParkingRecord($recordID, $ticketID, $timeIN, $timeOut, $paidStatus);
        $stmt->close();
        $conn->close();
        return $parkingRecord;
    }

    public function create() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "INSERT INTO parkingRecord (ticketID, timeIN, paidStatus) VALUES (?, CURRENT_TIMESTAMP, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $this->ticketID, $this->paidStatus);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function update() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "UPDATE parkingRecord SET timeOut = CURRENT_TIMESTAMP, paidStatus = ? WHERE ticketID = ? AND timeOut IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $this->paidStatus, $this->ticketID);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function delete() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "DELETE FROM parkingRecord WHERE recordID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->recordID);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}

?>

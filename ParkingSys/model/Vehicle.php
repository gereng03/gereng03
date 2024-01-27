<!-- Vehicle.php -->
<?php
require_once __DIR__ . "/../core/Connection.php";

class Vehicle {
    public $vehID;
    public $plateNumber;
    public $vehType;

    public function __construct($vehID,$plateNumber, $vehType) {
        $this->vehID = $vehID;
        $this->plateNumber = $plateNumber;
        $this->vehType = $vehType;
    }

    public function getAll() {
        $result = [];
        $conn = DBConnection::Connect();
        $sql = "SELECT * FROM vehicle";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($vehID, $plateNumber, $vehType);
        while ($stmt->fetch()) {
            $vehicle = new Vehicle($vehID,$plateNumber, $vehType);
            $vehicle->vehID = $vehID;
            $result[] = $vehicle;
        }
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function getByID($vehID) {
        $conn = DBConnection::Connect();
        $query = "SELECT * FROM vehicle WHERE vehID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $vehID);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if ($data) {
            $vehicle = new Vehicle($data['vehID'],$data['plateNumber'], $data['vehType']);
            $vehicle->vehID = $data['vehID'];
            return $vehicle;
        } else {
            return null;
        }
    }

    public static function getByPlateNumber($plateNumber)
    {
        $conn = DBConnection::Connect();
        $query = "SELECT * FROM vehicle WHERE plateNumber = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $plateNumber);
        $stmt->execute();
        $stmt->bind_result($vehID, $plateNumber, $vehType);
        $stmt->fetch();
        $vehicle = new Vehicle($vehID, $plateNumber, $vehType);
        $stmt->close();
        $conn->close();
        return $vehicle;
    }

    public function create() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "INSERT INTO vehicle (plateNumber, vehType) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $this->plateNumber, $this->vehType);
        $result = $stmt->execute();
        if ($result) {
            // If the insertion was successful, retrieve the ID of the newly inserted record
            $this->vehID = $stmt->insert_id;
        }
        $stmt->close();
        $conn->close();
        return $result;
    }


    public function update() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "UPDATE vehicle SET plateNumber = ?, vehType = ? WHERE vehID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $this->plateNumber, $this->vehType, $this->vehID);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function delete() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "DELETE FROM vehicle WHERE vehID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->vehID);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

}

?>

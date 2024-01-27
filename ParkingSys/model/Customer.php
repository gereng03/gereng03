<!-- Customer.php -->
<?php
require_once __DIR__ . "/../core/Connection.php";

class Customer {
    public $customerID;
    public $vehID;
    public $customerName;
    public $customerDOB;
    public $phoneNum;

    public function __construct($customerID,$vehID, $customerName, $customerDOB, $phoneNum) {
        $this->customerID =$customerID;
        $this->vehID = $vehID;
        $this->customerName = $customerName;
        $this->customerDOB = $customerDOB;
        $this->phoneNum = $phoneNum;
    }

    public function getAll() {
        $result = [];
        $conn = DBConnection::Connect();
        $sql = "SELECT * FROM customer order by customerName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($customerID, $vehID, $customerName, $customerDOB, $phoneNum);
        while ($stmt->fetch()) {
            $customer = new Customer($customerID,$vehID, $customerName, $customerDOB, $phoneNum);
            $customer->customerID = $customerID;
            $result[] = $customer;
        }
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function getById($customerID)
    {
        $conn = DBConnection::Connect();
        $query = "SELECT * FROM customer WHERE customerID=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $stmt->bind_result($customerID, $vehID, $customerName, $customerDOB, $phoneNum);
        $stmt->fetch();
        if ($customerID) {
            // Create a new Customer object with the retrieved data
            $customer = new Customer($customerID, $vehID, $customerName, $customerDOB, $phoneNum);
            return $customer;
        } else {
            // Return null if no result is found
            return null;
        }
    }

    public static function getCustomerByVehID($vehID) {
        $conn = DBConnection::Connect();
        $sql = "SELECT * FROM customer WHERE vehID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $vehID);
        $stmt->execute();
        $stmt->bind_result($customerID, $vehID, $customerName, $customerDOB, $phoneNum);
        if ($vehID){
            $customer = new Customer($customerID, $vehID, $customerName, $customerDOB, $phoneNum);
            return $customer;

        } else {
            return null;
        }

    }

    public static function getPlateNumberByVehID($vehID){
        $conn = DBConnection::Connect();
        $sql = "SELECT v.plateNumber
                FROM vehicle v
                JOIN customer c ON c.vehID = v.vehID
                WHERE c.vehID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $vehID);
        $stmt->execute();
        $stmt->bind_result($plateNumber);
        $stmt->fetch();
        $stmt->close();
        $conn->close();

        return $plateNumber;
    }

    public static function getVehTypeFromCustomer($customerID) {
        $conn = DBConnection::Connect();
        $sql = "SELECT v.vehType
                FROM vehicle v
                JOIN customer c ON c.vehID = v.vehID
                WHERE c.customerID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $stmt->bind_result($vehType);
        $stmt->fetch();
        $stmt->close();
        $conn->close();

        return $vehType;
    }


    public function create() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "INSERT INTO customer (vehID, customerName, customerDOB, phoneNum) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $this->vehID, $this->customerName, $this->customerDOB, $this->phoneNum);
        $result = $stmt->execute();
        if ($result) {
            // If the insertion was successful, retrieve the ID of the newly inserted record
            $this->customerID = $stmt->insert_id;
        }
        $stmt->close();
        $conn->close();
        return $result;
    }


    public function update() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "UPDATE customer SET customerName = ?, customerDOB = ?, phoneNum = ? WHERE customerID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi",  $this->customerName, $this->customerDOB, $this->phoneNum, $this->customerID);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function delete() {
        $result = false;
        $conn = DBConnection::Connect();
        $sql = "DELETE FROM customer WHERE customerID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->customerID);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}

?>
}

?>

    <?php
    require_once __DIR__ . "/../core/Connection.php";

    class Slot
    {
        public $slotID;
        public $areaID;
        public $SlotNumber;
        public $slotName;
        public $status;

        public function __construct($slotID, $areaID, $SlotNumber, $status, $slotName)
        {
            $this->slotID = $slotID;
            $this->areaID = $areaID;
            $this->slotName = $slotName;
            $this->status = $status;
            $this->SlotNumber = $SlotNumber;
        }

        public static function display()
        {
            $result = [];
            $conn = DBConnection::Connect();
            $sql = "SELECT * FROM parkingSlot order by SlotName ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($slotID, $areaID, $SlotNumber, $status, $slotName);
            while ($stmt->fetch()) {
                $slot = new Slot($slotID, $areaID, $SlotNumber,$status, $slotName); // Fix the typo here
                $result[] = $slot;
            }
            $stmt->close();
            $conn->close();
            return $result;
        }

        public function create()
        {
            $conn = DBConnection::Connect();
            $sql = "INSERT INTO parkingSlot (AreaID, SlotName, Status) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $this->areaID, $this->slotName, $this->status);
            $success = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $success;
        }

        public function update()
        {
            $conn = DBConnection::Connect();
            $sql = "UPDATE parkingSlot SET AreaID=?, SlotName=?, Status=? WHERE SlotID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issi", $this->areaID, $this->slotName, $this->status, $this->slotID);
            $success = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $success;
        }

        public function delete()
        {
            $conn = DBConnection::Connect();
            $sql = "DELETE FROM parkingSlot WHERE SlotID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $this->slotID);
            $success = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $success;
        }

        public static function getById($slotID)
        {
            $conn = DBConnection::Connect();
            $sql = "SELECT * FROM parkingSlot WHERE SlotID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $slotID);
            $stmt->execute();
            $stmt->bind_result($slotID, $areaID, $SlotNumber, $status, $slotName);
            $stmt->fetch();
            $parkingSlot = new Slot($slotID, $areaID, $SlotNumber, $status, $slotName);
            $stmt->close();
            $conn->close();
            return $parkingSlot;
        }

        public static function getByAreaId($areaID)
        {
            $conn = DBConnection::Connect();
            $sql = "SELECT * FROM parkingSlot WHERE AreaID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $areaID);
            $stmt->execute();
            $stmt->bind_result($slotID, $areaID, $SlotNumber, $status, $slotName);
            $result = []; // Initialize an array to store multiple Slot objects
            while ($stmt->fetch()) {
                $parkingSlot = new Slot($slotID, $areaID, $SlotNumber, $status, $slotName);
                $result[] = $parkingSlot;
            }
            $stmt->close();
            $conn->close();
            return $result; // Return an array of Slot objects
        }

    }
    ?>

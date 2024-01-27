    <!--Area.php-->
    <?php
    require_once __DIR__ . "/../core/Connection.php";
    class Area
    {
        public $areaID;
        public $areaName;
        public $capacity;
        public $currentOccupancy;

        public function __construct($areaID, $areaName, $capacity, $currentOccupancy)
        {
            $this->areaID = $areaID;
            $this->areaName = $areaName;
            $this->capacity = $capacity;
            $this->currentOccupancy = $currentOccupancy;
        }

        public function getAll(){
        $result = [];
        $conn = DBConnection::Connect();
        $sql = "select * from parkingarea order by areaName;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($areaID, $areaName, $capacity, $currentOccupancy);
        while ($stmt->fetch()) {
            $area = new Area($areaID, $areaName, $capacity, $currentOccupancy);
            $result[] = $area;
        }
        $stmt->close();
        $conn->close();
        return $result;

    }

        public static function getById($areaID)
        {
            $conn = DBConnection::Connect();
            $query = "SELECT * FROM parkingArea WHERE areaID=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $areaID);
            $stmt->execute();
            $stmt->bind_result($AreaID, $AreaName, $Capacity, $CurrentOccupancy);
            $stmt->fetch();

            if ($areaID) {
                // Create a new Area object with the retrieved data
                $parkingArea = new Area($AreaID, $AreaName, $Capacity, $CurrentOccupancy);
                return $parkingArea;
            } else {
                // Return null if no result is found
                return null;
            }
        }



        public function create($areaName, $capacity, $currentOccupancy) {
            try {
                $result = false;
                $conn = DBConnection::Connect();
                $sql = "INSERT INTO parkingArea (AreaName, Capacity, CurrentOccupancy) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                // Bind parameters
                $stmt->bind_param("sii", $areaName, $capacity, $currentOccupancy);
                // Execute the statement
                $result = $stmt->execute();
                // Close the statement and connection
                $stmt->close();
                $conn->close();
                // Return the result
                return $result;
            } catch (mysqli_sql_exception $e) {
               echo "Error<br>" . $e->getMessage();
            }
        }

        public function update()
        {
            $result = false;
            $conn = DBConnection::Connect();
            $sql = "UPDATE parkingArea SET areaName=?, capacity=?, currentOccupancy=? WHERE areaID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siii", $this->areaName, $this->capacity, $this->currentOccupancy, $this->areaID);
            $result = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $result;
        }

        public function delete()
        {
            $result = false;
            $conn = DBConnection::Connect();
            $sql = "DELETE FROM parkingArea WHERE areaID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $this->areaID);
            $result = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $result;
        }
    }
    ?>

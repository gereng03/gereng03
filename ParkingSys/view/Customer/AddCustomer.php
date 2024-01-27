<?php
// Include necessary files and classes
require_once __DIR__ . "/../../controller/CustomerController.php";
require_once __DIR__ . "/../../controller/VehicleController.php";
require_once __DIR__ . "/../../controller/SlotController.php";
require_once __DIR__ . "/../../controller/TicketController.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Retrieve data from the form
        $fullName = $_POST["fullName"];
        $dob = $_POST["dob"];
        $phoneNumber = $_POST["phoneNumber"];
        $licensePlate = $_POST["licensePlate"];
        $vehicleType = $_POST["vehicleType"];
        $parkingSlot = $_POST["parkingSlot"];
        $registrationType = $_POST["registrationType"];
        // Create a new VehicleController instance
        $vehicleController = new VehicleController();
        // Create a new Vehicle
        $vehicleID = $vehicleController->createVehicle($licensePlate, $vehicleType);

        if (!$vehicleID) {
            throw new Exception("Error: Unable to register vehicle.");
        }
        // Retrieve the vehicle ID after the insert operation
        echo "Vehicle ID: " . $vehicleID;
        // Create a new CustomerController instance
        $customerController = new CustomerController();
        // Create a new Customer
        $customerID= $customerController->createCustomer($vehicleID, $fullName, $dob, $phoneNumber);
        if (!$customerID) {
            throw new Exception("Error: Unable to register customer.");
        }
        // Create a new TicketController instance
        $ticketController = new TicketController();
        // Create a new Ticket
        $ticketObj = $ticketController->createTicket($registrationType, null, null, null, $customerID, $parkingSlot);

        if ($ticketObj) {
            echo "<script>alert('Thêm khách hàng thành công'); window.location.href='http://localhost:63342/ParkingSys/view/Customer/indexCustomer.php';</script>";
        } else {
            throw new Exception("Error: Unable to register ticket.");
        }
    } catch (Exception $exception) {
        echo "Error: " . $exception->getMessage();
    }

} else {
    // Handle other HTTP methods if necessary
    echo "Invalid request method.";
}
?>

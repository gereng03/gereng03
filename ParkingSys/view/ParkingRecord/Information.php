<?php
require_once __DIR__ . "/../../controller/VehicleController.php";
require_once __DIR__ . "/../../controller/CustomerController.php";
require_once __DIR__ . "/../../controller/TicketController.php";
require_once __DIR__ . "/../../controller/SlotController.php";
require_once __DIR__ . "/../../controller/AreaController.php";

// Check if the license plate is provided in the query string
if (isset($_GET['incominglicensePlate'])) {
    $licensePlate = $_GET['incominglicensePlate'];

    // Fetch vehicle information based on the provided license plate
    function fetchVehicleInfo($licensePlate) {
        // Initialize variables to store fetched data
        $vehicleType = $customerName = $ticketType = $slotName = "";

        // Instantiate necessary controllers
        $vehicleController = new VehicleController();
        $customerController = new CustomerController();
        $ticketController = new TicketController();
        $slotController = new SlotController();

        // Fetch vehicle object by plate number
        $vehicleObj = $vehicleController->getVehicleByPlateNumber($licensePlate);

        if ($vehicleObj) {
            // Extract vehicle ID from the vehicle object
            $vehicleID = $vehicleObj->vehID;

            // Fetch customer object by vehicle ID
            $customerObj = $customerController->getCustomersByVehID($vehicleID);

            if ($customerObj) {
                // Extract customer ID and name from the customer object
                $customerID = $customerObj->customerID;
                $customerName = $customerObj->customerName;

                // Fetch ticket object by customer ID
                $ticketObj = $ticketController->getTicketByCustomerID($customerID);

                if ($ticketObj) {
                    // Extract ticket type and slot ID from the ticket object
                    $ticketType = $ticketObj->ticketType;
                    $slotID = $ticketObj->slotID;

                    // Fetch slot object by slot ID
                    $slotObj = $slotController->getSlotByID($slotID);

                    if ($slotObj) {
                        // Extract slot name from the slot object
                        $slotName = $slotObj->slotName;
                    }
                }
            }
        }

        // Construct the result as an associative array
        $result = [
            'vehicleType' => $vehicleObj ? $vehicleObj->vehType : "",
            'customerName' => $customerName,
            'ticketType' => $ticketType,
            'slotName' => $slotName
        ];

        return $result;
    }

    // Fetch vehicle information
    $vehicleInfo = fetchVehicleInfo($licensePlate);

    // Output the vehicle information as JSON
    header('Content-Type: application/json');
    echo json_encode($vehicleInfo);
} else {
    // If license plate is not provided, return an error message
    echo "Error: License plate not provided.";
}
?>

<?php
require_once __DIR__ . "/../../controller/AreaController.php";
require_once __DIR__ . "/../../controller/SlotController.php";

// Check if AreaID is provided in the query parameters
if (isset($_GET['AreaID'])) {
    $areaID = $_GET['AreaID'];
    $areaController = new AreaController();
    $slotController = new SlotController();
    $parkingArea = $areaController->getParkingAreaByID($areaID);
    if ($parkingArea) {
        $parkingSlots = $slotController->getSlotsByAreaID($areaID);

        foreach ($parkingSlots as $slot) {
            $slotController->deleteSlot($slot->slotID);
        }
        $areaDeleted = $areaController->deleteParkingArea($areaID);
        if ($areaDeleted) {
            // Redirect to the index page or any other page after successful deletion
            header("Location: IndexParkingArea.php");
            exit();
        } else {
            // Handle error - unable to delete parking area
            echo "Error: Unable to delete parking area.";
        }
    } else {
        // Handle error - parking area not found
        echo "Error: Parking area not found.";
    }
} else {
    // Handle error - AreaID not provided in the query parameters
    echo "Error: AreaID not provided.";
}
?>

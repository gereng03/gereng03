<?php
require_once __DIR__ . "/../../controller/AreaController.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Validate and sanitize input
        $areaName = filter_input(INPUT_POST, 'areaName', FILTER_SANITIZE_STRING);
        $capacity = filter_input(INPUT_POST, 'capacity', FILTER_VALIDATE_INT);

        if (!$areaName || !$capacity) {
            throw new Exception("Invalid input data.");
        }

        $areaController = new AreaController();
        $success = $areaController->createParkingArea($areaName, $capacity, 0); // Assuming the initial occupancy is 0

        if ($success) {
            // Success modal
            echo "<script>alert('Thêm khu vực thành công'); window.location.href='http://localhost:63342/ParkingSys/view/ParkingArea/IndexParkingArea.php';</script>";
        } else {
            // Error modal
            echo "<script>alert('Lỗi khi thêm khu vực');</script>";
        }

    } catch (Exception $e) {
        // Handle exceptions (e.g., log the error, display a generic error message)
        echo "Error: " . $e->getMessage();
    }
}
?>

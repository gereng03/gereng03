<?php
require_once __DIR__ . "/../model/Vehicle.php";
class VehicleController {

    public function getAllVehicles() {
        $vehicle = new Vehicle(null,null,null);
        return $vehicle->getAll();
    }

    public function getVehicleByID($vehID) {
        $vehicle = new Vehicle(null,null,null);
        return $vehicle->getByID($vehID);
    }

    public function getVehicleByPlateNumber($plateNumber) {
        $vehicle = new Vehicle(null,null,null);
        return $vehicle->getByPlateNumber($plateNumber);
    }

    public function createVehicle($plateNumber, $vehType) {
        $vehicle = new Vehicle(null,$plateNumber, $vehType);
        $success = $vehicle->create();

        if ($success) {
            // If the creation was successful, retrieve the ID of the newly inserted record
            $newlyInsertedID = $vehicle->vehID;
            return $newlyInsertedID;
        } else {
            return false;
        }
    }

    public function updateVehicle($vehID, $plateNumber, $vehType) {
        $vehicle = new Vehicle(null,$plateNumber, $vehType);
        $vehicle->vehID = $vehID;
        return $vehicle->update();
    }

    public function deleteVehicle($vehID) {
        $vehicle = new Vehicle($vehID,null,null);
        return $vehicle->delete();
    }
}
?>

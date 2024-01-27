<!-- ParkingAreaController.php -->
<?php
require_once __DIR__ . "/../model/Area.php";

class AreaController
{
    public function getAllParkingAreas()
    {
        $parkingAreaModel = new Area(null,null,null,null);
        return $parkingAreaModel->getAll();
    }

    public function getParkingAreaByID($areaID)
    {
        $parkingAreaModel = new Area(null,null,null,null);
        return $parkingAreaModel->getByID($areaID);
    }

    public function createParkingArea($areaName, $capacity, $currentOccupancy)
    {
        $parkingAreaModel = new Area(null,null,null,null);
        return $parkingAreaModel->create($areaName, $capacity, $currentOccupancy);
    }

    public function updateParkingArea($areaID, $areaName, $capacity, $currentOccupancy)
    {
        $parkingAreaModel = new Area(null,null,null,null);
        $parkingArea = $parkingAreaModel->getByID($areaID);

        if ($parkingArea) {
            $parkingArea->areaName = $areaName;
            $parkingArea->capacity = $capacity;
            $parkingArea->currentOccupancy = $currentOccupancy;

            return $parkingArea->update();
        }

        return false;
    }

    public function deleteParkingArea($areaID)
    {
        $parkingAreaModel = new Area(null,null,null,null);
        $parkingArea = $parkingAreaModel->getByID($areaID);

        if ($parkingArea) {
            return $parkingArea->delete();
        }

        return false;
    }
}



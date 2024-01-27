<?php
require_once "ParkingRecord.php";


class ParkingRecordController {

    public function getAllRecords() {
        $parkingRecordModel = new ParkingRecord(null, null,null,null,null);
        return $parkingRecordModel->getAll();
    }

    public function getRecordById($recordID) {
        $parkingRecordModel = new ParkingRecord(null, null,null,null,null);
        return $parkingRecordModel->getById($recordID);
    }

    public function createRecord($ticketID, $paidStatus) {
        $parkingRecord = new ParkingRecord(null,$ticketID, null, null, $paidStatus);
        return $parkingRecord->create();
    }

    public function updateRecord($ticketID, $paidStatus) {
        $parkingRecord = new ParkingRecord(null,$ticketID, null, null, $paidStatus);
        return $parkingRecord->update();
    }

    public function deleteRecord($recordID) {
        $parkingRecord = new ParkingRecord($recordID,null,null,null,null);
        $parkingRecord->recordID = $recordID;
        return $parkingRecord->delete();
    }
}
<?php
require_once __DIR__ . "/../model/Slot.php";

class SlotController
{
    public function getAllSlots()
    {
        $slotModel = new Slot(null,null,null,null,null);
        return $slotModel->display();
    }

    public function getSlotByID($slotID)
    {
        $slotModel = new Slot(null,null,null,null,null);
        return $slotModel->getById($slotID);
    }

    public function getSlotStatus($slotID)
    {
        $slotModel = new Slot($slotID,null,null,null,null);
        $getSlot = $slotModel->getById($slotID);
        if($getSlot) {
            $slotStatus = $getSlot->status;
            return $slotStatus;
        }
        return false;
    }

    public function createSlot($areaID, $slotName, $status)
    {
        $slotModel = new Slot(null,null,null,null,null);
        $newSlot = new Slot(null, $areaID, null, $status, $slotName); // SlotID and SlotNumber are auto-incremented and set by the database
        return $newSlot->create();
    }

    public function updateSlot($slotID, $areaID, $slotName, $status)
    {
        $slotModel = new Slot(null,null,null,null,null);
        $slot = $slotModel->getById($slotID);

        if ($slot) {
            $slot->areaID = $areaID;
            $slot->slotName = $slotName;
            $slot->status = $status;

            return $slot->update();
        }

        return false;
    }

    public function deleteSlot($slotID)
    {
        $slotModel = new Slot(null,null,null,null,null);
        $slot = $slotModel->getById($slotID);

        if ($slot) {
            return $slot->delete();
        }

        return false;
    }

    public function getIdByName($slotName)
    {

    }
    public function getSlotsByAreaID($areaID)
    {
        $slotModel = new Slot(null,null,null,null,null);
        return $slotModel->getByAreaId($areaID);
    }
}


<?php
    require_once __DIR__ . "/../../controller/CustomerController.php";
    require_once __DIR__ . "/../../controller/VehicleController.php";
    require_once __DIR__ . "/../../controller/TicketController.php";

    if (isset($_GET['customerID'])){
        $customerID = $_GET['customerID'];
        $customer = new CustomerController();
        $customerObj = $customer->getCustomerByID($customerID);
        if($customerObj) {
            $ticket = new TicketController();
            $ticketDel = $ticket->deleteTicketByCustomerID($customerID);
            if($ticketDel){
                $customerDel = $customer->deleteCustomer($customerID);
                if ($customerDel) {
                    $vehicle = new VehicleController();
                    $vehicleDel = $vehicle->deleteVehicle($customerObj->vehID);
                    if($vehicleDel){
                        header("Location: indexCustomer.php");
                    } else {
                        echo "Lỗi không thể xóa phương tiện khách hàng";
                    }
                } else {
                    echo "Lỗi không thể xóa khách hàng";
                }
            } else {
                echo "Lỗi không thể xóa vé của khách hàng";
            }
        } else {
            echo "Lỗi không lấy được thông tin khách hàng";
        }


    }
?>

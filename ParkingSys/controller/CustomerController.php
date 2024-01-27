<?php
require_once __DIR__ . "/../model/Customer.php";
require_once __DIR__ . "/../core/Connection.php";
class CustomerController {

    public function getAllCustomers() {
        $customer = new Customer(null,null,null,null,null);
        return $customer->getAll();
    }

    public function getCustomerByID($customerID) {
        $customer = new Customer(null,null,null,null,null);
        return $customer->getById($customerID);
    }

    public function getCustomersByVehID($vehID) {
        $customer = new Customer(null,null,null,null,null);
        return $customer->getCustomerByVehID($vehID);

    }

    public function createCustomer($vehID, $customerName, $customerDOB, $phoneNum) {
        $newCustomer = new Customer(null,$vehID,$customerName,$customerDOB,$phoneNum);
        $success = $newCustomer->create();
        if ($success) {
            // If the creation was successful, retrieve the ID of the newly inserted record
            $newCustomerID = $newCustomer->customerID;
            return $newCustomerID;
        } else {
            return false;
        }
    }

    public function updateCustomer($customerID, $customerName, $customerDOB, $phoneNum) {
        $newCustomer = new Customer($customerID,null,$customerName,$customerDOB,$phoneNum);
        return $newCustomer->update();
    }

    public function deleteCustomer($customerID) {
        $customer = new Customer($customerID,null,null,null,null);
        return $customer->delete();
    }
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phần mềm bãi đỗ xe Smart Parking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?php
require_once __DIR__ . "/../../controller/CustomerController.php";
require_once __DIR__ . "/../../controller/VehicleController.php";

if (isset($_GET["customerID"])) {
    $customerID = $_GET["customerID"];
    $customerController = new CustomerController();
    $customer = $customerController->getCustomerByID($customerID);

    try {
        if (isset($_POST['update'])) {
            // Check if form is submitted via POST
            // Retrieve form data
            $customerID = $_POST["customerID"];
            $fullName = $_POST["fullName"];
            $dob = $_POST["dob"];
            $phoneNumber = $_POST["phoneNumber"];
            $licensePlate = $_POST["licensePlate"];
            $vehicleType = $_POST["vehicleType"];

            // Update vehicle information first
            $vehicleController = new VehicleController();
            $updateVehicleResult = $vehicleController->updateVehicle($customer->vehID, $licensePlate, $vehicleType);

            if ($updateVehicleResult) {
                $updateResult = $customerController->updateCustomer($customerID, $fullName, $dob, $phoneNumber);

                if ($updateResult) {
                    echo "Success";
                    header("Location: indexCustomer.php");
                } else {
                    throw new Exception("Failed to update customer information.");
                }
            } else {
                throw new Exception("Failed to update vehicle information.");
            }
        }
    } catch (Exception $e) {
        // Set an error message in the session
    }

    ?>


<div id="header">
    <div class="logo-header">
        <a href="../../index.php">
            <h3 class="logo-header text-theme"> Smart </h3>
            <h3 class="logo-header text-white"> Parking</h3>
        </a>
    </div>
    <div id="user-section">
        <span class="mr-2">Welcome, User</span>
        <a href="#">Logout</a>
    </div>
</div>

<div id="sidebar">
    <ul class="menu">
        <li class="user-infor">
            <img src="/assets/img/profile.png" alt="">
            <div class="">
                <h5 class="text-white">Admin</h5>
                <p class="text-white">Nhân viên</p>
            </div>
        </li>
        <li><a href="#" class="text-white">Quản lý phương tiện</a></li>
        <ul class="submenu">
            <li><a href="../ParkingRecord/IndexParkingRecord.php" class="text-white">Kiểm soát ra vào</a></li>
            <li><a href="#" class="text-white">Lịch sử đỗ xe</a></li>
        </ul>
        <li><a href="" class="text-white">Quản lý bãi xe</a></li>
        <li><a href="#" class="text-white">Đăng kí khách hàng</a></li>
        <li><a href="#" class="text-white">Thống kê</a></li>
    </ul>
</div>

<div id="content">
    <div class="container mt-5">
        <h2>Cập nhật thông tin khách hàng</h2>
        <hr>
        <form id="editCustomerForm"  method="post">
            <input type="hidden" name="customerID" value="<?php echo $customer->customerID ?>">
            <div class="row">
                <div class="col-md-6">
                    <!-- Left column -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo $customer->customerName; ?>" required>
                        <label for="fullName">Họ và tên</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $customer->customerDOB; ?>" required>
                        <label for="dob">Ngày sinh</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $customer->phoneNum; ?>" required>
                        <label for="phoneNumber">Số điện thoại</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="licensePlate" name="licensePlate" value="<?php echo $plateNumber = Customer::getPlateNumberByVehID($customer->vehID); ?>" required>
                        <label for="licensePlate">Biển số xe</label>
                    </div>
                    <!-- Add more fields as needed -->
                    <div class="form-floating mb-3">
                        <select class="form-select" id="vehicleType" name="vehicleType" required>
                            <?php
                            $vehicleType =  array("Xe đạp", "Xe máy", "Ô tô");
                            foreach ($vehicleType as $type) {
                                $selected = ($type == $customer->getVehTypeFromCustomer($customerID)) ? "selected" : "";
                                echo "<option value='$type' $selected>$type</option>";
                            }
                            ?>
                        </select>
                        <label for="vehicleType">Loại xe</label>
                    </div>
                </div>
            </div>
            <button name="update" type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>
<?php
}
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>





<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/index.css">
    <title>Thông tin khách hàng</title>
</head>
<?php
    include_once __DIR__ . "/../../controller/CustomerController.php";
    include_once __DIR__ . "/../../controller/TicketController.php";

    if (isset($_GET['customerID'])) {
        $customerID = $_GET['customerID'];
        $customerController = new CustomerController();
        $customer = $customerController->getCustomerByID($customerID);
    } else {
        header("Location: indexCustomer.php");
        exit();
    }
?>
<body>
<div id="header">
    <div class="logo-header">
        <a href="../../index.php"><h3 class="logo-header text-theme"> Smart <h3 class="logo-header text-white"> Parking</h3></h3></a>
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
        <h2 class="mb-4">Thông tin khách hàng</h2>
        <input type="hidden" name="customerID" value="<?php echo $customer->customerID ?>">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="fullName" disabled name="fullName" value="<?php echo $customer->customerName; ?>" required>
                    <label for="fullName">Họ và tên</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="dob" disabled name="dob" value="<?php echo $customer->customerDOB; ?>" required>
                    <label for="dob">Ngày sinh</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control" id="phoneNumber" disabled name="phoneNumber" value="<?php echo $customer->phoneNum; ?>" required>
                    <label for="phoneNumber">Số điện thoại</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="licensePlate" disabled name="licensePlate" value="<?php echo $plateNumber = Customer::getPlateNumberByVehID($customer->vehID); ?>" required>
                    <label for="licensePlate">Biển số xe</label>
                </div>
                <!-- Add more fields as needed -->
                <div class="form-floating mb-3">
                    <select class="form-select" id="vehicleType" name="vehicleType" disabled required>
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
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</html>
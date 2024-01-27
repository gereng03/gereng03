    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Phần mềm bãi đỗ xe Smart Parking</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../assets/css/index.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <?php
        include_once __DIR__ . "/../../controller/CustomerController.php";
        include_once __DIR__ . "/../../controller/SlotController.php";
        $customerController = new CustomerController();
        $customers = $customerController->getAllCustomers();

        $slotController = new SlotController();
        $slots = $slotController->getAllSlots();
        ?>
    </head>
    <body>
    <div id="header">
        <div class="logo-header">
            <a href="../../index.php">
                <h3 class="logo-header text-theme"> Smart <h3 class="logo-header text-white"> Parking</h3></h3>
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
            <li><a href="../ParkingRecord/IndexParkingRecord.php" class="text-white">Quản lý phương tiện</a></li>
            <li><a href="../ParkingArea/IndexParkingArea.php" class="text-white">Quản lý bãi xe</a></li>
            <li><a href="../Customer/indexCustomer.php" class="text-white">Quản lý khách hàng</a></li>
            <li><a href="../Ticket/IndexTicket.php" class="text-white">Quản lý vé</a></li>
            <li><a href="#" class="text-white">Thống kê</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div id="content">
        <div class="container mt-5">
            <h2>Quản lý khách hàng</h2>
            <hr>
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registrationModal">
                Thêm khách hàng
            </button>

            <div class="mt-4">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nhập tên khách hàng" name="searchKeyword">
                        <button class="btn btn-outline-secondary" type="submit" name="searchBtn">Tìm kiếm</button>
                    </div>
                </form>
            </div>
            <!-- Customer Table -->
            <div class="mt-4">
                <h5>Danh sách khách hàng</h5>
                <table class="table table-bordered align-middle">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Biển số xe</th>
                        <th>Loại xe</th>
                        <th></th>
                        <!-- Add more columns as needed -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($customers as $customer) { ?>
                        <tr>
                            <td><?php echo $customer->customerID; ?></td>
                            <td><?php echo $customer->customerName; ?></td>
                            <td><?php echo $customer->customerDOB; ?></td>
                            <td><?php echo $customer->phoneNum; ?></td>
                            <td><?php echo $plateNumber = Customer::getPlateNumberByVehID($customer->vehID); ?></td>
                            <td><?php echo $vehType = Customer::getVehTypeFromCustomer($customer->customerID)?></td>
                            <td>
                                <a href="ViewCustomer.php?customerID=<?php echo $customer->customerID; ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                <a href="EditCustomer.php?customerID=<?php echo $customer->customerID; ?>"
                                   class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="DeleteCustomer.php?customerID=<?php echo $customer->customerID; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Registration Form Modal -->
    <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrationModalLabel">Form đăng kí khách hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your registration form content -->
                    <form id="registrationForm" action="AddCustomer.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Left column -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                                    <label for="fullName">Họ và tên</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                    <label for="dob">Ngày sinh</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                                    <label for="phoneNumber">Số điện thoại</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="licensePlate" name="licensePlate" required>
                                    <label for="licensePlate">Biển số xe</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="vehicleType" name="vehicleType" required>
                                        <option value="" disabled selected>--Chọn loại xe--</option>
                                        <option value="Xe đạp">Xe đạp</option>
                                        <option value="Xe máy">Xe máy</option>
                                        <option value="Ô tô">Ô tô</option>
                                    </select>
                                    <label for="vehicleType">Loại xe</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Right column -->
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="parkingSlot" name="parkingSlot" required>
                                        <option value="" disabled selected>--Chọn nơi đỗ--</option>
                                        <?php
                                        foreach ($slots as $slot) {
                                            echo "<option value='" . $slot->slotID . "'>" . $slot->slotName . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="parkingSlot">Chọn nơi đỗ xe</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-control" id="registrationType" name="registrationType" required>
                                        <option value="Vé ngày">Vé ngày</option>
                                        <option value="Vé tháng">Vé tháng</option>
                                    </select>
                                    <label for="registrationType">Đăng kí vé</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="ticketPrice" name="ticketPrice" required
                                           disabled>
                                    <label for="ticketPrice">Giá vé</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Đăng kí</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this script before the closing </body> tag -->
    <script>
        // Function to update ticket price based on registration type
        function updateTicketPrice() {
            const registrationType = document.getElementById('registrationType').value;
            const ticketPriceField = document.getElementById('ticketPrice');

            // Set ticket price based on registration type
            if (registrationType === 'Vé ngày') {
                ticketPriceField.value = '5.000đ ';
            } else if (registrationType === 'Vé tháng') {
                ticketPriceField.value = '100.000đ';
            } else {
                // Handle other cases or provide a default value
                ticketPriceField.value = '';
            }

        }

        // Attach the function to the change event of the registration type dropdown
        document.getElementById('registrationType').addEventListener('change', updateTicketPrice);
        // Initial call to set the default ticket price
        updateTicketPrice();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
    </body>
    </html>





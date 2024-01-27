<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý ra vào</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
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
        <li><a href="IndexParkingRecord.php" class="text-white">Quản lý phương tiện</a></li>
        <li><a href="../ParkingArea/IndexParkingArea.php" class="text-white">Quản lý bãi xe</a></li>
        <li><a href="../Customer/indexCustomer.php" class="text-white">Quản lý khách hàng</a></li>
        <li><a href="../Ticket/IndexTicket.php" class="text-white">Quản lý vé</a></li>
        <li><a href="#" class="text-white">Thống kê</a></li>
    </ul>
</div>

<!-- Content -->
<div id="content">
    <div class="container mt-5">
        <h2>Quản lý ra vào</h2>
        <hr>
        <div class="row">
            <!-- Incoming Vehicle Form -->
            <div class="col-md-6 p-3">
                <h4>Xe vào</h4>
                <form id="incomingForm">
                    <!-- Search Form -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="incomingLicensePlateSearch" name="incominglicensePlate" placeholder=" Nhập biển số xe ">
                        <button type="button" class="btn btn-primary" onclick="searchLicensePlate('incomingLicensePlateSearch', 'incomingForm')"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </form>

                <!-- Information Display Form -->
                <form id="incomingDisplayForm" style="display: none;">
                    <!-- Displayed Information Inputs -->
                    <div class="form-floating mb-3">
                        <select class="form-control" id="incomingVehicleType" disabled>
                            <option value="" disabled selected></option>
                            <option>Ô tô</option>
                            <option>Xe máy</option>
                            <option>Xe đạp</option>
                            <!-- Add more options as needed -->
                        </select>
                        <label for="incomingVehicleType">Loại xe:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="incomingCustomer" placeholder=" " disabled>
                        <label for="incomingCustomer">Khách hàng:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-control" id="incomingTicketType" disabled>
                            <option value="" disabled selected></option>
                            <option>Ngày</option>
                            <option>Tháng</option>
                            <!-- Add more options as needed -->
                        </select>
                        <label for="incomingTicketType">Loại vé:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="incomingParkingArea" placeholder=" " disabled>
                        <label for="incomingParkingArea">Khu vực đỗ:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="incomingParkingPosition" placeholder=" " disabled>
                        <label for="incomingParkingPosition">Vị trí đỗ:</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <!-- Egress Vehicle Form -->
            <div class="col-md-6 p-3">
                <h4>Xe ra</h4>
                <form id="egressForm">
                    <!-- Search Form -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="egressLicensePlateSearch" placeholder=" Nhập biển số xe ">
                        <button type="button" class="btn btn-primary" onclick="searchLicensePlate('egressLicensePlateSearch', 'egressForm')"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </form>

                <!-- Information Display Form -->
                <form id="egressDisplayForm" style="display: none;">
                    <!-- Displayed Information Inputs -->
                    <div class="form-floating mb-3">
                        <select class="form-control" id="egressVehicleType" disabled>
                            <option value="" disabled selected></option>
                            <option>Ô tô</option>
                            <option>Xe máy</option>
                            <option>Xe đạp</option>
                            <!-- Add more options as needed -->
                        </select>
                        <label for="egressVehicleType">Loại xe:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="egressCustomer" placeholder=" " disabled>
                        <label for="egressCustomer">Khách hàng:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-control" id="egressTicketType" disabled>
                            <option value="" disabled selected></option>
                            <option>Ngày</option>
                            <option>Tháng</option>
                            <!-- Add more options as needed -->
                        </select>
                        <label for="egressTicketType">Loại vé:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="egressParkingArea" placeholder=" " disabled>
                        <label for="egressParkingArea">Khu vực đỗ:</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="egressParkingPosition" placeholder=" " disabled>
                        <label for="egressParkingPosition">Vị trí đỗ:</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                try {
                    const vehicleInfo = JSON.parse(xhr.responseText);
                    updateDisplayForm(vehicleInfo, 'incomingDisplayForm');
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            } else {
                console.error('Error fetching vehicle information:', xhr.status);
            }
        }
    };

    function searchLicensePlate(searchInputId, displayFormId) {
        const licensePlateValue = document.getElementById(searchInputId).value;
        const url = 'Information.php';
        const params = 'licensePlate=' + licensePlateValue;
        xhr.open('GET', url + '?' + params, true);
        xhr.send();
    }

    function updateDisplayForm(vehicleInfo, displayFormId) {
        const displayForm = document.getElementById(displayFormId);
        displayForm.style.display = 'block'; // Display the form
        // Update form fields with vehicle information
        document.getElementById('incomingVehicleType').value = vehicleInfo.vehicleType;
        document.getElementById('incomingCustomer').value = vehicleInfo.customerName;
        document.getElementById('incomingTicketType').value = vehicleInfo.ticketType;
        document.getElementById('incomingParkingArea').value = vehicleInfo.slotName;
    }


</script>



</body>
</html>

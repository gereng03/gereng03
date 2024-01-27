<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phần mềm bãi đỗ xe Smart Parking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/index.css">
</head>
<body>
    <div id="header">
        <div class="logo-header">
          <a href="index.php"><h3 class="logo-header text-theme"> Smart <h3 class="logo-header text-white"> Parking</h3></h3></a>
        </div>
        <div id="user-section">
          <span class="mr-2">Welcome, User</span>
          <a href="#">Logout</a>
        </div>
      </div>

      <div id="sidebar">
        <ul class="menu">
            <li class="user-infor">
                <img src="assets/img/profile.png" alt="">
                <div class="">
                    <h5 class="text-white">Admin</h5>
                    
                    <p class="text-white">Nhân viên</p>
                </div>
            </li>
            <li><a href="view/ParkingRecord/IndexParkingRecord.php" class="text-white">Quản lý phương tiện</a></li>
            <li><a href="view/ParkingArea/IndexParkingArea.php" class="text-white">Quản lý bãi xe</a></li>
            <li><a href="view/Customer/indexCustomer.php" class="text-white">Quản lý khách hàng</a></li>
            <li><a href="view/Ticket/IndexTicket.php" class="text-white">Quản lý vé</a></li>
            <li><a href="" class="text-white">Thống kê</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div id="content">
        Content
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submenu1 = document.querySelector('#sidebar li:nth-child(2) .submenu1');
            const submenu2 = document.querySelector('#sidebar li:nth-child(5) .submenu2);

            document.querySelector('#sidebar li:nth-child(2)').addEventListener('click', function() {
                submenu1.style.display = (submenu1.style.display === 'block') ? 'none' : 'block';
            });

            document.querySelector('#sidebar li:nth-child(5)').addEventListener('click', function() {
                submenu2.style.display = (submenu2.style.display === 'block') ? 'none' : 'block';
            });
        });
    </script>

</html>
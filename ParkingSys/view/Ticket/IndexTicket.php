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
    <?php
    include_once __DIR__ . "/../../controller/TicketController.php";
    include_once __DIR__ . "/../../controller/CustomerController.php";
    $ticketController = new TicketController();
    $ticket = $ticketController->getAllTickets();

    ?>
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
            <img src="../../assets/img/profile.png" alt="">
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

<div id="content">
    <div class="container mt-5">
        <h2>Quản lý vé</h2>
        <hr>
        <?php if (!empty($ticket)) { ?>
            <table class="table table-bordered align-middle mt-4 caption-top">
                <!-- ... (existing table structure) ... -->
                <caption>Danh sách vé</caption>
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col" >Loại vé</th>
                    <th scope="col" >Giá vé</th>
                    <th scope="col" >Từ ngày</th>
                    <th scope="col">Đến ngày</th>
                    <th scope="col">Khách hàng</th>
                    <th scope="col">Nơi đỗ</th>
                    <th scope="col">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $stt = 1;
                foreach ($ticket as $ve) {?>
                    <tr>
                        <td><?php echo $stt ?></td>
                        <td><?php echo $ve->ticketType ?></td>
                        <td><?php echo $ve->ticketPrice ?></td>
                        <td><?php echo $ve->issueDate ?></td>
                        <td><?php echo $ve->expiredDate ?></td>
                        <td><?php echo $ve->customerID ?></td>
                        <td><?php echo $ve->slotID ?></td>
                        <td>
                            <a href="" class="btn btn-success">Gia hạn</a>
                        </td>
                    </tr>
                    <?php $stt++;
                }
                ?>
                </tbody>
            </table>
        <?php } else {
            echo "<p class='mt-3'>Không có thông tin!</p>";
        } ?>
    </div>
</div>
</body>
</html>
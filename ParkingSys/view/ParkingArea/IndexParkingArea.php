<!--IndexParkingArea.php-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bãi xe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <?php
    include_once "../../core/Connection.php";
    include_once "../../model/Area.php";
    // Instantiate the parkingArea class
    $parkingAreaObj = new Area(null, null, null, null);
    // Retrieve a list of parking areas
    $parkingAreas = $parkingAreaObj->getAll();
?>
</head>
<body>
    <div id="header">
        <div class="logo-header">
            <a href="../../index.php"><h3 class="logo-header text-theme"> Smart </h3><h3 class="logo-header text-white"> Parking</h3></a>
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
            <li><a href="IndexParkingArea.php" class="text-white">Quản lý bãi xe</a></li>
            <li><a href="../Customer/indexCustomer.php" class="text-white">Quản lý khách hàng</a></li>
            <li><a href="../Ticket/IndexTicket.php" class="text-white">Quản lý vé</a></li>
            <li><a href="#" class="text-white">Thống kê</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div id="content">
        <div class="container mt-5">
            <h2>Quản lý bãi xe</h2>
            <hr>
            <a href="" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addParkingAreaModal">Thêm khu vực</a>
            <div class="container">
                <form class="form-inline ">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <?php if (!empty($parkingAreas)) { ?>
                <table class="table table-bordered align-middle mt-4 caption-top">
                    <!-- ... (existing table structure) ... -->
                    <caption>Danh sách khu vực</caption>
                    <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col" >Khu vực</th>
                        <th scope="col" >Số lượng</th>
                        <th scope="col" >Số lượng đã sử dụng</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stt = 1;
                    foreach ($parkingAreas as $area) {?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $area->areaName ?></td>
                            <td><?php echo $area->capacity ?></td>
                            <td><?php echo $area->currentOccupancy ?></td>
                            <td>
                                <a href="./ViewParkingArea.php?AreaID=<?php echo $area->areaID; ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                <a href="./EditParkingArea.php?AreaID=<?php echo $area->areaID; ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="./DeleteParkingArea.php?AreaID=<?php echo $area->areaID ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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

    <!-- Add Parking Area Modal -->
    <div class="modal fade" id="addParkingAreaModal" tabindex="-1" aria-labelledby="addParkingAreaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addParkingAreaModalLabel">Thêm khu vực mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your form for adding a new parking area here -->
                    <form method="post" action="/view/ParkingArea/AddParkingArea.php">
                        <!-- Form fields go here -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="areaName" name="areaName" required>
                            <label for="areaName" class="form-label">Tên khu vực:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="capacity" name="capacity" required>
                            <label for="capacity" class="form-label">Số lượng chỗ đỗ:</label>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Khu vực đã được thêm thành công!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Không thể thêm khu vực. Vui lòng thử lại.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let submenu = document.querySelector('.submenu');

        document.querySelector('#sidebar li:nth-child(2)').addEventListener('click', function() {
        submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
      }); 
    });
    </script>
</html>
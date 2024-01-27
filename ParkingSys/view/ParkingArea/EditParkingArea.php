
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
    include_once __DIR__ . "/../../controller/AreaController.php";
    include_once __DIR__ . "/../../controller/SlotController.php";

    if(isset($_GET['AreaID'])) {
        $areaID = $_GET['AreaID'];
        $parkingAreaObj = new AreaController();
        $selectedArea = $parkingAreaObj->getParkingAreaByID($areaID);

    } else {
        echo "no AreaID";
    }
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
        <li><a href="IndexParkingArea.php" class="text-white">Quản lý bãi xe</a></li>
        <li><a href="#" class="text-white">Đăng kí khách hàng</a></li>
        <li><a href="#" class="text-white">Thống kê</a></li>
    </ul>
</div>

<!-- Content -->
<div id="content">
    <!-- Add Bootstrap container class for better layout -->
    <div class="container mt-5">
        <h2 class="mb-4">Thông tin khu vực</h2>
        <hr>
            <input type="hidden" name="areaID" value="<?php echo $selectedArea->areaID?>">
            <div class="mb-3">
                <label for="areaName" class="form-label">Khu vực:</label>
                <input type="text" class="form-control" id="areaName" name="areaName" value="<?php echo $selectedArea->areaName; ?>" required>
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">Số lượng:</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo $selectedArea->capacity; ?>" required>
            </div>
            <!-- Table for displaying parking slots -->
            <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addParkingAreaModal">
                Thêm nơi đỗ xe
            </a>
            <div class="mb-3">
                <table class="table table-bordered caption-top align-middle">
                    <caption>Danh sách nơi đỗ xe</caption>
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên slot</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $slots = new SlotController();
                    $parkingSlots = $slots->getSlotsByAreaID($areaID);
                    $i = 1;
                    foreach ($parkingSlots as $slot) {
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $slot->slotName; ?></td>
                            <td>
                                <?php
                                // Add a conditional statement to check the status
                                if ($slot->status == 0) {
                                    // Empty slot - use Bootstrap success class (green)
                                    echo "<span class='badge text-bg-success'>Trống</span>";
                                } elseif ($slot->status == 1) {
                                    // In-use slot - use Bootstrap danger class (red)
                                    echo "<span class='badge text-bg-danger'>Đang sử dụng</span>";
                                } else {
                                    echo "Unknown Status"; // Handle other cases if needed
                                }
                                ?>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="deleteSlotID" value="<?php echo $slot->slotID; ?>">
                                    <button name="del" type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#inUseSlotModal">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
    </div>

</div>

<?php
if (isset($_POST['del'])) {
    $slotID = $_POST['deleteSlotID'];
    // Check the status of the slot before deleting
    $slotStatus = $slots->getSlotStatus($slotID);

    if ($slotStatus == 1) {
        // In-use slot, display alert
        echo "<script>alert('Không thể xóa chỗ đỗ xe này vì đang có xe sử dụng. Vui lòng kiểm tra lại.');</script>";
    } else {
        // Slot is not in use, proceed with deletion
        $slotDel = $slots->deleteSlot($slotID);
        if ($slotDel) {
            // Display success message or update content dynamically
            echo "<script>alert('Slot deleted successfully!');</script>";
        } else {
            // Display error message on failure
            echo "<script>alert('Error when deleting SlotID');</script>";
        }
    }
}
?>

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
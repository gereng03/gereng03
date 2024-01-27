<!--Connection.php-->
<?php
class DBConnection{
    static function Connect() {
        $servername = "localhost:3306";
        $username = "root";
        $password = "matkhau";
        $dbname = "db_parking";
        // Khởi tạo kết nối
        try {
            $conn = new mysqli($servername, $username, $password, $dbname);
            return $conn;
        } catch (Exception $e) {
            echo "failed to connect" . $e->getMessage();
            return null;
        }
    }
}
?>

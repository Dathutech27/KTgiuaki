<?php
$servername = "localhost"; // Máy chủ cơ sở dữ liệu (thường là localhost)
$username = "root";        // Tên người dùng MySQL (thường là root nếu không thay đổi)
$password = "";            // Mật khẩu người dùng MySQL (để trống nếu không có mật khẩu)
$dbname = "test1";         // Tên cơ sở dữ liệu bạn muốn kết nối (lấy từ phpMyAdmin)

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
echo "Kết nối thành công!";
?>

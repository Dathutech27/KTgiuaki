<?php
include('../includes/header.php');
include('../includes/connect.php');

// Lấy ID sinh viên từ URL
$id = $_GET['id'];

// Truy vấn để xóa sinh viên
$sql = "DELETE FROM sinhvien WHERE MaSV = '$id'";  // Đảm bảo sử dụng bảng sinhvien và cột MaSV

if ($conn->query($sql) === TRUE) {
    echo "Sinh viên đã được xóa!";
} else {
    echo "Lỗi: " . $conn->error;
}

include('../includes/footer.php');
?>

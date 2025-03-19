<?php
// functions.php
function get_students($conn) {
    $sql = "SELECT * FROM sinhvien";  // Lấy dữ liệu từ bảng sinhvien
    $result = $conn->query($sql);  // Thực thi câu truy vấn SQL

    // Kiểm tra nếu truy vấn không thành công
    if (!$result) {
        die("Query failed: " . $conn->error);  // Nếu có lỗi trong truy vấn, in ra thông báo lỗi
    }

    return $result;  // Trả về kết quả truy vấn
}


<?php
session_start();
include('../includes/connect.php'); // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mssv = $_POST['mssv']; // Lấy MSSV từ form

    // Truy vấn để kiểm tra MSSV trong bảng sinhvien
    $sql = "SELECT * FROM sinhvien WHERE MaSV = '$mssv'"; // Thay đổi từ 'users' thành 'sinhvien' và 'mssv' thành 'MaSV'
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Lưu thông tin người dùng vào session
        $_SESSION['mssv'] = $mssv;  // Lưu MSSV vào session
        $_SESSION['user_id'] = $user['id']; // Lưu ID người dùng vào session
        header('Location: index.php');  // Chuyển hướng về trang chủ sau khi đăng nhập thành công
        exit();
    } else {
        $error_message = "MSSV không tồn tại!";
    }
}
?>

<h2>Đăng nhập</h2>
<?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>
<form action="login.php" method="POST">
    <label for="mssv">MSSV:</label>  <!-- Thay đổi từ "username" thành "mssv" -->
    <input type="text" name="mssv" id="mssv" required><br>  <!-- Thay đổi từ "username" thành "mssv" -->
    <input type="submit" value="Đăng nhập">
</form>

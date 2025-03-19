<?php
session_start(); // Khởi tạo session
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh Viên</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
<header>
    <h1>Hệ thống Quản lý Sinh Viên</h1>
    <nav>
        <a href="index.php">Trang chủ</a> | 
        <a href="add_student.php">Thêm sinh viên</a> | 
        <a href="register_course.php">Đăng ký khóa học</a>

        <?php
        // Kiểm tra nếu người dùng đã đăng nhập
        if (isset($_SESSION['username'])) {
            // Hiển thị tên người dùng và liên kết đăng xuất
            echo " | <span>Xin chào, " . $_SESSION['username'] . "</span>";
            echo " | <a href='logout.php'>Đăng xuất</a>";
        } else {
            // Nếu chưa đăng nhập, hiển thị liên kết đăng nhập
            echo " | <a href='login.php'>Đăng nhập</a>";
        }
        ?>
    </nav>
</header>

<main>

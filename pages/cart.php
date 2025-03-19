<?php
session_start();
include("db.php");  // Kết nối với cơ sở dữ liệu

// Kiểm tra nếu sinh viên đã đăng nhập
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Lấy các học phần đã đăng ký của sinh viên
$student_id = $_SESSION['username'];
$query = "SELECT hocphan.course_id, hocphan.course_name FROM dangky
          JOIN hocphan ON dangky.course_id = hocphan.course_id
          WHERE dangky.student_id = '$student_id'";
$result = mysqli_query($conn, $query);

if (isset($_POST['delete'])) {
    $course_id = $_POST['course_id'];
    // Xóa học phần khỏi giỏ hàng
    $delete_query = "DELETE FROM dangky WHERE student_id = '$student_id' AND course_id = '$course_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Đã xóa học phần khỏi giỏ hàng!');</script>";
        header('Location: cart.php');  // Tải lại trang sau khi xóa
    } else {
        echo "<script>alert('Xóa học phần thất bại!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng</title>
</head>
<body>
    <h1>Giỏ Hàng Của Bạn</h1>

    <table>
        <tr>
            <th>Tên Học Phần</th>
            <th>Hành Động</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['course_name']; ?></td>
                <td>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="course_id" value="<?php echo $row['course_id']; ?>">
                        <button type="submit" name="delete">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

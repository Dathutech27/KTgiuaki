<?php
include('../includes/header.php');  // Đảm bảo đường dẫn chính xác
include('../includes/connect.php');
include('../includes/functions.php');  // Đảm bảo file functions.php được include đúng

// Lấy danh sách sinh viên
$students = get_students($conn);  // Lấy kết quả truy vấn từ hàm get_students

// Kiểm tra nếu $students không phải là null và có kết quả trả về
if ($students === null) {
    die("Lỗi: Truy vấn không thành công.");
}
?>

<h2>Danh sách sinh viên</h2>
<table border="1">
    <tr>
        <th>Mã sinh viên</th>
        <th>Họ tên</th>
        <th>Giới tính</th>
        <th>Ngày sinh</th>
        <th>Hình ảnh</th>  <!-- Thêm cột hình ảnh -->
        <th>Thao tác</th>
    </tr>
    <?php 
    // Kiểm tra nếu có kết quả
    if ($students->num_rows > 0) {
        // Duyệt qua tất cả các sinh viên trong bảng
        while($row = $students->fetch_assoc()) { 
    ?>
    <tr>
        <td><?php echo $row['MaSV']; ?></td>  <!-- Hiển thị MaSV -->
        <td><?php echo $row['HoTen']; ?></td> <!-- Hiển thị HoTen -->
        <td><?php echo $row['GioiTinh']; ?></td> <!-- Hiển thị GioiTinh -->
        <td><?php echo $row['NgaySinh']; ?></td> <!-- Hiển thị NgaySinh -->
        <td><img src="<?php echo $row['Hinh']; ?>" alt="Hình ảnh sinh viên" width="100"></td>  <!-- Hiển thị hình ảnh -->
        <td>
            <a href="edit_student.php?id=<?php echo $row['MaSV']; ?>">Sửa</a> | 
            <a href="delete_student.php?id=<?php echo $row['MaSV']; ?>">Xóa</a> |
            <a href="detail_student.php?id=<?php echo $row['MaSV']; ?>">Xem chi tiết</a>  <!-- Thêm liên kết đến trang chi tiết -->
        </td>
    </tr>
    <?php 
        }
    } else {
        echo "<tr><td colspan='6'>Không có dữ liệu sinh viên nào.</td></tr>";
    }
    ?>
</table>

<?php
include('../includes/footer.php');
?>

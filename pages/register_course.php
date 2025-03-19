<?php
include('../includes/header.php');
include('../includes/connect.php');

// Lấy danh sách các học phần
$sql = "SELECT * FROM hocphan";
$result = $conn->query($sql);

// Kiểm tra nếu có lỗi kết nối hoặc truy vấn
if (!$result) {
    die("Lỗi: " . $conn->error);
}

// Xử lý đăng ký học phần
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $MaSV = $_POST['MaSV'];  // Mã sinh viên
    $MaHP = $_POST['MaHP'];  // Mã học phần

    // Kiểm tra nếu Mã sinh viên và Mã học phần hợp lệ
    if (empty($MaSV) || empty($MaHP)) {
        echo "Mã sinh viên và Mã học phần không được để trống.";
    } else {
        // Cập nhật thông tin đăng ký học phần
        $NgayDK = date('Y-m-d');  // Lấy ngày hiện tại làm ngày đăng ký
        $sql_insert = "INSERT INTO dangky (MaSV, MaHP, NgayDK) VALUES ('$MaSV', '$MaHP', '$NgayDK')";  // Chèn vào bảng dangky

        if ($conn->query($sql_insert) === TRUE) {
            echo "Đăng ký học phần thành công!";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
}
?>

<h2>Danh sách học phần</h2>
<form action="register_course.php" method="POST">
    <label for="MaSV">Mã sinh viên:</label>
    <input type="text" name="MaSV" id="MaSV" required><br>

    <label for="MaHP">Chọn học phần:</label>
    <select name="MaHP" id="MaHP" required>
        <?php 
        // Kiểm tra nếu có học phần trong cơ sở dữ liệu
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { 
        ?>
        <option value="<?php echo $row['MaHP']; ?>"><?php echo $row['TenHP']; ?> - <?php echo $row['SoTinChi']; ?> tín chỉ</option>
        <?php 
            }
        } else {
            echo "<option value=''>Không có học phần nào</option>";
        }
        ?>
    </select><br>

    <input type="submit" value="Đăng ký">
</form>

<?php
include('../includes/footer.php');
?>

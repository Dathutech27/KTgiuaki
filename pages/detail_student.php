<?php
include('../includes/header.php');
include('../includes/connect.php');

// Lấy ID sinh viên từ URL
$MaSV = $_GET['id'];  // Lấy MaSV từ URL

// Truy vấn thông tin sinh viên theo MaSV
$sql = "SELECT * FROM sinhvien WHERE MaSV = '$MaSV'";  // Sử dụng MaSV để lấy thông tin
$result = $conn->query($sql);

// Kiểm tra nếu sinh viên tồn tại
if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();  // Lấy thông tin sinh viên
} else {
    echo "Không tìm thấy sinh viên với Mã sinh viên: $MaSV.";
    exit();
}
?>

<h2>Chi tiết sinh viên</h2>
<p><strong>Mã sinh viên:</strong> <?php echo $student['MaSV']; ?></p>
<p><strong>Họ tên:</strong> <?php echo $student['HoTen']; ?></p>
<p><strong>Giới tính:</strong> <?php echo $student['GioiTinh']; ?></p>
<p><strong>Ngày sinh:</strong> <?php echo $student['NgaySinh']; ?></p>
<p><strong>Hình ảnh:</strong> <img src="<?php echo $student['Hinh']; ?>" alt="Hình ảnh sinh viên" width="150"></p>
<p><strong>Mã ngành:</strong> <?php echo $student['MaNganh']; ?></p>

<?php
include('../includes/footer.php');
?>

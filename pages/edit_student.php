<?php
include('../includes/header.php');  // Đảm bảo đường dẫn chính xác
include('../includes/connect.php');

// Lấy ID sinh viên từ URL
$MaSV = $_GET['id'];  // Lấy MaSV từ URL

// Truy vấn thông tin sinh viên theo MaSV
$sql = "SELECT * FROM sinhvien WHERE MaSV = '$MaSV'";
$result = $conn->query($sql);

// Kiểm tra nếu sinh viên tồn tại
if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();  // Lấy thông tin sinh viên
} else {
    echo "Không tìm thấy sinh viên với Mã sinh viên: $MaSV.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];
    $target_dir = "uploads/";  // Thư mục lưu trữ hình ảnh

    // Kiểm tra nếu thư mục uploads/ không tồn tại, tạo thư mục
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);  // Tạo thư mục nếu chưa có
    }

    $uploadOk = 1;
    $new_image = $student['Hinh'];  // Mặc định là hình ảnh hiện tại

    // Kiểm tra nếu người dùng có chọn hình ảnh mới
    if (!empty($_FILES["Hinh"]["name"])) {
        $hinh = $_FILES['Hinh']['name'];  // Lấy tên tệp hình ảnh
        $target_file = $target_dir . basename($hinh);  // Đường dẫn tệp

        // Thay thế dấu cách trong tên tệp bằng dấu gạch dưới (_)
        $new_file_name = str_replace(" ", "_", $hinh);
        $target_file = $target_dir . $new_file_name;

        // Kiểm tra loại tệp hình ảnh
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Di chuyển hình ảnh vào thư mục uploads
            if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $target_file)) {
                $new_image = $target_file;  // Cập nhật hình ảnh mới
            } else {
                echo "Lỗi khi tải hình ảnh lên.";
                $uploadOk = 0;
            }
        } else {
            echo "Chỉ hỗ trợ các định dạng hình ảnh JPG, JPEG, PNG và GIF.";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 1) {
        // Cập nhật thông tin sinh viên vào cơ sở dữ liệu
        $sql = "UPDATE sinhvien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', Hinh='$new_image', MaNganh='$MaNganh' WHERE MaSV='$MaSV'";

        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật sinh viên thành công!";
        } else {
            echo "Lỗi cập nhật sinh viên: " . $conn->error;
        }
    }
}
?>

<h2>Sửa thông tin sinh viên</h2>

<form action="edit_student.php?id=<?php echo $MaSV; ?>" method="POST" enctype="multipart/form-data">
    <label for="MaSV">Mã sinh viên:</label>
    <input type="text" name="MaSV" id="MaSV" value="<?php echo $student['MaSV']; ?>" readonly><br>

    <label for="HoTen">Họ tên:</label>
    <input type="text" name="HoTen" id="HoTen" value="<?php echo $student['HoTen']; ?>" required><br>

    <label for="GioiTinh">Giới tính:</label>
    <select name="GioiTinh" id="GioiTinh" required>
        <option value="Nam" <?php if ($student['GioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
        <option value="Nữ" <?php if ($student['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
    </select><br>

    <label for="NgaySinh">Ngày sinh:</label>
    <input type="date" name="NgaySinh" id="NgaySinh" value="<?php echo $student['NgaySinh']; ?>" required><br>

    <label for="Hinh">Hình ảnh:</label>
    <input type="file" name="Hinh" id="Hinh"><br>
    <p>Hình ảnh hiện tại: <img src="<?php echo $student['Hinh']; ?>" alt="Hình ảnh sinh viên" width="100"></p>

    <label for="MaNganh">Mã ngành:</label>
    <input type="text" name="MaNganh" id="MaNganh" value="<?php echo $student['MaNganh']; ?>" required><br>

    <input type="submit" value="Cập nhật sinh viên">
</form>

<?php
include('../includes/footer.php');
?>

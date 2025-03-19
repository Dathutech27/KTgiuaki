<?php
include('../includes/header.php');  // Đảm bảo đường dẫn chính xác
include('../includes/connect.php');

// Xử lý thêm sinh viên
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    // Xử lý hình ảnh
    $hinh = $_FILES['Hinh']['name'];  // Lấy tên tệp hình ảnh
    $target_dir = "uploads/";  // Thư mục lưu hình ảnh
    $target_file = $target_dir . basename($hinh);  // Đường dẫn tệp

    // Kiểm tra loại tệp hình ảnh
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        // Di chuyển hình ảnh vào thư mục uploads
        if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $target_file)) {
            // Câu lệnh SQL để thêm sinh viên
            $sql = "INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                    VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$target_file', '$MaNganh')";

            // Kiểm tra nếu truy vấn thành công
            if ($conn->query($sql) === TRUE) {
                echo "Sinh viên đã được thêm thành công!";
            } else {
                // Hiển thị lỗi nếu có
                echo "Lỗi: " . $conn->error;
            }
        } else {
            echo "Lỗi khi tải hình ảnh lên.";
        }
    } else {
        echo "Chỉ hỗ trợ các định dạng hình ảnh JPG, JPEG, PNG và GIF.";
    }
}
?>

<h2>Thêm sinh viên mới</h2>
<form action="add_student.php" method="POST" enctype="multipart/form-data"> <!-- Thêm enctype để xử lý tệp tải lên -->
    <label for="MaSV">Mã sinh viên:</label>
    <input type="text" name="MaSV" id="MaSV" required><br>
    
    <label for="HoTen">Họ tên:</label>
    <input type="text" name="HoTen" id="HoTen" required><br>
    
    <label for="GioiTinh">Giới tính:</label>
    <select name="GioiTinh" id="GioiTinh" required>
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select><br>

    <label for="NgaySinh">Ngày sinh:</label>
    <input type="date" name="NgaySinh" id="NgaySinh" required><br>

    <label for="Hinh">Hình ảnh:</label>
    <input type="file" name="Hinh" id="Hinh" accept="image/*" required><br> <!-- Sử dụng input file cho hình ảnh -->

    <label for="MaNganh">Mã ngành:</label>
    <input type="text" name="MaNganh" id="MaNganh" required><br>

    <input type="submit" value="Thêm sinh viên">
</form>

<?php
include('../includes/footer.php');  // Đảm bảo đường dẫn chính xác
?>

<?php
// Bao gồm tệp kết nối cơ sở dữ liệu
include "../connect.php";

// Kiểm tra xem biểu mẫu đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin người dùng từ biểu mẫu
    $tennguoidung = $_POST["tennguoidung"];
    $email = $_POST["email"];
    $sodienthoai = $_POST["sodienthoai"];
    $diachi = $_POST["diachi"];
    $quyen = $_POST["quyen"];
    $matkhau = $_POST["matkhau"];

    // Băm mật khẩu để tăng cường an ninh
    // $hashedPassword = password_hash($matkhau, PASSWORD_DEFAULT);

    // Truy vấn SQL để chèn thông tin người dùng vào cơ sở dữ liệu
    $sql = "INSERT INTO nguoidung (tennguoidung, email, sodienthoai, diachi, quyen, matkhau) 
            VALUES ('$tennguoidung', '$email', '$sodienthoai', '$diachi', '$quyen', '$matkhau')";

    // Thực hiện truy vấn
    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng về trang nguoidungdathem.php
        header("Location: nguoidungdathem.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
}
?>

<?php
// Bao gồm tệp kết nối cơ sở dữ liệu
include "../connect.php";

// Kiểm tra xem có tham số mã người dùng được truyền từ URL không
if (isset($_GET["ma"])) {
    $ma_nguoidung = $_GET["ma"];

    // Truy vấn SQL để xóa người dùng
    $sql = "DELETE FROM nguoidung WHERE id = $ma_nguoidung";

    // Thực hiện truy vấn
    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng về trang nguoidungdathem.php sau khi xóa thành công
        header("Location: nguoidungdathem.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Mã người dùng không được cung cấp.";
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>

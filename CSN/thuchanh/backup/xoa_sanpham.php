<?php
include "../connect.php";

// Lấy biến từ liên kết
$masanpham = "";
if (isset($_GET["ma"])) {
    $masanpham = $_GET["ma"];
}

// Thực hiện xóa từ bảng hinhanh trước
$sqlHinhAnh = "DELETE FROM hinhanh WHERE sanpham_id='$masanpham'";

if ($conn->query($sqlHinhAnh) === TRUE) {
    // Nếu xóa hình ảnh thành công, tiếp tục xóa từ bảng sanpham
    $sqlSanPham = "DELETE FROM sanpham WHERE id='$masanpham'";

    if ($conn->query($sqlSanPham) === TRUE) {
        header("Location:sanphamdathem.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Error deleting images: " . $conn->error;
}

$conn->close();




?>

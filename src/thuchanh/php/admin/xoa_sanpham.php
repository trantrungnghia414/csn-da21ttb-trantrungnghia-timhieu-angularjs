<?php
include "../connect.php";

// Lấy biến từ liên kết
$masanpham = "";
if (isset($_GET["ma"])) {
    $masanpham = $_GET["ma"];
}

// Thực hiện truy vấn để lấy đường dẫn của hình ảnh để xóa file ảnh từ thư mục
$sqlGetImages = "SELECT link FROM hinhanh WHERE sanpham_id='$masanpham'";
$resultGetImages = $conn->query($sqlGetImages);

if ($resultGetImages->num_rows > 0) {
    while ($row = $resultGetImages->fetch_assoc()) {
        // Xóa file ảnh từ thư mục
        $imagePath = str_replace('http://localhost/csn/thuchanh/static/', 'D:/hoc_ky_1_nam_ba/!_do_an_co_so_nganh/4_de_cuong_chi_tiet_git\csn-da21ttb-trantrungnghia-timhieu-angularjs/CSN/thuchanh/static/', $row['link']);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}

// Tiếp theo, xóa dữ liệu từ bảng hinhanh
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

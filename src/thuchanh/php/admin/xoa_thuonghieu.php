<?php
include "../connect.php";

// Lấy biến từ liên kết
$mathuonghieu = "";
if (isset($_GET["ma"])) {
    $mathuonghieu = $_GET["ma"];
    
    // Truy vấn để lấy thông tin hình ảnh cần xóa
    $sqlSelectImage = "SELECT anhthuonghieu FROM thuonghieu WHERE id='$mathuonghieu'";
    $result = $conn->query($sqlSelectImage);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . $row['anhthuonghieu']; // Đường dẫn đầy đủ tới thư mục hình ảnh

        // Xóa hình ảnh từ thư mục
        if (file_exists($imagePath)) {
            unlink($imagePath);
        } else {
            echo "Không tìm thấy hình ảnh trong thư mục.";
        }
    }

    // 1. Truy vấn để lấy danh sách sản phẩm thuộc về thương hiệu cần xóa
    $sqlSelectProducts = "SELECT id FROM sanpham WHERE thuonghieu_id='$mathuonghieu'";
    $resultProducts = $conn->query($sqlSelectProducts);

    // 2-4. Duyệt qua từng sản phẩm và xóa hình ảnh, thông tin hình ảnh và sản phẩm từ CSDL
    while ($rowProduct = $resultProducts->fetch_assoc()) {
        $productId = $rowProduct["id"];

        // 2. Truy vấn để lấy thông tin hình ảnh cần xóa
        $sqlSelectImage = "SELECT link FROM hinhanh WHERE sanpham_id='$productId'";
        $resultImage = $conn->query($sqlSelectImage);

        while ($rowImage = $resultImage->fetch_assoc()) {
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . $rowImage['link']; // Đường dẫn đầy đủ tới thư mục hình ảnh

            // 3. Xóa hình ảnh từ thư mục
            if (file_exists($imagePath)) {
                unlink($imagePath);
            } else {
                echo "Không tìm thấy hình ảnh trong thư mục.";
            }
        }

        // 4. Xóa thông tin hình ảnh và sản phẩm từ CSDL
        $sqlDeleteImages = "DELETE FROM hinhanh WHERE sanpham_id='$productId'";
        $sqlDeleteProduct = "DELETE FROM sanpham WHERE id='$productId'";

        $conn->query($sqlDeleteImages);
        $conn->query($sqlDeleteProduct);
    }

    // Xóa thông tin thương hiệu từ CSDL
    $sqlDelete = "DELETE FROM thuonghieu WHERE id='$mathuonghieu'";

    if ($conn->query($sqlDelete) === TRUE) {
        header("Location: thuonghieudathem.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>

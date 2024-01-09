<?php
include "../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenSanPham = $_POST["tenSanPham"];
    $gia = $_POST["gia"];
    $moTa = $_POST["moTa"];
    $hangSanXuat = $_POST["hangSanXuat"];
    $thongsokythuat = $_POST["thongSoKyThuat"];
    $thuonghieu_id = $_POST["thuonghieu_id"];

    // Thêm sản phẩm vào bảng sanpham
    $sqlSanPham = "INSERT INTO sanpham (ten, gia, mota, hangsanxuat, thongsokythuat, thuonghieu_id) VALUES ('$tenSanPham', '$gia', '$moTa', '$hangSanXuat', '$thongsokythuat', '$thuonghieu_id')";

    if ($conn->query($sqlSanPham) === TRUE) {
        // Lấy ID của sản phẩm vừa thêm
        $sanpham_id = $conn->insert_id;

        // Kiểm tra và lưu thông tin hình ảnh vào bảng hinhanh
        if (isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['error'] == 0) {
            // $target_dir = "";  // Đường dẫn thư mục lưu trữ ảnh
            $target_dir = "D:/laragon/laragon/www/CSN/thuchanh/static/";
            $target_file = $target_dir . basename($_FILES["hinhAnh"]["name"]);
            $tenhinhanh = $_FILES["hinhAnh"]["name"];
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Kiểm tra kích thước ảnh (giả sử giới hạn là 5MB)
            if ($_FILES["hinhAnh"]["size"] > 5 * 1024 * 1024) {
                echo "File ảnh quá lớn. Vui lòng chọn ảnh nhỏ hơn 5MB.";
                $uploadOk = 0;
            }

            // Kiểm tra định dạng ảnh (chỉ cho phép JPG, JPEG, PNG)
            if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
                echo "Chỉ chấp nhận file ảnh định dạng JPG, JPEG, PNG.";
                $uploadOk = 0;
            }

            // Nếu không có lỗi, tiến hành upload
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["hinhAnh"]["tmp_name"], $target_file)) {
                    // Lưu thông tin hình ảnh vào bảng hinhanh
                    $sqlHinhAnh = "INSERT INTO hinhanh (link, sanpham_id) VALUES ('$target_file', '$sanpham_id')";
                    $sqlHinhAnh = "INSERT INTO hinhanh (link, sanpham_id) VALUES ('http://localhost/csn/thuchanh/static/$tenhinhanh', '$sanpham_id')";
                    echo $sqlHinhAnh; // Thêm dòng này để xem câu lệnh SQL
                    if ($conn->query($sqlHinhAnh) !== TRUE) {
                        echo "Có lỗi khi lưu thông tin hình ảnh vào CSDL.";
                    }
                } else {
                    echo "Có lỗi xảy ra khi tải lên file ảnh.";
                }
            } else {
                echo "File của bạn không được tải lên.";
            }
        }

        header("Location: sanphamdathem.php");
    } else {
        echo "Error: " . $sqlSanPham . "<br>" . $conn->error;
    }
}

$conn->close();
?>
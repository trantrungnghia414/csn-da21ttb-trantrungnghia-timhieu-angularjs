<?php
// Kết nối CSDL
include "../connect.php";

// Lấy giá trị từ form
$tenThuongHieu = $xuatXu = $moTa = $anhThuongHieu = "";
if (isset($_POST["tenThuongHieu"]) && isset($_POST["xuatXu"]) && isset($_POST["moTa"]) && isset($_FILES["anhThuongHieu"])) {
    $tenThuongHieu = $_POST["tenThuongHieu"];
    $xuatXu = $_POST["xuatXu"];
    $moTa = $_POST["moTa"];

    // Xử lý upload ảnh
    // $target_dir = "D:/laragon/laragon/www/CSN/thuchanh/asess/img/";
    $target_dir = "D:/hoc_ky_1_nam_ba/!_do_an_co_so_nganh/4_de_cuong_chi_tiet_git/csn-da21ttb-trantrungnghia-timhieu-angularjs/CSN/thuchanh/asess/img/";
    $target_file = $target_dir . basename($_FILES["anhThuongHieu"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra kích thước ảnh (giả sử giới hạn là 5MB)
    if ($_FILES["anhThuongHieu"]["size"] > 5 * 1024 * 1024) {
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
        if (move_uploaded_file($_FILES["anhThuongHieu"]["tmp_name"], $target_file)) {
            // Lưu thông tin thương hiệu vào CSDL
            $anhThuongHieuPath = "/csn/thuchanh/asess/img/" . basename($_FILES["anhThuongHieu"]["name"]);
            $sql = "INSERT INTO thuonghieu (tenthuonghieu, xuatxu, mota, anhthuonghieu) VALUES ('$tenThuongHieu', '$xuatXu', '$moTa', '$anhThuongHieuPath')";
            if ($conn->query($sql) === TRUE) {
                header("Location: thuonghieudathem.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Có lỗi xảy ra khi tải lên file ảnh.";
        }
    } else {
        echo "File của bạn không được tải lên.";
    }
}

// Đóng kết nối
$conn->close();
?>

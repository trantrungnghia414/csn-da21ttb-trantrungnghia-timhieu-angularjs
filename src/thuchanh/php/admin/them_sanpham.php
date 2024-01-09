<?php
// Kết nối CSDL
include "../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tenSanPham = $_POST["tenSanPham"];
    $gia = $_POST["gia"];
    $moTa = $_POST["moTa"];
    $hangSanXuat = $_POST["hangSanXuat"];
    $thuonghieu_id = $_POST["thuonghieu_id"];
    $thongSoKyThuat = $_POST["thongSoKyThuat"];

    // Thêm sản phẩm vào bảng sanpham
    $sql_sanpham = "INSERT INTO sanpham (ten, gia, mota, hangsanxuat, thuonghieu_id, thongsokythuat) VALUES ('$tenSanPham', '$gia', '$moTa', '$hangSanXuat', '$thuonghieu_id', '$thongSoKyThuat')";
    if ($conn->query($sql_sanpham) === TRUE) {
        $sanpham_id = $conn->insert_id; // Lấy ID của sản phẩm vừa được thêm

        // Xử lý hình ảnh
        $link_anh = "";
        if (isset($_FILES["hinhAnh"])){
            $target_dir = "D:/hoc_ky_1_nam_ba/!_do_an_co_so_nganh/4_de_cuong_chi_tiet_git\csn-da21ttb-trantrungnghia-timhieu-angularjs/CSN/thuchanh/static/";
            $target_file = $target_dir . basename($_FILES["hinhAnh"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        }
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
                // Lưu thông tin thương hiệu vào CSDL
                $anh_Path = "http://localhost/csn/thuchanh/static/" . basename($_FILES["hinhAnh"]["name"]);
                $sql = "INSERT INTO hinhanh (link, sanpham_id) VALUES ('$anh_Path', '$sanpham_id')";
                if ($conn->query($sql) === TRUE) {
                    header("Location: sanphamdathem.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Có lỗi xảy ra khi tải lên file ảnh.";
            }
        } else {
            echo "File của bạn không được tải lên.";
        }
    } else {
        echo "Lỗi: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>

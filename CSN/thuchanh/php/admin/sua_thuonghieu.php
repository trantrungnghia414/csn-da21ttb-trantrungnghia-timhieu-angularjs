<?php
include "../connect.php";

$ma = $_GET["ma"];

$sql = "SELECT * FROM thuonghieu WHERE id ='$ma'";
$result = $conn->query($sql);
$ma_val = $ten_val = $xx_val = $mota_val = $anhthuonghieu_val = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ma_val = $row["id"];
        $ten_val = $row["tenthuonghieu"];
        $xx_val = $row["xuatxu"];
        $mota_val = $row["mota"];
        $anhthuonghieu_val = $row["anhthuonghieu"];
    }
}

    // Truy vấn để lấy thông tin hình ảnh cần xóa
    // $sqlSelectImage = "SELECT anhthuonghieu FROM thuonghieu WHERE id='$ma'";
    // $result = $conn->query($sqlSelectImage);

    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $imagePath = $_SERVER['DOCUMENT_ROOT'] . $row['anhthuonghieu']; // Đường dẫn đầy đủ tới thư mục hình ảnh

    //     // Xóa hình ảnh từ thư mục
    //     if (file_exists($imagePath)) {
    //         unlink($imagePath);
    //     } else {
    //         echo "Không tìm thấy hình ảnh trong thư mục.";
    //     }
    // }


if (isset($_POST["sbCapNhat"])) {
    // Lấy biến từ form
    $ten = $xx = $ma = $mota = $anhthuonghieu = "";
    if (isset($_POST["ten"]) && isset($_POST["xuatxu"])) {
        $ten = $_POST["ten"];
        $xx = $_POST["xuatxu"];
        $ma = $_POST["id"];
        $mota = $_POST["mota"];

        // Xử lý upload ảnh
        $target_dir = "D:/hoc_ky_1_nam_ba/!_do_an_co_so_nganh/4_de_cuong_chi_tiet_git/csn-da21ttb-trantrungnghia-timhieu-angularjs/CSN/thuchanh/asess/img/";
        $uploadOk = 1;

        // Kiểm tra xem người dùng đã chọn file mới hay chưa
        if (!empty($_FILES["anhthuonghieu"]["name"])) {

            $sqlSelectImage = "SELECT anhthuonghieu FROM thuonghieu WHERE id='$ma'";
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

            $target_file = $target_dir . basename($_FILES["anhthuonghieu"]["name"]);

            // Kiểm tra kích thước ảnh (giả sử giới hạn là 5MB)
            if ($_FILES["anhthuonghieu"]["size"] > 5 * 1024 * 1024) {
                echo "File ảnh quá lớn. Vui lòng chọn ảnh nhỏ hơn 5MB.";
                $uploadOk = 0;
            }

            // Kiểm tra định dạng ảnh (chỉ cho phép JPG, JPEG, PNG)
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
                echo "Chỉ chấp nhận file ảnh định dạng JPG, JPEG, PNG.";
                $uploadOk = 0;
            }

            // Nếu không có lỗi, tiến hành upload
            if ($uploadOk == 1) {
                // Kiểm tra xem ảnh mới có giống ảnh ban đầu không
                if (basename($anhthuonghieu_val) != basename($_FILES["anhthuonghieu"]["name"])) {
                    // Xóa ảnh cũ trước khi upload ảnh mới
                    if (!empty($anhthuonghieu_val)) {
                        $old_image_path = "D:/hoc_ky_1_nam_ba/!_do_an_co_so_nganh/4_de_cuong_chi_tiet_git/csn-da21ttb-trantrungnghia-timhieu-angularjs/CSN/thuchanh/asess/img/" . basename($anhthuonghieu_val);
                        if (file_exists($old_image_path)) {
                            unlink($old_image_path);
                        }
                    }

                    if (move_uploaded_file($_FILES["anhthuonghieu"]["tmp_name"], $target_file)) {
                        // Lưu thông tin thương hiệu vào CSDL
                        $anhthuonghieu = "/csn/thuchanh/asess/img/" . basename($_FILES["anhthuonghieu"]["name"]);
                        $sql = "UPDATE thuonghieu SET tenthuonghieu='$ten', xuatxu='$xx', mota='$mota', anhthuonghieu='$anhthuonghieu' WHERE id='$ma'";

                        if ($conn->query($sql) === TRUE) {
                            header("Location:thuonghieudathem.php");
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                    } else {
                        echo "Có lỗi xảy ra khi tải lên file ảnh.";
                    }
                } else {
                    // Ảnh mới giống ảnh cũ, chỉ cập nhật thông tin khác
                    $sql = "UPDATE thuonghieu SET tenthuonghieu='$ten', xuatxu='$xx', mota='$mota' WHERE id='$ma'";

                    if ($conn->query($sql) === TRUE) {
                        header("Location:thuonghieudathem.php");
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            } else {
                echo "File của bạn không được tải lên.";
            }
        } else {
            // Nếu không có file mới, chỉ cập nhật thông tin khác
            $sql = "UPDATE thuonghieu SET tenthuonghieu='$ten', xuatxu='$xx', mota='$mota' WHERE id='$ma'";

            if ($conn->query($sql) === TRUE) {
                header("Location:thuonghieudathem.php");
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
    // Đóng kết nối
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../../asess/img/favicon.ico" type="image/x-icon">
    <title>Quản lý thương hiệu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="row">
    <div class="col-2 boder">
        <?php
        include "./header.php";
        ?>
    </div>

    <div class="col-10">
        <div class="container mt-3">
            <h2>Quản lý thương hiệu</h2>
            <form action="sua_thuonghieu.php" method="post" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label for="id">Mã thương hiệu:</label>
                    <input value="<?php echo $ma_val; ?>" readonly type="text" class="form-control" id="id" placeholder="" name="id">
                </div>
                <div class="mb-3 mt-3">
                    <label for="ten">Tên thương hiệu:</label>
                    <input value="<?php echo $ten_val; ?>" type="text" class="form-control" id="ten" placeholder="Nhập tên thương hiệu" name="ten">
                </div>
                <div class="mb-3 mt-3">
                    <label for="xuatxu">Xuất xứ thương hiệu:</label>
                    <input value="<?php echo $xx_val; ?>" type="text" class="form-control" id="xuatxu" placeholder="Nhập xuất xứ thương hiệu" name="xuatxu">
                </div>
                <div class="mb-3 mt-3">
                    <label for="mota">Mô tả:</label>
                    <textarea class="form-control" id="mota" name="mota" placeholder="Nhập mô tả thương hiệu"><?php echo $mota_val; ?></textarea>
                </div>
                <div class="mb-3 mt-3">
                    <label for="anhthuonghieu">Ảnh thương hiệu:</label>
                    <input type="file" class="form-control" id="anhthuonghieu" name="anhthuonghieu">
                </div>

                <button name="sbCapNhat" type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

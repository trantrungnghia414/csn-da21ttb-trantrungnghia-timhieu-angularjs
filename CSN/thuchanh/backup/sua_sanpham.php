<?php
include "../connect.php";

$ma = isset($_GET["ma"]) ? $_GET["ma"] : "";


$sql = "SELECT * FROM sanpham WHERE id ='$ma'";
$result = $conn->query($sql);
$ma_val = $ten_val = $gia_val = $mota_val = $hangsanxuat_val = $thongsokythuat_val = $thuonghieu_id_val = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ma_val = $row["id"];
        $ten_val = $row["ten"];
        $gia_val = $row["gia"];
        $mota_val = $row["mota"];
        $hangsanxuat_val = $row["hangsanxuat"];
        $thongsokythuat_val = $row["thongsokythuat"];
        $thuonghieu_id_val = $row["thuonghieu_id"];
    }
    // Lấy đường dẫn ảnh hiện tại của sản phẩm
    $sqlHinhAnh = "SELECT link FROM hinhanh WHERE sanpham_id = '$ma'";
    $resultHinhAnh = $conn->query($sqlHinhAnh);
    
    if ($resultHinhAnh->num_rows > 0) {
        $rowHinhAnh = $resultHinhAnh->fetch_assoc();
        $hinhanh_val = $rowHinhAnh["link"];
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quản lý sản phẩm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
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
    <h2>Quản lý sản phẩm</h2>
    <form action="sua_sanpham.php" method="post" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label for="id">Mã sản phẩm:</label>
            <input value="<?php echo $ma_val; ?>" readonly type="text" class="form-control" id="id" placeholder=""
                   name="id">
        </div>
        <div class="mb-3 mt-3">
            <label for="ten">Tên sản phẩm:</label>
            <input value="<?php echo $ten_val; ?>" type="text" class="form-control" id="ten"
                   placeholder="Nhập tên sản phẩm" name="ten">
        </div>
        <div class="mb-3 mt-3">
            <label for="gia">Giá:</label>
            <input value="<?php echo $gia_val; ?>" type="text" class="form-control" id="gia"
                   placeholder="Nhập giá sản phẩm" name="gia">
        </div>
        <div class="mb-3 mt-3">
            <label for="mota">Mô tả:</label>
            <textarea class="form-control" id="mota" name="mota"
                      placeholder="Nhập mô tả sản phẩm"><?php echo $mota_val; ?></textarea>
        </div>
        <div class="mb-3 mt-3">
            <label for="hangsanxuat">Hãng sản xuất:</label>
            <input value="<?php echo $hangsanxuat_val; ?>" type="text" class="form-control" id="hangsanxuat"
                   placeholder="Nhập hãng sản xuất" name="hangsanxuat">
        </div>


    <!-- Thêm input để chọn file hình ảnh -->
    <div class="mb-3 mt-3">
                    <label for="hinhAnh">Hình ảnh:</label>
                    <input type="file" class="form-control" id="hinhAnh" name="hinhAnh">
                </div>

        
        <!-- Chọn thương hiệu từ CSDL -->
        <div class="mb-3 mt-3">
            <label for="thuonghieu_id">Chọn Thương Hiệu</label>
            <select class="form-select" id="thuonghieu_id" name="thuonghieu_id">
                <?php
                $sql_thuonghieu = "SELECT * FROM thuonghieu";
                $result_thuonghieu = $conn->query($sql_thuonghieu);

                while ($row_thuonghieu = $result_thuonghieu->fetch_assoc()) {
                    $selected = ($row_thuonghieu['id'] == $thuonghieu_id_val) ? "selected" : "";
                    echo "<option value='" . $row_thuonghieu['id'] . "' $selected>" . $row_thuonghieu['tenthuonghieu'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="thongsokythuat">Thông số kỹ thuật:</label>
            <textarea class="form-control" id="thongsokythuat" name="thongsokythuat"
                      placeholder="Nhập thông số kỹ thuật"><?php echo $thongsokythuat_val; ?></textarea>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    ClassicEditor
                        .create(document.querySelector('#thongsokythuat'))
                        .catch(error => {
                            console.error(error);
                        });
                });
            </script>
        </div>

        <button name="sbCapNhat" type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
  </div>

</div>



</body>
</html>


<?php
if (isset($_POST["sbCapNhat"])) {
    // Lấy biến từ form
    $ten = $gia = $ma = $mota = $hangsanxuat = $thongsokythuat = $thuonghieu_id = "";
    if (isset($_POST["ten"]) && isset($_POST["gia"])) {
        $ten = $_POST["ten"];
        $gia = $_POST["gia"];
        $ma = $_POST["id"];
        $mota = $_POST["mota"];
        $hangsanxuat = $_POST["hangsanxuat"];
        $thongsokythuat = $_POST["thongsokythuat"];
        $thuonghieu_id = $_POST["thuonghieu_id"];

        //SUA ANH SAN PHAM
        // Kiểm tra và lưu thông tin hình ảnh vào bảng hinhanh
        if (isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['error'] == 0) {
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
                    // Lấy ID của sản phẩm vừa cập nhật
                    $sanpham_id = $ma;

                    // Lưu thông tin hình ảnh vào bảng hinhanh
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
//SUA ANH SAN PHAM
    }

    // Viết câu truy vấn cập nhật
    $sql = "UPDATE sanpham SET ten='$ten', gia='$gia', mota='$mota', hangsanxuat='$hangsanxuat', thongsokythuat='$thongsokythuat', thuonghieu_id='$thuonghieu_id' WHERE id='$ma'";

    if ($conn->query($sql) === TRUE) {
        header("Location:sanphamdathem.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
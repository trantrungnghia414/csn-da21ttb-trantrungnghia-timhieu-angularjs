<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <style>
        .image-preview {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .image-preview img {
            max-width: 100px;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .remove-image {
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 3px;
            border-radius: 50%;
        }
    </style>
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
                <h2>Quản Lý Sản Phẩm</h2>
                <form action="./them_sanpham.php" method="post" enctype="multipart/form-data">

                    <div class="mb-3 mt-3">
                        <label for="ten">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="tensanpham" name="tenSanPham" placeholder="Nhập tên sản phẩm">
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="gia">Giá bán</label>
                        <input type="number" class="form-control" id="gia" name="gia" placeholder="Nhập giá">
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="mota">Mô tả</label>
                        <input type="text" class="form-control" id="mota" name="moTa" placeholder="Nhập mô tả">
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="hangsanxuat">Xuất xứ</label>
                        <input type="text" class="form-control" id="hangsanxuat" name="hangSanXuat" placeholder="Nhập hãng sản xuất">
                    </div>

                    <!-- Thêm phần chọn file ảnh -->
                    <div class="mb-3 mt-3">
                        <label for="hinhanh">Chọn ảnh</label>
                        <!-- <input type="file" class="form-control" id="hinhanh" name="hinhAnh" accept="image/*" multiple> -->
                        <input type="file" class="form-control" id="hinhanh" name="hinhAnh">
                    </div>
                    <!-- Thêm phần chọn file ảnh -->

                    <!-- Chọn thương hiệu từ CSDL -->
                    <div class="mb-3 mt-3">
                        <label for="thuonghieu_id">Chọn Thương Hiệu</label>
                        <select class="form-select" id="thuonghieu_id" name="thuonghieu_id">
                        <!-- Lấy dữ liệu từ CSDL thuonghieu và hiển thị tại đây -->
                        <?php
                        // Kết nối CSDL thuonghieu
                            include "../connect.php";

                            $sql_thuonghieu = "SELECT * FROM thuonghieu";
                            $result_thuonghieu = $conn->query($sql_thuonghieu);

                            if ($result_thuonghieu->num_rows > 0) {
                            while ($row_thuonghieu = $result_thuonghieu->fetch_assoc()) {
                                echo "<option value='" . $row_thuonghieu['id'] . "'>" . $row_thuonghieu['tenthuonghieu'] . "</option>";
                            }
                            }
                        ?>
                        </select>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="thongsokythuat">Thông số kỹ thuật</label>
                        <textarea class="form-control" id="thongsokythuat" name="thongSoKyThuat" placeholder="Nhập thông số kỹ thuật"></textarea>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                        ClassicEditor 
                            .create(document.querySelector('#thongsokythuat'))
                            .catch(error => {
                            console.error(error);
                            });
                        });
                    </script>

                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

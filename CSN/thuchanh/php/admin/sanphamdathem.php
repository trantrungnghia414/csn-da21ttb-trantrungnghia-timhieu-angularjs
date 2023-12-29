<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
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
                <h2>Quản Lý Sản Phẩm</h2>
                <a href="./form_sanpham.php" class="btn btn-primary">Thêm mới</a>

                <?php
                include "../connect.php";

                // $sql = "SELECT * FROM sanpham";
                $sql = "SELECT sanpham.*, hinhanh.link as link FROM sanpham LEFT JOIN hinhanh ON sanpham.id = hinhanh.sanpham_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    echo "<table class='table table-hover'>";
                    echo "<tr><th>STT</th><th>Tên sản phẩm</th><th>Giá bán</th><th>Mô tả</th><th>Hãng sản xuất</th><th>Ảnh sản phẩm</th><th>Sủa</th><th>Xóa</th></tr>";
                    $stt = 1;
                    while ($row = $result->fetch_assoc()) {
                        // echo "<tr><td>" . $stt . "</td><td>" . $row["ten"] . "</td><td>" . $row["gia"] . "</td><td>" . $row["mota"] . "</td><td>" . $row["hangsanxuat"] . "</td><td><img src='" . $row["link"] . "' alt='Ảnh sản phẩm' style='max-width: 100px; max-height: 100px;'></td>";
                        echo "<tr><td>" . $stt . "</td><td>" . $row["ten"] . "</td><td>" . number_format($row['gia'], 0, ',', '.') . " VNĐ</td><td>" . $row["mota"] . "</td><td>" . $row["hangsanxuat"] . "</td><td><img src='" . $row["link"] . "' alt='Ảnh sản phẩm' style='max-width: 100px; max-height: 100px;'></td>";
                         

                        echo "<td>";
                        ?>
                        <a class="btn btn-primary" href="./sua_sanpham.php?ma=<?php echo $row["id"]; ?>">Sửa</a>
                        <!-- <a class="btn btn-danger" href="./xoa_sanpham.php?ma=<?php echo $row["id"]; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a> -->
                        <?php
                        echo "</td>";
                        echo "<td>";
                        ?>
                        <!-- <a class="btn btn-primary" href="./sua_sanpham.php?ma=<?php echo $row["id"]; ?>">Sửa</a> -->
                        <a class="btn btn-danger" href="./xoa_sanpham.php?ma=<?php echo $row["id"]; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                        <?php
                        echo "</td>";
                        echo "</tr>";
                        $stt++;
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>

            </div>

        </div>

    </div>
</body>

</html>

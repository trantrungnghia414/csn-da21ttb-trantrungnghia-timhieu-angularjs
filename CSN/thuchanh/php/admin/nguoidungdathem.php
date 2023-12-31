<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../asess/img/favicon.ico" type="image/x-icon">
    <title>Quản Lý Người Dùng</title>
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
            <h2>Quản Lý Người Dùng</h2>
            <a href="./form_nguoidung.php" class="btn btn-primary">Thêm mới</a>
            <?php
            include "../connect.php";

            $sql = "SELECT * FROM nguoidung";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='table table-hover'>";
                echo "<tr><th>STT</th><th>Tên người dùng</th><th>Email</th><th>Số điện thoại</th><th>Địa chỉ</th><th>Quyền</th><th>Mật khẩu</th><th>Sửa</th><th>Xóa</th></tr>";
                $stt = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $stt . "</td><td>" . $row["tennguoidung"] . "</td><td>" . $row["email"] . "</td><td>" . $row["sodienthoai"] . "</td><td>" . $row["diachi"] . "</td><td>" . $row["quyen"] . "</td><td>" . $row["matkhau"] . "</td>";

                    echo "<td>";
                    ?>
                    <a class="btn btn-primary" href="./sua_nguoidung.php?&ma=<?php echo $row["id"]; ?>">Sửa</a>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger"
                       href="./xoa_nguoidung.php?&ma=<?php echo $row["id"]; ?>">Xóa</a>
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

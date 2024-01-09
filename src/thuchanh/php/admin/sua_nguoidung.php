<?php
// Bao gồm tệp kết nối cơ sở dữ liệu
include "../connect.php";

// Kiểm tra xem có tham số mã người dùng được truyền từ URL không
if (isset($_GET["ma"])) {
    $ma_nguoidung = $_GET["ma"];

    // Truy vấn SQL để lấy thông tin người dùng cần sửa
    $sql = "SELECT * FROM nguoidung WHERE id = $ma_nguoidung";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Lấy dữ liệu người dùng từ kết quả truy vấn
        $row = $result->fetch_assoc();
        $tennguoidung = $row["tennguoidung"];
        $email = $row["email"];
        $sodienthoai = $row["sodienthoai"];
        $diachi = $row["diachi"];
        $quyen = $row["quyen"];
        $matkhau = $row["matkhau"];
    } else {
        echo "Không tìm thấy người dùng.";
        exit();
    }
} else {
    echo "Mã người dùng không được cung cấp.";
    exit();
}

// Kiểm tra xem biểu mẫu đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin người dùng từ biểu mẫu
    $tennguoidung = $_POST["tennguoidung"];
    $email = $_POST["email"];
    $sodienthoai = $_POST["sodienthoai"];
    $diachi = $_POST["diachi"];
    $quyen = $_POST["quyen"];
    $matkhau = $_POST["matkhau"];

    // Băm mật khẩu để tăng cường an ninh
    // $hashedPassword = password_hash($matkhau, PASSWORD_DEFAULT);

    // Truy vấn SQL để cập nhật thông tin người dùng
    $sql = "UPDATE nguoidung SET tennguoidung='$tennguoidung', email='$email', sodienthoai='$sodienthoai', diachi='$diachi', quyen='$quyen', matkhau='$matkhau' WHERE id=$ma_nguoidung";

    // Thực hiện truy vấn
    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng về trang nguoidungdathem.php sau khi sửa thành công
        header("Location: nguoidungdathem.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../asess/img/favicon.ico" type="image/x-icon">
    <title>Sửa Người Dùng</title>
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
                <h2>Sửa Người Dùng</h2>
                <form action="./sua_nguoidung.php?&ma=<?php echo $ma_nguoidung; ?>" method="post">
                    <div class="mb-3 mt-3">
                        <label for="tennguoidung">Tên người dùng</label>
                        <input type="text" class="form-control" id="tennguoidung" name="tennguoidung" value="<?php echo $tennguoidung; ?>" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="sodienthoai">Số điện thoại</label>
                        <input type="tel" class="form-control" id="sodienthoai" name="sodienthoai" value="<?php echo $sodienthoai; ?>" pattern="[0-9]+" title="Vui lòng chỉ nhập số" maxlength="10" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="diachi">Địa chỉ</label>
                        <input type="text" class="form-control" id="diachi" name="diachi" value="<?php echo $diachi; ?>" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="quyen">Quyền</label>
                        <select class="form-select" id="quyen" name="quyen">
                            <option value="user" <?php echo ($quyen == 'user') ? 'selected' : ''; ?>>Người dùng</option>
                            <option value="admin" <?php echo ($quyen == 'admin') ? 'selected' : ''; ?>>Quản trị viên</option>
                        </select>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="matkhau">Mật khẩu</label>
                        <input type="password" class="form-control" id="matkhau" name="matkhau" value="<?php echo $matkhau; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// Kết nối đến cơ sở dữ liệu
include "../connect.php";

// Lấy dữ liệu từ form đăng nhập
if(isset($_POST['uname']) && isset($_POST['pswd'])) {
    $username = $_POST['uname'];
    $password = $_POST['pswd'];

    // Kiểm tra đăng nhập
    $query = "SELECT * FROM nguoidung WHERE tennguoidung='$username' AND matkhau='$password' AND quyen='admin'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Đăng nhập thành công, chuyển hướng đến trang admin.php
        // header("Location: admin.php");
        echo '<script>alert("Đăng nhập thành công!"); window.location.href = "admin.php";</script>';
    } else {
        // Kiểm tra đăng nhập
        $query = "SELECT * FROM nguoidung WHERE tennguoidung='$username' AND matkhau='$password' AND quyen='user'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Đăng nhập thành công, cập nhật session và chuyển hướng đến trang chính
            echo '<script>alert("Đăng nhập thành công!"); window.location.href = "../../index.html";</script>';
            exit();
        } else {
            // Đăng nhập không thành công, cập nhật biến kiểm tra đăng nhập và hiển thị thông báo lỗi
            $loginError = "Tên người dùng hoặc mật khẩu không đúng. Vui lòng thử lại.";
        }
    }
}

// Đóng kết nối
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../asess/css/index.css">
    <title>Form login Admin</title>
    <style>
        a.redo {
            padding: 6px 22px;
            margin-left: 143px;
        }
    </style>
</head>
<body>

    <form action="./index.php" method="post" class="was-validated">
        <h3 class="text-center">Đăng Nhập</h3>
        <!-- Thông báo lỗi -->
        <?php if (!empty($loginError)): ?>
            <div class="alert alert-danger">
                <?php echo $loginError; ?>
            </div>
        <?php endif; ?>
        <div class="mb-3 mt-3">
            <label for="uname" class="form-label">Username:</label>
            <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <button type="submit" class="btn btn-primary">Đăng nhập</button>
        <a href="../../index.html" class="btn btn-primary redo">Quay về</a>
    </form>
     
</body>
</html>

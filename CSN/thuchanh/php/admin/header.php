<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Admin Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../asess/css/header.css">
</head>
<body>
    <div class = "header">
        <h3 class="header-icon">
            <a href="./admin.php"><i class='bx bxs-home'></i></a>
        </h3>
        <ul class="header-menu">
            <li>
                <a href="./thuonghieudathem.php" class="header-item">Thương hiệu</a>
            </li>
            <li>
                <a href="./sanphamdathem.php" class="header-item">Sản phẩm</a>
            </li>
            <li>
                <a href="./nguoidungdathem.php" class="header-item">Người dùng</a>
            </li>
            <li>
                <a href="./thongkesanpham.php" class="header-item">Thông kê sản phẩm</a>
            </li>
            <li>
                <a href="#" class="header-item" onclick="confirmLogout()">Đăng xuất</a>
            </li>
            <!-- JavaScript để hiển thị xác nhận -->
            <script>
            function confirmLogout() {
                var confirmation = confirm("Bạn có chắc chắn muốn đăng xuất?");
                if (confirmation) {
                    // Nếu người dùng chấp nhận, chuyển hướng đến trang đăng xuất
                    window.location.href = "./logout.php";
                } else {
                    // Người dùng đã hủy đăng xuất, không thực hiện hành động gì
                }
            }
            </script>
        </ul>
    </div>
</body>
</html>

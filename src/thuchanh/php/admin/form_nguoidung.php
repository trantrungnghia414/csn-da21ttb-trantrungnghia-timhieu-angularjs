<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../asess/img/favicon.ico" type="image/x-icon">
    <title>Quản lý Người Dùng</title>
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
                <h2>Quản lý Người Dùng</h2>
                <form action="./them_nguoidung.php" method="post">
                    <div class="mb-3 mt-3">
                        <label for="tennguoidung">Tên người dùng</label>
                        <input type="text" class="form-control" id="tennguoidung" name="tennguoidung" placeholder="Nhập tên người dùng" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="sodienthoai">Số điện thoại</label>
                        <input type="tel" class="form-control" id="sodienthoai" name="sodienthoai" placeholder="Nhập số điện thoại" oninput="validatePhoneNumber(this)" required>
                    </div>

                    <script>
                    function validatePhoneNumber(input) {
                        // Loại bỏ các ký tự không phải số
                        input.value = input.value.replace(/[^0-9]/g, '');

                        // Giữ cho độ dài của chuỗi là tối đa 10 ký tự
                        if (input.value.length > 10) {
                            input.value = input.value.slice(0, 10);
                        }
                    }
                    </script>

                    <div class="mb-3 mt-3">
                        <label for="diachi">Địa chỉ</label>
                        <input type="text" class="form-control" id="diachi" name="diachi" placeholder="Nhập địa chỉ" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="quyen">Quyền</label>
                        <select class="form-select" id="quyen" name="quyen">
                            <option value="user">Người dùng</option>
                            <option value="admin">Quản trị viên</option>
                        </select>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="matkhau">Mật khẩu</label>
                        <input type="password" class="form-control" id="matkhau" name="matkhau" placeholder="Nhập mật khẩu" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

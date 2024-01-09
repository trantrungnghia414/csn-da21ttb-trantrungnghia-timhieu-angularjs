<?php
// Trang logout.php
session_start();
session_destroy(); // Xóa tất cả dữ liệu session

// Chuyển hướng đến trang đăng nhập
header("Location: ../../index.html");
exit();
?>

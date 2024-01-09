<?php
// Kết nối CSDL
include "../connect.php";

// Lấy giá trị từ form
$tenThuongHieu = $xuatXu = $moTa = $anhThuongHieu = "";
if(isset($_POST["tenThuongHieu"]) && isset($_POST["xuatXu"]) && isset($_POST["moTa"]) && isset($_POST["anhThuongHieu"])) {
  $tenThuongHieu = $_POST["tenThuongHieu"];
  $xuatXu = $_POST["xuatXu"];
  $moTa = $_POST["moTa"];
  $anhThuongHieu = $_POST["anhThuongHieu"];
}

// Viết câu truy vấn
$sql = "INSERT INTO thuonghieu (tenthuonghieu, xuatxu, mota, anhthuonghieu)
VALUES ('$tenThuongHieu', '$xuatXu', '$moTa', '$anhThuongHieu')";

// Thực thi câu truy vấn - Kiểm tra và hiển thị kết quả
if ($conn->query($sql) === TRUE) {
  header("Location: thuonghieudathem.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
?>

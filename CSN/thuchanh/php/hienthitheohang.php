<?php
include "./connect.php";

$productId = isset($_GET['id']) ? $_GET['id'] : 1;

$sql = "SELECT * FROM sanpham Where thuonghieu_id=" . $productId;

$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    
    $sql = "SELECT * FROM hinhanh Where sanpham_id=" . $row['id'];
    $hinhanh = $conn->query($sql);
    $hinhanhList = [];
    
    while($hinh = $hinhanh->fetch_assoc()) array_push($hinhanhList, $hinh);

    $row['hinhanh'] = $hinhanhList;

    // Chuyển đổi giá tiền sang dạng dễ nhìn
    $formattedGia = number_format($row['gia'], 0, ',', '.');
    $row['gia'] = $formattedGia;

    array_push($data, $row);
  }
} else {
  echo "0 results";
}
$conn->close();
echo json_encode($data);

?>
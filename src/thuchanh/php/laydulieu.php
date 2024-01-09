<?php
include "./connect.php";

$sql = "SELECT * FROM sanpham";

$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
  // dữ liệu đầu ra của mỗi hàng
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

echo json_encode($data);
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản Lý Sản Phẩm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .table td:nth-child(4) {
      max-width: 350px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
  </style>
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

    $sql = "SELECT * FROM sanpham";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      echo "<table class='table table-hover'>";
      echo "<tr><th>STT</th><th>Tên sản phẩm</th><th>Giá</th><th>Mô tả</th><th>Hãng sản xuất</th><th>Thông số kỹ thuật</th><th>Sửa</th><th>Xóa</th></tr>";
      $stt = 1;
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $stt . "</td><td>" . $row["ten"] . "</td><td>" . $row["gia"] . "</td><td>" . $row["mota"] . "</td><td>" . $row["hangsanxuat"] . "</td><td>" . $row["thongsokythuat"] . "</td>";
        
        echo"<td>";
        ?>
          <a class="btn btn-primary" href="./sua_sanpham.php?&ma=<?php echo $row["id"]; ?>">Sửa</a>
        <?php
        echo "</td>";
        echo "<td>";
        ?>
          <a onclick="return confirm('Bạn có thật sự muốn xóa không?')" class="btn btn-danger" href="./xoa_sanpham.php?&ma=<?php echo $row["id"];?>">Xóa</a>
        <?php
        echo"</td>";
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
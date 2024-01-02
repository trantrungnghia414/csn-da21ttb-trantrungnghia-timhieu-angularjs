<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../asess/img/favicon.ico" type="image/x-icon">
    <title>Thống kê Sản Phẩm Theo Thương Hiệu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
   
<div class="container mt-3">
        <h2>Thống kê Sản Phẩm Theo Xuất Xứ</h2>

        <?php
        include "../connect.php";

        // Query to get product statistics by origin
        $sql = "SELECT xx.id AS xuatxu_id, xx.tenxuatxu, th.id AS thuonghieu_id, th.tenthuonghieu, COUNT(sp.id) AS soluong
                FROM xuatxu xx
                LEFT JOIN thuonghieu th ON xx.id = th.xuatxu_id
                LEFT JOIN sanpham sp ON th.id = sp.thuonghieu_id
                GROUP BY xx.id, th.id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-hover'>";
            echo "<tr><th>STT</th><th>Xuất Xứ</th><th>Thương Hiệu</th><th>Số Lượng Sản Phẩm</th><th>Chi tiết</th></tr>";
            $Stt = 1;
            $TongSL = 0;
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>". $Stt ."</td><td>" . $row["tenxuatxu"] . "</td><td>" . $row["tenthuonghieu"] . "</td><td>" . $row["soluong"] . "</td>";
                echo "<td>";
                
                if (isset($row["thuonghieu_id"])) {
                    echo "<a class='btn btn-primary' href='./quanlysanpham.php?brand_id=" . $row["thuonghieu_id"] . "'>Chi tiết</a>";
                } else {
                    echo "ID không tồn tại";
                }
                
                echo "</td>";
                $TongSL += $row["soluong"];
                $Stt++;
                echo "</tr>";
            }
            echo "<tr><td></td><td></td><td><b>Tổng số lượng</b></td><td><b>$TongSL</b></td><td></td></tr>";
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
        
</body>

</html>

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
    <div class="row">
        <div class="col-2 boder">
            <?php
            include "./header.php";
            ?>
        </div>

        <div class="col-10">
            <div class="container mt-3">
                <h2>Thống kê Sản Phẩm Theo Thương Hiệu</h2>

                <?php
                include "../connect.php";

                // Query to get product statistics by brand
                $sql = "SELECT th.id, th.tenthuonghieu, COUNT(sp.id) AS soluong
                        FROM thuonghieu th
                        LEFT JOIN sanpham sp ON th.id = sp.thuonghieu_id
                        GROUP BY th.id";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-hover'>";
                    echo "<tr><th>STT</th><th>Thương Hiệu</th><th>Số Lượng Sản Phẩm</th><th>Chi tiết</th></tr>";
                    $Stt = 1;
                    $TongSL = 0;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>". $Stt ."</td><td>" . $row["tenthuonghieu"] . "</td><td>" . $row["soluong"] . "</td>";
                        echo"<td>";
                        
                        // <a class="btn btn-primary" href="./sanphamdathem.php">Chi tiết</a>
                        if (isset($row["id"])) {
                            echo "<a class='btn btn-primary' href='./quanlysanpham.php?brand_id=" . $row["id"] . "'>Chi tiết</a>";
                        } else {
                            echo "ID không tồn tại";
                        }
                        
                        echo "</td>";
                        $TongSL += $row["soluong"];
                        $Stt++;
                        echo "</tr>";
                    }
                    echo "<tr><td></td><td><b>Tổng số lượng</b></td><td><b>$TongSL</b></td><td></td></tr>";
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

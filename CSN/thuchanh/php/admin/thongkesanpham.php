<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                $sql = "SELECT th.tenthuonghieu, COUNT(sp.id) AS soluong
                        FROM thuonghieu th
                        LEFT JOIN sanpham sp ON th.id = sp.thuonghieu_id
                        GROUP BY th.id";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-hover'>";
                    echo "<tr><th>Thương Hiệu</th><th>Số Lượng Sản Phẩm</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["tenthuonghieu"] . "</td><td>" . $row["soluong"] . "</td></tr>";
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

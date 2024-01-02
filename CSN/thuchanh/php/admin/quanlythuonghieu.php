<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../asess/img/favicon.ico" type="image/x-icon">
    <title>Thống kê Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #tabs {
            display: flex;
            background-color: #f1f1f1;
            overflow-x: auto;
        }

        .tab {
            padding: 10px 15px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-bottom: none;
            background-color: #ddd;
            user-select: none;
        }

        .tab:hover {
            background-color: #ccc;
        }

        .tab.active {
            background-color: #fff;
            border-bottom: 2px solid #4285f4;
        }

        .tab-content {
            padding: 15px;
            border: 1px solid #ccc;
            min-height: 200px;
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
                <h2>Thống kê sản phẩm</h2>

                <div id="tabs">
                    <div class="tab active" onclick="redirectToThongKeSanPham()">Xuất xứ</div>

                    <div class="tab" onclick="openTab('tab2')">Thương hiệu</div>
                </div>

                <div id="tab1" class="tab-content" style="display: block;">
                    <h4>Xuất xứ</h4>

                    <?php
                    if (isset($_GET['xuatxu'])) {
                        $xuatxu = $_GET['xuatxu'];

                        include "../connect.php";

                        // Query để lấy thông tin thương hiệu theo xuất xứ
                        $sql = "SELECT th.id, th.tenthuonghieu, COUNT(sp.id) AS soluong
                                FROM thuonghieu th
                                LEFT JOIN sanpham sp ON th.id = sp.thuonghieu_id
                                WHERE th.xuatxu = '$xuatxu'
                                GROUP BY th.id";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table class='table table-hover'>";
                            echo "<tr><th>STT</th><th>Thương Hiệu</th><th>Số Lượng Sản Phẩm</th><th>Chi tiết</th></tr>";
                            $Stt = 1;
                            $TongSL = 0;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $Stt . "</td><td>" . $row["tenthuonghieu"] . "</td><td>" . $row["soluong"] . "</td>";
                                echo "<td>";
                                
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
                    } else {
                        echo "Không có thông tin xuất xứ được chọn.";
                    }
                    ?>
                </div>

                <div id="tab2" class="tab-content">
                    <h4>Thương hiệu</h4>
                    <?php
                        include "../connect.php";

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
    </div>

    <script>
        function redirectToThongKeSanPham() {
            window.location.href = 'thongkesanpham.php';
        }
        document.addEventListener('DOMContentLoaded', function () {
            openTab('tab1');
        });

        function openTab(tabId) {
            var tabContents = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].style.display = "none";
            }

            var tabs = document.getElementsByClassName("tab");
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove("active");
            }

            document.getElementById(tabId).style.display = "block";
            document.querySelector(".tab[data-tab='" + tabId + "']").classList.add("active");
        }

        // Thêm sự kiện để chuyển đến tab xuất xứ khi bấm vào thẻ "Xuất xứ" trong file quanlythuonghieu.php
        document.getElementById('xuatxuTab').addEventListener('click', function () {
            openTab('tab1');
        });
    </script>
    
</body>

</html>

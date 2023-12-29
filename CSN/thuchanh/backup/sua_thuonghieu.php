<?php
include "../connect.php";
$ma = $_GET["ma"];

$sql = "SELECT * FROM thuonghieu WHERE id ='$ma'";
$result = $conn->query($sql);
$ma_val = $ten_val = $xx_val = $mota_val = $anhthuonghieu_val = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ma_val = $row["id"];
        $ten_val = $row["tenthuonghieu"];
        $xx_val = $row["xuatxu"];
        $mota_val = $row["mota"];
        $anhthuonghieu_val = $row["anhthuonghieu"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quản lý thương hiệu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <h2>Quản lý thương hiệu</h2>
    <form action="sua_thuonghieu.php" method="post">
        <div class="mb-3 mt-3">
            <label for="id">Mã thương hiệu:</label>
            <input value="<?php echo $ma_val; ?>" readonly type="text" class="form-control" id="id" placeholder=""
                   name="id">
        </div>
        <div class="mb-3 mt-3">
            <label for="ten">Tên thương hiệu:</label>
            <input value="<?php echo $ten_val; ?>" type="text" class="form-control" id="ten"
                   placeholder="Nhập tên thương hiệu" name="ten">
        </div>
        <div class="mb-3 mt-3">
            <label for="xuatxu">Xuất xứ thương hiệu:</label>
            <input value="<?php echo $xx_val; ?>" type="text" class="form-control" id="xuatxu"
                   placeholder="Nhập xuất xứ thương hiệu" name="xuatxu">
        </div>
        <div class="mb-3 mt-3">
            <label for="mota">Mô tả:</label>
            <textarea class="form-control" id="mota" name="mota"
                      placeholder="Nhập mô tả thương hiệu"><?php echo $mota_val; ?></textarea>
        </div>
        <div class="mb-3 mt-3">
            <label for="anhthuonghieu">Ảnh thương hiệu:</label>
            <input value="<?php echo $anhthuonghieu_val; ?>" type="text" class="form-control" id="anhthuonghieu"
                   placeholder="Nhập đường dẫn ảnh thương hiệu" name="anhthuonghieu">
        </div>

        <button name="sbCapNhat" type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
  </div>

</div>



</body>
</html>

<?php
if (isset($_POST["sbCapNhat"])) {
    // Lấy biến từ form
    $ten = $xx = $ma = $mota = $anhthuonghieu = "";
    if (isset($_POST["ten"]) && isset($_POST["xuatxu"])) {
        $ten = $_POST["ten"];
        $xx = $_POST["xuatxu"];
        $ma = $_POST["id"];
        $mota = $_POST["mota"];
        $anhthuonghieu = $_POST["anhthuonghieu"];
    }

    // Viết câu truy vấn cập nhật
    $sql = "UPDATE thuonghieu SET tenthuonghieu='$ten', xuatxu = '$xx', mota = '$mota', anhthuonghieu = '$anhthuonghieu' WHERE id='$ma'";

    if ($conn->query($sql) === TRUE) {
        header("Location:thuonghieudathem.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

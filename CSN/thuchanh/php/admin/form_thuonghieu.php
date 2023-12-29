<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản Lý Thương Hiệu</title>
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
        <h2>Quản Lý Thương Hiệu</h2>
        <form action="./them_thuonghieu.php" method="post" enctype="multipart/form-data">

          <div class="mb-3 mt-3">
            <label for="tenthuonghieu">Tên thương hiệu</label>
            <input type="text" class="form-control" id="tenthuonghieu" name="tenThuongHieu" placeholder="Nhập tên thương hiệu">
          </div>

          <div class="mb-3 mt-3">
            <label for="xuatxu">Xuất xứ</label>
            <input type="text" class="form-control" id="xuatxu" name="xuatXu" placeholder="Nhập xuất xứ">
          </div>

          <div class="mb-3 mt-3">
            <label for="mota">Mô tả</label>
            <input type="text" class="form-control" id="mota" name="moTa" placeholder="Nhập mô tả">
          </div>
          
          <div class="mb-3 mt-3">
            <label for="anhthuonghieu">Ảnh thương hiệu</label>
            <input type="file" class="form-control" id="anhthuonghieu" name="anhThuongHieu">
          </div>
        
          <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>

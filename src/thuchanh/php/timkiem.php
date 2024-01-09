<?php
include "./connect.php";


// Lấy dữ liệu từ request POST
$searchInput = $_GET['key'];

// Thực hiện truy vấn tìm kiếm sản phẩm
$sql = "SELECT sanpham.*, hinhanh.link AS hinhanh_link FROM sanpham
        LEFT JOIN hinhanh ON sanpham.id = hinhanh.sanpham_id
        WHERE sanpham.ten LIKE '%$searchInput%'
           OR sanpham.mota LIKE '%$searchInput%'
           OR sanpham.hangsanxuat LIKE '%$searchInput%'
           OR sanpham.thuonghieu_id LIKE '%$searchInput%'";

$result = $conn->query($sql);

// Tạo một mảng để chứa kết quả tìm kiếm
$results = [];

// Kiểm tra xem có giá trị nhập liệu hay không
if (empty($searchInput)) {
  // Nếu không có giá trị nhập liệu, quay về trang index.html với thông báo
  echo json_encode([]);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product = [
            'id' => $row['id'],
            'ten' => $row['ten'],
            'gia' => number_format($row['gia'], 0, ',', '.'),
            'mota' => $row['mota'],
            'hangsanxuat' => $row['hangsanxuat'],
            'thuonghieu_id' => $row['thuonghieu_id'],
            'hinhanh' => [
                'link' => $row['hinhanh_link'],
            ],
        ];
        $results[] = $product;
    }
        // Đóng kết nối CSDL
        $conn->close();
         // Chuyển hướng đến trang timkiem.html với dữ liệu kết quả
         echo json_encode($results);
    // exit; // Đảm bảo rằng script kết thúc sau khi chuyển hướng
} else {
    // Nếu không tìm thấy kết quả, có thể thực hiện một số xử lý khác hoặc hiển thị thông báo
    // echo "No results found.";
     // Nếu không tìm thấy kết quả, quay về trang index.html với thông báo
    //  header('Location: ../index.html?message=' . urlencode("Sản phẩm không có trong cửa hàng."));
    echo json_encode([]);
    exit; // Đảm bảo rằng script kết thúc sau khi in thông báo
}
?>


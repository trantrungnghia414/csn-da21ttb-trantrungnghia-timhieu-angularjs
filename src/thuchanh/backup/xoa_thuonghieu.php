<?php
include "../connect.php";

// Lấy biến từ liên kết
$mathuonghieu = "";
if (isset($_GET["ma"])) {
    $mathuonghieu = $_GET["ma"];
}

// SQL để xóa một bản ghi
$sql = "DELETE FROM thuonghieu WHERE id='$mathuonghieu'";

if ($conn->query($sql) === TRUE) {
    header("Location:thuonghieudathem.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>

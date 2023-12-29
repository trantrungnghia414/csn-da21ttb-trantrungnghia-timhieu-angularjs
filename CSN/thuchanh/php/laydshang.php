<?php
include "./connect.php";

$sql = "SELECT * FROM thuonghieu";

$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    array_push($data, $row);
  }
} else {
  echo "0 results";
}
echo json_encode($data);
$conn->close();  

?>
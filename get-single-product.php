<?php
require('db.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
$id = $_GET['data'];
$sql = "SELECT * FROM products WHERE id =?";
$stmt = $conn->prepare($sql);
$data = '';
if($stmt){
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data = $row;
        }
        echo json_encode(["msg" => "success", "data" => $data]);
    }
    else{
        echo json_encode(["msg" => "no data found"]);
    }
    $stmt->close();
}
$conn->close();
}
?>
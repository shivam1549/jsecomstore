<?php
require('../db.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
$sql = "SELECT * FROM category ORDER BY ID DESC";
$stmt = $conn->prepare($sql);
if($stmt){
    $data = array();
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[] = $row;
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
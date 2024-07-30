<?php
require('../db.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
$id = $_GET['data'];
$sql = "SELECT COUNT(id) AS totalreviews, SUM(stars) AS totalratingssum, message, stars, subject, created_at, userid FROM reviews WHERE productid =?";
$stmt = $conn->prepare($sql);
$data = array();
if($stmt){
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[] = [
                "totalreviews" => $row['totalreviews'],
                'ratings' => $row['totalratingssum']/$row['totalreviews'],
                'message' => $row['message'],
                'stars' => $row['stars'],
                'subject' =>$row['subject'],
                'time' => $row['created_at'],
                'userid' => $row['userid'],
            ];
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
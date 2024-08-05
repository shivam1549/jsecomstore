<?php
require('../db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = '';
$categoryid = sanitize($conn, isset($_POST['categoryid']) ? $_POST['categoryid'] : '');
if(isset($categoryid)){
 
//   echo $userid . $productid;
  $sql = "DELETE FROM category WHERE id = ?";
  $stmt = $conn->prepare($sql);
    if($stmt){
        $stmt->bind_param("i", $categoryid);
        if($stmt->execute()){
            // echo "deleted";
            echo json_encode(["msg" => true]);
        }
        else{
            echo json_encode(["msg" => false]); 
        }
        $stmt->close(); // Close the statement
    }
    else{
        echo json_encode(["msg" => false]);
    }
}
else{
    echo json_encode(["msg" => false, "data" => "User not logged in!"]);  
}
}
?>
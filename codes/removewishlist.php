<?php
require('../db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = '';
$productid = sanitize($conn, isset($_POST['productid']) ? $_POST['productid'] : '');
if(isset($_SESSION['loggedin'])){
  $userid =  $_SESSION['userdetails']['id'];
//   echo $userid . $productid;
  $sql = "DELETE FROM wishlist WHERE productid = ? AND userid = ?";
  $stmt = $conn->prepare($sql);
    if($stmt){
        $stmt->bind_param("ii", $productid, $userid);
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
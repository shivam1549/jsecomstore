<?php
require('../db.php');
function checkwishlist($productid, $userid, $conn){
    $sql = "SELECT productid, userid FROM wishlist WHERE userid =? AND productid =?";
    $stmt = $conn->prepare($sql);
    if($stmt){
        $stmt->bind_param("ii", $userid, $productid);
        if($stmt->execute()){
          $result =  $stmt->get_result();
          if($result->num_rows > 0){
            return true;
          }
          else{
            return false;
          }
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = '';
$productid = sanitize($conn, isset($_POST['productid']) ? $_POST['productid'] : '');
if(isset($_SESSION['loggedin'])){
  $userid =  $_SESSION['userdetails']['id'];
}
if($userid && $productid){
    $checkifalreadyinwishlist = checkwishlist($productid, $userid, $conn);
    // echo $checkifalreadyinwishlist . "jkfkjfkj";
    if(!$checkifalreadyinwishlist){
    $sql = "INSERT INTO wishlist (productid, userid) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if($stmt){
        $stmt->bind_param("ii", $productid, $userid);
        if($stmt->execute()){
            echo json_encode(["msg" => true]);
        }
        else{
            echo json_encode(["msg" => false]); 
        }
        
    }
    else{
        echo json_encode(["msg" => false]); 
    }
}
else{
    echo json_encode(["msg" => false]);  
}

}
else{
    echo json_encode(["msg" => false]); 
}

}
?>
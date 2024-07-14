<?php
require('db.php');
if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
$data = $_SESSION['cart'];
$response = [
    "success" => true,
    "data" => $data
];
echo json_encode($response);

}
else{
    echo json_encode(["error"=> "No items in cart"]);
}
?>
<?php
require('db.php');
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    if (isset($_POST['id'])) {
        $cartkey = trim($_POST['id']);
        $cartkeys = array_column($_SESSION["cart"], "cartkey");
        
        // echo $cartkey;
        // var_dump($cartkeys);
        // Check if the current variation key exists in the session
        if (in_array($cartkey, $cartkeys)) {
            // echo "yeyey";
            unset($_SESSION["cart"][$cartkey]);
            echo json_encode(["success" => "item removed from cart"]);
        }
    } else {
        echo json_encode(["error" => "No items found"]);
    }
} else {
    echo json_encode(["error" => "No items in cart"]);
}

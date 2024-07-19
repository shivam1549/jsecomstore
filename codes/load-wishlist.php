<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require('../db.php');
if (isset($_SESSION['loggedin'])) {
    // echo "hey";
    $productidarray = array();
    $userid =  $_SESSION['userdetails']['id'];
    // echo $userid;
  $sql = "SELECT productid FROM wishlist WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $userid);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // echo "yes wish";
                while ($row = $result->fetch_assoc()) {
                    $productidarray[] = $row['productid'];
                }
                $productIds = implode(',', $productidarray);
                // echo $productIds;
                // Prepare the second query using the product IDs
                $sql = "SELECT * FROM products WHERE id IN ($productIds)";

                $stmt2 = $conn->prepare($sql);
                if ($stmt2->execute()) {
                    $result2 = $stmt2->get_result();
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                         
                            $products[] = $row2;
                        }
                        echo json_encode(["msg" => true, "data" => $products]);
                    } else {
                        echo json_encode(["msg" => false, "text" => "No items in wishlist"]);
                    }
                } else {
                   
                    echo json_encode(["msg" => false, "text" => "Error executing the second query: " . $stmt2->error]);
                }
            }
            else{
                echo json_encode(["msg" => false, "text" => "No items in wishlist"]);
            }
        }
        else{
            echo json_encode(["msg" => false, "text" => "Error executing the second query: " . $stmt->error]); 
        }
    }
} else {
    echo json_encode(["msg" => false, "text" => "Please login to access the page"]);
}

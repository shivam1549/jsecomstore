<?php
require('../db.php');
function checkpurchaseproduct($productid, $userid, $conn){
    $sql = "SELECT cart_details FROM orders WHERE user_id = ? AND JSON_UNQUOTE(JSON_EXTRACT(cart_details, JSON_UNQUOTE(JSON_SEARCH(cart_details, 'one', ?)))) = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("iii", $userid, $productid, $productid); // Bind the user ID and product ID twice
        $stmt->execute();
        $result = $stmt->get_result();
    
       if($result->num_rows > 0){
            // Process the cart_details as needed
            return true;
            // Do something with $cartDetails
        }
    
        $stmt->close();
    } else {
       return false;
    }
}
function checkexistingreview($productid, $userid, $conn){
    $sql = "SELECT COUNT(*) as count FROM reviews WHERE productid = ? AND userid = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ii", $productid, $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        if($row['count'] > 0){
        return true; // Return true if a review exists, false otherwise
        }
    } else {
        return false; // Failed to prepare statement
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = '';
    $username = sanitize($conn, $_POST['username']);
    $subject = sanitize($conn, $_POST['subject']);
    $rating = sanitize($conn, $_POST['rating']);
    $message = sanitize($conn, $_POST['message']);
    if (isset($_SESSION['loggedin'])) {
        $userid =  $_SESSION['userdetails']['id'];
    }
    $productid = sanitize($conn, $_POST['productid']);
    if ($userid && $productid && $username && $subject && $rating && $message) {
        // Check is user purchased the product
        $checkifalreadypurchased = checkpurchaseproduct($productid, $userid, $conn);
        $checkifreviewnotexist = checkexistingreview($productid, $userid, $conn);
        // echo $checkifalreadyinwishlist . "jkfkjfkj";
        if ($checkifalreadypurchased) {
            if(!$checkifreviewnotexist){
            $sql = "INSERT INTO reviews (name, userid,productid, subject, stars, message) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            
            if ($stmt) {
                $stmt->bind_param("siisis", $username, $userid, $productid, $subject, $rating, $message); // Bind parameters: s - string, i - integer
                if ($stmt->execute()) {
                    echo json_encode(["msg" => true]);
                } else {
                    echo json_encode(["msg" => false]);
                }
                $stmt->close();
            } else {
                echo json_encode(["msg" => false]);
            }
        }
        else{
            echo json_encode(["msg" => false]);  
        }
        } else {
            echo json_encode(["msg" => false]);
        }
    } else {
        echo json_encode(["msg" => false]);
    }
}

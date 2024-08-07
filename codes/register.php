<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require('../db.php');
$fullName = mysqli_real_escape_string($conn, $_POST['fullname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$sqlcheckuser = "SELECT email FROM users WHERE email =?";
$stmt = $conn->prepare($sqlcheckuser);
if($stmt){
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result(); // This is necessary to get the number of rows
    if ($stmt->num_rows > 0) {
        echo json_encode(["message" => "User Already Exist"]);
    }
    else{
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name,email,passwords) VALUES (?,?,?)";
        $stmtinsetuser = $conn->prepare($sql);
        if($stmtinsetuser){
            $stmtinsetuser->bind_param("sss", $fullName, $email, $hashedPassword);
            if($stmtinsetuser->execute()){
                $userid = $stmtinsetuser->insert_id;
                $_SESSION['loggedin'] = true;
                $_SESSION['userdetails'] = [
                    "id" => $userid,
                    "name" => $fullName,
                ];
                echo json_encode(["message" => "Account Created Successfully"]); 
               
            }
            else{
                echo json_encode(["message" => "Something went wrong"]);  
            }
            $stmtinsetuser->close();
        }
        else{
            echo json_encode(["error" => "Preparation failed: " . $conn->error], true);
        }

        $conn->close();

    }
}

?>
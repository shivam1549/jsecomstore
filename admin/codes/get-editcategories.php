<?php
require('../db.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = sanitize($conn, isset($_GET['id']) ? $_GET['id'] : '');
    // echo $id . "Ji";
    $sql = "SELECT * FROM category WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            echo json_encode(["msg" => "success", "data" => $row]);
        } else {
            echo json_encode(["msg" => "no data found"]);
        }
        $stmt->close();
    }
    $conn->close();
}

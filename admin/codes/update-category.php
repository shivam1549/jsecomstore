<?php
require("../db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = sanitize($conn, $_POST['title']);
$url = sanitize($conn, $_POST['url']);
$status = sanitize($conn, $_POST['status']);
$description = sanitize($conn, $_POST['description']);
$main_image = '';
$id = sanitize($conn, $_POST['categoryid']);

// Handle image upload
if (isset($_FILES['mainimages']) && $_FILES['mainimages']['error'] == 0) {
    $main_image_tmp = $_FILES['mainimages']['tmp_name'];
    if (is_uploaded_file($main_image_tmp) && isImageFile($main_image_tmp)) {
        $main_image = '../../uploads/' . basename($_FILES['mainimages']['name']);
        $uploadimg = basename($_FILES['mainimages']['name']);
        if (!move_uploaded_file($main_image_tmp, $main_image)) {
            echo json_encode(["error" => "Main image upload failed."]);
            exit;
        }
    } else {
        echo json_encode(["error" => "Main image upload failed or invalid file type."]);
        exit;
    }
}

// Check for existing entries with the same title or URL (if required)
$sql_check = "SELECT id FROM category WHERE (name = ? OR url = ?) AND id != ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ssi", $title, $url, $id);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    echo json_encode(["error" => "Category with the same title or URL already exists."]);
    exit;
}
$stmt_check->close();

// Prepare the SQL query
if ($main_image) {
    $sql = "UPDATE category SET name = ?, url = ?, description = ?, status = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $title, $url, $description, $status, $uploadimg, $id);
} else {
    $sql = "UPDATE category SET name = ?, url = ?, description = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $url, $description, $status, $id);
}

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["success" => "Category updated successfully."]);
} else {
    echo json_encode(["error" => "Category update failed."]);
}

$stmt->close();
$conn->close();

}

?>
<?php
require("../db.php");

function checkCategoryname($conn, $url) {
    $sql = "SELECT url FROM category WHERE url = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $url);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize($conn, $_POST['title']);
    $url = sanitize($conn, $_POST['url']);
    $status = sanitize($conn, $_POST['status']);
    $description = sanitize($conn, $_POST['description']);
    $main_image = '';

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

    // Check if the category URL already exists
    if (checkCategoryname($conn, $url)) {
        echo json_encode(["error" => "Category URL already exists."]);
        exit;
    }

    // Insert new category into the database
    $sql = "INSERT INTO category (name, url, description, status, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssis', $title, $url, $description, $status, $uploadimg);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => "Category added successfully."]);
    } else {
        echo json_encode(["error" => "Error adding category."]);
    }

    $stmt->close();
    $conn->close();

}
?>
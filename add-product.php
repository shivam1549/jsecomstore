<?php
require("db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize($conn, $_POST['title']);
    $reg_price = sanitize($conn, $_POST['reg_price']);
    $sale_price = sanitize($conn, $_POST['sale_price']);
    $description = sanitize($conn, $_POST['description']);
    $long_description = sanitize($conn, $_POST['long_description']);
    $category = sanitize($conn, $_POST['category']);
    $status = sanitize($conn, $_POST['status']);


    // Handle file upload for the main image
    $main_image = '';
    if (isset($_FILES['mainimages']) && $_FILES['mainimages']['error'] == 0) {
        $main_image_tmp = $_FILES['mainimages']['tmp_name'];
        if (is_uploaded_file($main_image_tmp) && isImageFile($main_image_tmp)) {
            $main_image = 'uploads/' . basename($_FILES['mainimages']['name']);
            move_uploaded_file($main_image_tmp, $main_image);
        } else {
            echo json_encode(["error" => "Main image upload failed or invalid file type."]);
            exit;
        }
    }

    // Handle multiple file uploads for the gallery
    $gallery_images = [];
    if (isset($_FILES['galleryimages']) && is_array($_FILES['galleryimages']['name']) ) {
        $total_files = count($_FILES['galleryimages']['name']);
        for ($i = 0; $i < $total_files; $i++) {
            $gallery_image_tmp = $_FILES['galleryimages']['tmp_name'][$i];
            if (is_uploaded_file($gallery_image_tmp) && isImageFile($gallery_image_tmp)) {
                $gallery_image_path = 'uploads/' . basename($_FILES['galleryimages']['name'][$i]);
                move_uploaded_file($gallery_image_tmp, $gallery_image_path);
                $gallery_images[] = $gallery_image_path;
            } else {
                echo json_encode(["error" => "Gallery image upload failed or invalid file type."]);
                exit;
            }
        }
    }
    $gallery_images_json = json_encode($gallery_images);
    $attributes_json = '';
    $variations_json = '';
    $attributes_json = $_POST['attributes'];
    $variations_json = $_POST['variations'];


    $sql = "INSERT INTO `products` 
    (title, reg_price, sale_price, qty, description, long_description, image, gallery, category, attributes, variations, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
      
        $stmt->bind_param("siiisssssssi", $title, $reg_price, $sale_price, $qty, $description, $long_description, $image, $gallery, $category, $attributes_json, $variations_json, $status);

        if ($stmt->execute()) {
            echo json_encode(["success" => "New record created successfully"]);
        } else {
            echo json_encode(["error" => "Error: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["error" => "Error preparing statement: " . $conn->error]);
    }
    $conn->close();
}

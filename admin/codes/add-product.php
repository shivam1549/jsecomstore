<?php
require("../db.php");
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
            $main_image = '../../uploads/' . basename($_FILES['mainimages']['name']);
            move_uploaded_file($main_image_tmp, $main_image);
        } else {
            echo json_encode(["error" => "Main image upload failed or invalid file type."]);
            exit;
        }
    }

    // Handle multiple file uploads for the gallery

    $gallery_images = [];
    // print_r($_FILES['galleryimages']);
    if (isset($_FILES['galleryimages'])) {
        // Loop through each uploaded file
        foreach ($_FILES['galleryimages']['name'] as $key => $name) {
            $gallery_image_tmp = $_FILES['galleryimages']['tmp_name'][$key];
            if (is_uploaded_file($gallery_image_tmp) && isImageFile($gallery_image_tmp)) {
                $gallery_image_path = '../../uploads/' . basename($name);
                if (move_uploaded_file($gallery_image_tmp, $gallery_image_path)) {
                    $gallery_images[] = $gallery_image_path;
                } else {
                    echo json_encode(["error" => "Failed to move uploaded file: $name"]);
                    exit;
                }
            } else {
                echo json_encode(["error" => "Gallery image upload failed or invalid file type: $name"]);
                exit;
            }
        }
    }
    
    $gallery_images_json = json_encode($gallery_images);
  
    // Get the JSON data from the request
$attributes = json_decode($_POST['attributes'], true);
$encoded_attribute_json = json_encode($attributes);
$variations = json_decode($_POST['variations'], true);

// Directory to save images
$targetDir = '../../variations/';
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0755, true);
}

$result = [];

foreach ($variations as $index => $combination) {
  
    // Save the main image
    $imgKey = $combination['img'];
    if (isset($_FILES[$imgKey])) {
        $imgFilename = uniqid() . '.' . pathinfo($_FILES[$imgKey]['name'], PATHINFO_EXTENSION);
        $imgPath = $targetDir . $imgFilename;
        if (move_uploaded_file($_FILES[$imgKey]['tmp_name'], $imgPath)) {
            $combination['img'] = $imgPath;
        } else {
            $combination['img'] = null;
        }
    }

    // Save gallery images
    $galleryPaths = [];
    foreach ($combination['gallery'] as $fileKey) {
        if (isset($_FILES[$fileKey])) {
            $galleryImgFilename = uniqid() . '.' . pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION);
            $galleryImgPath = $targetDir . $galleryImgFilename;
            if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $galleryImgPath)) {
                $galleryPaths[] = $galleryImgPath;
            }
        }
    }

    $combination['gallery'] = $galleryPaths;

    // Save combination to result
    $result[] = $combination;
}

$encoded_variations = json_encode($result);
// $gallery_imagesjson = json_encode($gallery_images);

// echo $gallery_images_json;

    $sql = "INSERT INTO `products` 
    (title, reg_price, sale_price, qty, description, long_description, image, gallery, category, attributes, variations, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
      
        $stmt->bind_param("siiisssssssi", $title, $reg_price, $sale_price, $qty, $description, $long_description, $main_image, $gallery_images_json, $category, $encoded_attribute_json, $encoded_variations, $status);

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

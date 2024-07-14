<?php
require("db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productid = sanitize($conn, $_POST['productid']);
    $price = sanitize($conn, $_POST['price']);
    $img = sanitize($conn, $_POST['img']);
    $filters = json_decode($_POST['filters']);
    // var_dump($filters);
    // echo json_decode($filters);
    // var_dump(json_encode($filters));
    // print_r(explode($filters));

    if (isset($productid) && isset($price) && isset($img) && isset($filters)) {
        $sql = "SELECT title FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $productid);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $title = $row['title'];
                    }
                    $cartkey = '';
                    // $jsonfilters = json_decode($filters);
                    $i = 0;
                    foreach ($filters as $key => $values) {
                      
                        foreach ($values as $value) {
                            $cartkey .= ($i != 0 ? "-" : "") . trim($value);
                            $i++;
                        }
                    }

                    // echo $cartkey;
                    if (isset($_SESSION['cart'])) {
                        if (!isset($_SESSION['cart'][$cartkey])) {
                            $_SESSION['cart'][$cartkey] = [
                                "cartkey" => $cartkey,
                                "price" => $price,
                                "title" => $title,
                                "attributes" => $filters,
                                "img" => $img,
                                "productid" => $productid,
                                "qty" => 1
                            ];
                        } else {
                            $_SESSION['cart'][$cartkey]['qty']++;
                        }
                    } else {
                        $_SESSION['cart'] = [
                            $cartkey => [

                                "cartkey" => $cartkey,
                                "price" => $price,
                                "title" => $title,
                                "attributes" => $filters,
                                "img" => $img,
                                "productid" => $productid,
                                "qty" => 1
                            ]
                        ];
                    }
                }
                $response = [
                    "success" => "Item added to cart",
                    "count" => count($_SESSION['cart'])
                ];

                // Output JSON response
                echo json_encode($response);
            } else {
                echo json_encode(["error" => "Something went wrong!"]);
            }
        }
    } else {
        echo json_encode(["error" => "Something went wrong!"]);
    }
}

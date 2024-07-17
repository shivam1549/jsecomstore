<?php
require("db.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // echo "fjk";

  // Billing Information
  $billing_info = [
    'billingFirstName' => sanitize($conn, $_POST['billingFirstName']),
    'billingLastName' => sanitize($conn, $_POST['billingLastName']),
    'billingPhone' => sanitize($conn, $_POST['billingPhone']),
    'billingEmail' => sanitize($conn, $_POST['billingEmail']),
    'billingAddress' => sanitize($conn, $_POST['billingAddress']),
    'billingCity' => sanitize($conn, $_POST['billingCity']),
    'billingState' => sanitize($conn, $_POST['billingState']),
    'billingZip' => sanitize($conn, $_POST['billingZip']),
    'billingCountry' => sanitize($conn, $_POST['billingCountry'])
  ];

  // Shipping Information
  if (isset($_POST['sameAsBilling']) && $_POST['sameAsBilling'] == 'on') {
    $shipping_info = $billing_info;
  } else {
    $shipping_info = [
      'shippingFirstName' => sanitize($conn, $_POST['shippingFirstName']),
      'shippingLastName' => sanitize($conn, $_POST['shippingLastName']),
      'shippingPhone' => sanitize($conn, $_POST['shippingPhone']),
      'shippingEmail' => sanitize($conn, $_POST['shippingEmail']),
      'shippingAddress' => sanitize($conn, $_POST['shippingAddress']),
      'shippingCity' => sanitize($conn, $_POST['shippingCity']),
      'shippingState' => sanitize($conn, $_POST['shippingState']),
      'shippingZip' => sanitize($conn, $_POST['shippingZip']),
      'shippingCountry' => sanitize($conn, $_POST['shippingCountry'])
    ];
  }

  $billing_info_json = json_encode($billing_info);
  $shipping_info_json = json_encode($shipping_info);
  $totalamount = 0;
  $cartdetails = '';
  $productdetails ='';
  if (isset($_SESSION['cart'])) {
    
    foreach ($_SESSION['cart'] as $cart) {
      $productdetails .= $cart['title'];
      $totalamount += $cart['price'] * $cart['qty'];
    }

    $cartdetails = json_encode($_SESSION['cart']);
  }

  $status = "order confirmed";
  $payment_status = "unpaid";
  $user_id = 1;

  if (isset($cartdetails) && !empty($cartdetails) && $totalamount > 0 && isset($billing_info) && isset($shipping_info)) {
   $sql = "INSERT INTO orders (cart_details, total_amount, shipping_address, billing_address, status, user_id, payment_status)
     VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
      // echo "prpr";
      $stmt->bind_param("sissssi", $cartdetails, $totalamount, $billing_info_json, $shipping_info_json, $status, $payment_status, $user_id);
      if ($stmt->execute()) {
        // echo "random";
        $random_number = rand(1000, 9999);
        $last_id = $conn->insert_id;
        $ordernumber  = "EIN" . $random_number . $last_id;
        $update_stmt = $conn->prepare("UPDATE orders SET order_number = ? WHERE id = ?");
        $update_stmt->bind_param("si", $ordernumber, $last_id);

        if ($update_stmt->execute()) {
          // echo "ipayed";
          // Process phone pay
          $merchantId = 'PGTESTPAYUAT86'; // sandbox or test merchantId
          $apiKey = "96434309-7796-489d-8924-ab56988a6076"; // sandbox or test APIKEY
          $redirectUrl = 'payment-success.php';
        
          // Set transaction details
          $order_id = $ordernumber;
          $name = $_POST['billingFirstName'] . $_POST['billingLastName'];
          $email = sanitize($conn, $_POST['billingEmail']);
          $mobile = sanitize($conn, $_POST['billingPhone']);
          $amount = $totalamount; // amount in INR
          $description = $productdetails;
        
        
          $paymentData = array(
            'merchantId' => $merchantId,
            'merchantTransactionId' => "MT7850590068188104", // test transactionID
            "merchantUserId" => $ordernumber,
            'amount' => $amount * 100,
            'redirectUrl' => $redirectUrl,
            'redirectMode' => "POST",
            'callbackUrl' => $redirectUrl,
            "merchantOrderId" => $order_id,
            "mobileNumber" => $mobile,
            "message" => $description,
            "email" => $email,
            "shortName" => $name,
            "paymentInstrument" => array(
              "type" => "PAY_PAGE",
            )
          );
        
        
          $jsonencode = json_encode($paymentData);
          $payloadMain = base64_encode($jsonencode);
          $salt_index = 1; //key index 1
          $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
          $sha256 = hash("sha256", $payload);
          $final_x_header = $sha256 . '###' . $salt_index;
          $request = json_encode(array('request' => $payloadMain));
        
          $curl = curl_init();
          curl_setopt_array($curl, [
            CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => [
              "Content-Type: application/json",
              "X-VERIFY: " . $final_x_header,
              "accept: application/json"
            ],
          ]);
        
          $response = curl_exec($curl);
          $err = curl_error($curl);
          // var_dump($response);
          curl_close($curl);
        
          if ($err) {
            // echo "cURL Error #:" . $err;
            echo json_encode(["error" => "cURL Error #:" . $err]);
          } else {
            $res = json_decode($response);
        
            if (isset($res->success) && $res->success == '1') {
              $paymentCode = $res->code;
              $paymentMsg = $res->message;
              $payUrl = $res->data->instrumentResponse->redirectInfo->url;
        
              // header('Location:' . $payUrl);
              echo json_encode(["success" => $payUrl]);
            }
          }
        }
        else{
          echo json_encode(["error" => "Order not placed"]);
        }
      }
      else{
        echo json_encode(["error" => "Order not placed".$stmt->error]);
      }
    }
  } else {
    echo json_encode(["error" => "Order not placed"]);
  }



 
}

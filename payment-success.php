<?php
require('db.php');
if(isset($_POST['code']) && !empty($_POST['code']) && $_POST['code']=="PAYMENT_ERROR"){
    echo "Txn id: ".$_POST['transactionId']." Status : ".$_POST['code'];
}else{
    echo "Txn id: ".$_POST['transactionId']." Status : ".$_POST['code'];
}
$paymentcode = $_POST['code'];
$orderid = $_SESSION['orderid'];
$txnid = $_POST['transactionId'];
 echo $_SESSION['orderid'] . "heordeid";

if(!empty($orderid) && !empty($paymentcode) && !empty($txnid)){
$sql = "UPDATE orders SET payment_status = ?, transaction_id = ? WHERE order_number = ?";
$stmt = $conn->prepare($sql);
if($stmt){
    $stmt->bind_param("sss", $paymentcode, $txnid, $orderid);
    if($stmt->execute()){
        echo "Order is placed";
    }
    else{
        echo "Error in order placing";
    }
}
}
else{
    echo "Error in order placing"; 
}
unset($_SESSION['cart']);
unset($_SESSION['orderid']);
?>
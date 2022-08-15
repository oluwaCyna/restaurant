<?php
include_once "script.php";
include_once "connection.php";

$response = [];
if ($req = json_decode(file_get_contents('php://input'), true)) {
$order_name = $req['order_name'];
$status = $req['status'];
$transaction_ref = $req['tx_ref'];
$transaction_id = $req['tx_id'];

$_SESSION['user_order_name'] = $order_name;


$update_order_details = new OrderDtailsUpdate;
$update_order_details->orderUpdate($order_name, $status, $transaction_ref, $transaction_id);
}

json_encode($response);
<?php
include_once "script.php";
include_once "connection.php";

$response = [];
if ($req = json_decode(file_get_contents('php://input'), true)) {
$user_id = $req['user_id'];
$order_name = $req['order_name'];
$order_amount = $req['amount'];
$status = $req['status'];
$delivery_location = $req['delivery_location'];

$upload_order_details = new OrderDtails;
$upload_order_details->orderUpload($user_id, $order_name, $order_amount, $status, $delivery_location);
}

json_encode($response);
<?php
include_once "script.php";
include_once "connection.php";

$response = [];
if ($req = json_decode(file_get_contents('php://input'), true)) {
foreach ($req as $key => $val) {
$id = $val['id'];
$name = $val['name'];
$quantity = $val['quantity'];
$price = $val['price'];
$order_name = $val['order-name'];

$unit_order_details = new UnitOrderDtails;
$unit_order_details->unitOrderUpload($order_name, $name, $quantity, $price);
}
}

json_encode($response);?>

<?php
require_once "script.php";
$response = [];
$req = json_decode(file_get_contents('php://input'), true);
print_r($req);
// $cart_product_id = $req['productId'];

echo json_encode($response);
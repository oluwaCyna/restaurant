<?php
include_once "script.php";
include_once "connection.php";
include_once "database.php";


$response = [];
$req = json_decode(file_get_contents('php://input'), true);
$user_order_name = $req['number'];

$pr_select_query = "SELECT * FROM all_order_products WHERE order_name = '$user_order_name'";
$pr_select_query_run = mysqli_query($db, $pr_select_query);
$all_user_products_result = $pr_select_query_run->fetch_all(MYSQLI_ASSOC);
$response['all_user_products_result']= $all_user_products_result;



$us_select_query = "SELECT * FROM user_order_history WHERE order_name = '$user_order_name'";
$us_select_query_run = mysqli_query($db, $us_select_query);
$delivery_result = mysqli_fetch_array($us_select_query_run);
$response['delivery_result']= $delivery_result;

echo json_encode($response);

<?php 
include_once "connection.php";
session_start();

// PRODUCT UPLOAD
class ProductUploader extends Dbconnect {

    public function productUpload($product_name, $product_image, $product_price, $product_category) {
    $sql = "INSERT INTO product (product_name, product_image, product_price, product_category) VALUES ('$product_name', '$product_image', '$product_price', '$product_category')";
    mysqli_query($this->conn, $sql);
    }
};

if (isset($_POST['upload-product-btn'])) {
  $file_name = basename($_FILES['product-image']['name']);
  $file_size = $_FILES['product-image']['size'];
  $tmp_name = $_FILES['product-image']['tmp_name'];
  $path = "product image/$file_name";
  $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
  move_uploaded_file($tmp_name, $path);

$product_upload = new ProductUploader;
$product_upload->productUpload($_POST['product-name'], $file_name, $_POST['product-price'],  $_POST['product-category']); 

};

// PRODUCT DISPLAY
class Product extends Dbconnect{ 

    public function all_product(){
        $select_query = "SELECT * FROM product ORDER BY RAND()";
        $select_query_run = mysqli_query($this->conn, $select_query);
        if ($select_query_run->num_rows > 0) {
            $result = $select_query_run->fetch_all(MYSQLI_ASSOC);
            return $result;
        } 
    }

    public function rand_product(){
        $select_query = "SELECT * FROM product ORDER BY RAND() LIMIT 8";
        $select_query_run = mysqli_query($this->conn, $select_query);
        if ($select_query_run->num_rows > 0) {
            $result = $select_query_run->fetch_all(MYSQLI_ASSOC);
            return $result;
        } 
    }

    public function product_by_name($product_name){
        $select_query = "SELECT * FROM product WHERE product_name='$product_name'";
        $select_query_run = mysqli_query($this->conn, $select_query);
        if ($select_query_run->num_rows > 0) {
            $result = $select_query_run->fetch_all(MYSQLI_ASSOC);
            return $result;
        } 
    }

    public function product_by_category($product_category){
        $select_query = "SELECT * FROM product WHERE product_category='$product_category'";
        $select_query_run = mysqli_query($this->conn, $select_query);
        if ($select_query_run->num_rows > 0) {
            $result = $select_query_run->fetch_all(MYSQLI_ASSOC);
            return $result;
        } 
    }
}

// Registration
if (isset($_POST['register'])) {

        $file_name = basename($_FILES['profile-pic']['name']);
        $file_size = $_FILES['profile-pic']['size'];
        $tmp_name = $_FILES['profile-pic']['tmp_name'];
        $path = "profile picture/$file_name";
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        move_uploaded_file($tmp_name, $path);
      
    // GETTING VALUE FROM INPUT;
    $fname = $_POST['fullname'];
    $_SESSION['email'] = $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $profile_pic = $file_name;
    
        $validation = new SignUp($_POST);
        $errors = $validation->validateform();
    
     $my_db = new Database();
    
        //Insert into database;
        $sql = $my_db->insert($fname, $email, $phone, $profile_pic, $password);
    
        if($sql)
    {
    header('location: account.php');
    }
    else
    {
    echo "<script>alert('Data not SUBMITED');</script>";
     }
    }

    // Login

if (isset($_POST['login'])) {
    $validation = new LoginInfo($_POST);
    $validation->senddata($_POST);
    $validation->validateform();
    if ($validation->select()) {
        $_SESSION["email"] = $_POST['email'];
        header('location: account.php');
    } else {
        echo "<script>alert('Login Error, Check your Details');</script>";
    }
  //  $login = new LoginInfo;

} 
 
// ORDER DETAILS UPLOAD
class OrderDtails extends Dbconnect {

    public function orderUpload($user_id, $order_name, $order_amount, $status, $delivery_location) {
    $sql = "INSERT INTO user_order_history (user_id, order_name, order_amount, status, delivery_location) VALUES ('$user_id', '$order_name', '$order_amount', '$status', '$delivery_location')";
    mysqli_query($this->conn, $sql);
    }
};

// ORDER DETAILS UPDATE
class OrderDtailsUpdate extends Dbconnect {

    public function orderUpdate($order_name, $status, $transaction_ref, $transaction_id) {
    $sql = "UPDATE user_order_history SET status = '$status', transaction_ref = '$transaction_ref', transaction_id = '$transaction_id' WHERE order_name = '$order_name'";
    mysqli_query($this->conn, $sql);
    }
};

// PRODUCT ORDER DETAILS
class Order extends Dbconnect{ 
public $order_result;
    public function all_orders(){
        $select_query = "SELECT * FROM user_order_history";
        $select_query_run = mysqli_query($this->conn, $select_query);
        if ($select_query_run->num_rows > 0) {
            $result = $select_query_run->fetch_all(MYSQLI_ASSOC);
            $order_result = $result;
            return $order_result;
        } 
        
    }
};

// PRODUCT EACH ORDER PRODUCTS
class OrderProduct extends Dbconnect{ 

    public function all_orderproduct(){
        $select_query = "SELECT * FROM all_order_products";
        $select_query_run = mysqli_query($this->conn, $select_query);
        if ($select_query_run->num_rows > 0) {
            $result = $select_query_run->fetch_all(MYSQLI_ASSOC);
            return $result;
        } 
    }
};

// UNIT ORDER DETAILS UPLOAD
class UnitOrderDtails extends Dbconnect {

    public function unitOrderUpload($order_name, $product_title, $product_quantity, $product_price) {
    $sql = "INSERT INTO all_order_products (order_name, product_title, product_quantity, product_price) VALUES ('$order_name', '$product_title', '$product_quantity', '$product_price')";
    mysqli_query($this->conn, $sql);
    }
};

// EACH USER PRODUCT EACH ORDER PRODUCTS
class UserOrderProduct extends Dbconnect{ 
    public $all_user_products_result;
    public function user_orderproduct($order_name){
        $select_query = "SELECT * FROM all_order_products WHERE order_name = '$order_name'";
        $select_query_run = mysqli_query($this->conn, $select_query);
        if ($select_query_run->num_rows > 0) {
            $all_user_products_result = $select_query_run->fetch_all(MYSQLI_ASSOC);
            return $all_user_products_result;
        } 
    }
};

class UserDelivery extends Dbconnect{ 
public $delivery_result;
    public function user_delivery_location ($order_name){
        $select_query = "SELECT * FROM user_order_history WHERE order_name = '$order_name'";
        $select_query_run = mysqli_query($this->conn, $select_query);
        if ($select_query_run->num_rows > 0) {
            $delivery_result = $select_query_run->fetch_all(MYSQLI_ASSOC);
            return $delivery_result;
        } 
    }
};
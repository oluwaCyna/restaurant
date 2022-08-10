<?php 
include_once "connection.php";
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
        $select_query = "SELECT * FROM product";
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
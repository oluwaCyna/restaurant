<?php
include_once "script.php";

/*************************
FOR PRODUCT OUTPUT BY category
*************************/
$fruits_product = new Product();
$fruits = $fruits_product->product_by_category("Fruits");

if ($fruits) {
        foreach ($fruits as $products) {
            $name = $products['product_name'];
            $category = $products['product_category'];
            $image = $products['product_image'];
            $price = $products['product_price'];
            $product_id = $products['id'];
            echo"
            <div class='product-group'>
                <div id='product-card'>
                    <div class='product-img-header'>
                        <img class='product-item-image' src='product image/$image' height='100' width='100' alt='Product Image' />
                        <div class='product-card-text'>
                            <h6 class='product-item-title'>$name</h6>
                            <p class='product-item-price'>$$price</p>
                        </div>
                    </div>
                    <input type='hidden' class='product-input' value='$product_id'/>
                    <button type='button' class='order-btn'>ADD TO CART</button>
                </div>
            </div>
            <hr />";
            }
        }else{
            echo "NO PRODUCT IN THIS CATEGORY";
        }
        
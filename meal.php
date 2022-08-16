<?php
include_once "script.php";

/*************************
FOR ALL PRODUCT OUTPUT
*************************/
$product_r = new Product();
$product_output_r = $product_r->rand_product();
if ($product_output_r) {

        foreach ($product_output_r as $meals) {
            $name = $meals['product_name'];
            $image = $meals['product_image'];
            $price = $meals['product_price'];
            echo"
            <div class='meal-card'>
                    <div class='meal-card-image'>
                        <div class='meal-card-div'></div>
                        <div class='meal-card-div2'></div>
                        <div class='meal-card-div3'></div>
                        <img src='product image/$image' height='150' width='150' alt='Product Image' />
                    </div>
                    <div class='meal-card-text'>
                        <h6>$name</h6>
                        <p> $price</p>
                    </div>
                </div>";  
            }
        }
        

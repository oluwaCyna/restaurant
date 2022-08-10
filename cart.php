<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100;200;300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="script.js" async></script>
</head>

<body onload="cartPageLoad();">
    <header class="" id="wrapper">
        <?php include_once "navigation.php" ?>
    </header>
    <div class="grid-container">
        <div class="" id="product-container">

            <div class="" id="product-list">
                <div class="product-head-container">
                    <h2>Carts (2)</h2>
                    <div class="line-group">
                        <hr class="line" />
                        <hr class="line2" />
                        <hr class="line2" />
                        <hr class="line2" />
                    </div>
                </div>
                <hr />
                <div class='cart-group'>
                <!-- <div class='cart-card'> -->
                    <!-- <div class='cart-img-header'>
                        <img src='product image/$image' height='100' width='100' alt='Product Image' />
                        <div class='cart-card-text'>
                            <h6>$name</h6>
                            <p class="cart-price">$$price</p>
                        </div>
                    </div>
                    <input type='hidden' class='product-input' value='$product_id'/>
                    <input type='number' class='cart-quantity-input' value='1'/>
                    <button type='button' class='cart-remove-btn'>REMOVE</button>
                    <hr /> -->
                <!-- </div> -->
            </div>
            
                <hr />
                <br />
                <div class="cart-total">
                    <h2>Total:</h2>
                    <h2 class="cart-total-price"></h2>
                </div>
                <div class="cart-action" id="cart-action">
                <button type="button" class="purchase-btn" id="purchase-btn">Check Out</button> 
                </div>

            </div>
        </div>

        <div class="other-section">

        </div>
    </div>
</body>

</html>
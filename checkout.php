<?php 
session_start();
include_once "redirect.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100;200;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" type="text/css" media="all" />
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0rLBIvztnTJG62LUG7tFj4SwZBbUNgo0&libraries=places&callback=initAutocomplete" defer>
    </script>
    <script src="script.js" defer></script>
    <script src="https://checkout.flutterwave.com/v3.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
</head>

<body>
    <header class="" id="wrapper">
        <?php include_once "navigation.php" ?>
    </header>
    <div class="grid-container">
        <div class="" id="product-container">

            <div class="" id="product-list">
                <div class="product-head-container">
                    <h2>Check Out</h2>
                    <div class="line-group">
                        <hr class="line" />
                        <hr class="line2" />
                        <hr class="line2" />
                        <hr class="line2" />
                    </div>
                </div>
                <hr />
                <div class="checkout-group-container">
                <h5>You want to check out the following</h5>
                    <div class="checkout-card">
                        <h6></h6>
                        <h6></h6>
                        <h6></h6>
                    </div>
                </div>
                <br />
                <hr />

                <div class="product-group">
                <h5>Please enter the delivery location. <br /><small>You can enter a known place and then fine tuned your precise location with the maker on the map.</small></h5>
                <input type="text" class="delivey-input" id="search" required>
                <div id="map"></div>
                    
                </div>
                <hr />
                <br />
                <div class="cart-action" id="cart-action">
                <button type="submit" class="payment-btn" id="payment-btn" name="payment-btn">Pay Now</button>
                </div>

            </div>
        </div>

        <div class="other-section">

        </div>
    </div>
    <?php include_once "footer.php" ?>
</body>

</html>
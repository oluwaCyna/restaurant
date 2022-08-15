<?php include_once "script.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100;200;300&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/food-point-logo-symbol-and-icon-template-to-show-the-location-of-the-food-seller-vector.webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <script type="text/javascript" src="script.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</head>

<body onload="showCategories();">
    <header class="" id="wrapper">
        <?php include_once "navigation.php" ?>
    </header>
    <div class="grid-container">
        <div class="" id="product-container">
            <div class="" id="Product-category">
                <div class="product-head-container">
                    <h2>Categories</h2>
                    <div class="line-group">
                        <hr class="line" />
                        <hr class="line2" />
                        <hr class="line2" />
                        <hr class="line2" />
                    </div>
                </div>
                <div class="category-button-group">
                    <button type="submit" class="category-btn" onclick="showCategories();">All Products</button>
                    <button type="submit" class="category-btn" onclick="showCereals();">Cereals</button>
                    <button type="submit" class="category-btn" onclick="showDrinks();">Drinks</button>
                    <button type="submit" class="category-btn" onclick="showFruits();">Fruits</button>
                    <button type="submit" class="category-btn" onclick="showSwallow();">Swallow</button>
                </div>
            </div>
            <hr />
            <div class="" id="product-list">
                <div class="cart-total">
                <div class="product-head-container">
                    <h2 id="category-title"></h2>
                    <div class="line-group">
                        <hr class="line" />
                        <hr class="line2" />
                        <hr class="line2" />
                        <hr class="line2" />
                    </div>
                </div>
                <button type="submit" class="category-btn" data-bs-toggle="modal" data-bs-target="#cart-modal">VIEW CART</button>
                </div>
                <hr />
                <div id="all-products"><?php include_once "products.php\all-products.php"; ?></div>
                <div id="cereals"><?php include_once "products.php\cereals.php"; ?></div>
                <div id="drinks"><?php include_once "products.php\drinks.php"; ?></div>
                <div id="fruits"><?php include_once "products.php\/fruits.php"; ?></div>
                <div id="swallow"><?php include_once "products.php\swallow.php"; ?></div>
            </div>
        </div>

        <div class="other-section">

        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="cart-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
      <div class="product-head-container">
                    <h2>Carts</h2>
                    <div class="line-group">
                        <hr class="line" />
                        <hr class="line2" />
                        <hr class="line2" />
                        <hr class="line2" />
                    </div>
                </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class='cart-group'>
      </div>
      <br />
                <div class="cart-total">
                    <h2>Total:</h2>
                    <h2 class="cart-total-price"></h2>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="purchase-btn">Check Out</button> 
      </div>
    </div>
  </div>
</div>
<?php include_once "footer.php" ?>
</body>

</html>
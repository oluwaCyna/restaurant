<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100;200;300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="script.js" defer></script>
</head>

<body onload="showFoodPoint();">
    <header class="" id="wrapper">
        <?php include_once "navigation.php" ?>
    </header>
    <div class="account-grid-container account-page-height">
        <div class="other-section account-list">
            <h5 class="account-link" onclick="showFoodPoint();"><a class="account-anchor-link" href="#food-point">Food Point</a></h5>
            <h5 class="account-link" onclick="showAddDispatch();"><a class="account-anchor-link" href="#add-dispatch">Add Dispatch</a></h5>
            <h5 class="account-link" onclick="showDispatchList();"><a class="account-anchor-link" href="#dispatch-list">Dispatch List</a></h5>
            <h5 class="account-link" onclick="showIncomingOrder();"><a class="account-anchor-link" href="#incoming-order">Incoming Order</a></h5>
            <h5 class="account-link" onclick="showTrackDispatch();"><a class="account-anchor-link" href="#track-dispatch">Track Dispatch</a></h5>
        </div>
        <div class="" id="product-container">

            <div class="" id="">
                <div class="profile-head-container">
                    <h2>Admin Dashboard</h2>
                    <div class="line-group">
                        <hr class="line" />
                        <hr class="line2" />
                        <hr class="line2" />
                        <hr class="line2" />
                    </div>
                </div>
                <div class="profile-head-container">
                    <h5 id="admin-title"></h5>
                    <div class="line-group">
                        <hr class="line" />
                        <hr class="line2" />
                        <hr class="line2" />
                        <hr class="line2" />
                    </div>
                </div>
                <hr />
                <div class="profile" id="food-point">
                    <div class="profile-picture">
                        <img src="https://i.ibb.co/gTBPJ48/logo.jpg" class="profile-img" width="300" height="300" alt="Profile Pictture" />
                    </div>
                    <div class="profile-details">
                        <div class="profile-details-list">
                            <h6>FOOD POINT</h6><p><?php ?></p>
                        </div>
                        <div class="profile-details-list">
                            <h6>ORDER TAKEN: </h6><p><?php ?></p>
                        </div>
                        <div class="profile-details-list">
                            <h6>DISPATCH AVAILABLE: </h6><p><?php ?></p>
                        </div>
                        <div class="profile-details-list">
                            <h6>PENDING ORDER: </h6><p><?php ?></p>
                        </div>
                    </div>
                </div>
                <div class="update-profile" id="add-dispatch">
                    <form method="post" action="">
                    <div class="form-grp">
                    <label for="update-fullname">Full Name:</label>
                    <input type="text" class="account-input" id="update-fullname" name="update-fullname" value="<?php ?>" >
                    </div>

                    <div class="form-grp">
                    <label for="update-email">Email:</label>
                    <input type="text" class="account-input" id="update-email" name="update-email" value="<?php ?>" >
                    </div>

                    <div class="form-grp">
                    <label for="update-phone-number">Phone Number:</label>
                    <input type="text" class="account-input" id="update-phone-number" name="update-phone-number" value="<?php ?>" >
                    </div>

                    <div class="form-grp">
                    <label for="update-password">Location:</label>
                    <input type="text" class="account-input" id="update-password" name="update-password" value="<?php  ?>" >
                    </div>

                    <div class="form-grp">
                        <button type="submit" class="order-btn" id="update-profile-btn" name="update-profile-btn">ADD</button>
                    </div>
                    </form>
                </div>
                <div class="order-history" id="dispatch-list">
                    <table>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="order-history" id="incoming-order">
                    <table>
                        <tr>
                            <th>S/N</th>
                            <th>Order Number</th>
                            <th>Order Amount</th>
                            <th>Order Status</th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="track-order" id="track-dispatch">
                    <form>
                    <div class="form-grp">
                    <label for="order-number">Order Number:</label>
                    <input type="text" class="account-input" id="order-number" name="order-number" value="<?php  ?>" >
                    </div>

                    <div class="form-grp">
                        <button type="submit" class="order-btn" id="update-profile-btn" name="update-profile-btn">Update</button>
                    </div>
                    </form>
                    <div id="map2"></div>
                </div>

                <hr />
               
            </div>
        </div>

    </div>
</body>

</html>
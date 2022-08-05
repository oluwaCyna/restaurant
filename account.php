<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100;200;300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="script.js" defer></script>
</head>

<body onload="showProfile();">
    <header class="" id="wrapper">
        <?php include_once "navigation.php" ?>
    </header>
    <div class="account-grid-container account-page-height">
        <div class="other-section account-list">
            <h5 class="account-link" onclick="showProfile();"><a class="account-anchor-link" href="#profile">My Profile</a></h5>
            <h5 class="account-link" onclick="showUpdateProfile();"><a class="account-anchor-link" href="#update-profile">Update Profile</a></h5>
            <h5 class="account-link" onclick="showOrderHistory();"><a class="account-anchor-link" href="#order-history">Order History</a></h5>
            <h5 class="account-link" onclick="showTrackOrder();"><a class="account-anchor-link" href="#track-order">Track Delivery</a></h5>
        </div>
        <div class="" id="product-container">

            <div class="" id="">
                <div class="profile-head-container">
                    <h2>My Account</h2>
                    <div class="line-group">
                        <hr class="line" />
                        <hr class="line2" />
                        <hr class="line2" />
                        <hr class="line2" />
                    </div>
                </div>
                <div class="profile-head-container">
                    <h5 id="account-title"></h5>
                    <div class="line-group">
                        <hr class="line" />
                        <hr class="line2" />
                        <hr class="line2" />
                        <hr class="line2" />
                    </div>
                </div>
                <hr />
                <div class="profile" id="profile">
                    <div class="profile-picture">
                        <img src="img/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg" class="profile-img" width="300" height="300" alt="Profile Pictture" />
                    </div>
                    <div class="profile-details">
                        <div class="profile-details-list">
                            <h6>Full Name: </h6><p><?php ?></p>
                        </div>
                        <div class="profile-details-list">
                            <h6>Email: </h6><p><?php ?></p>
                        </div>
                        <div class="profile-details-list">
                            <h6>Phone Number: </h6><p><?php ?></p>
                        </div>
                        <div class="profile-details-list">
                            <h6>Password: </h6><p><?php ?></p>
                        </div>
                    </div>
                </div>
                <div class="update-profile" id="update-profile">
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
                    <label for="update-password">Password:</label>
                    <input type="text" class="account-input" id="update-password" name="update-password" value="<?php  ?>" >
                    </div>

                    <div class="form-grp">
                        <button type="submit" class="order-btn" id="update-profile-btn" name="update-profile-btn">Update</button>
                    </div>
                    </form>
                </div>
                <div class="order-history" id="order-history">
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
                <div class="track-order" id="track-order">
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
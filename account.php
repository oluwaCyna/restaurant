<?php include_once 'script.php';
include_once "redirect.php";
include_once "database.php";
include_once "dataserver.php";
include_once "dataserver-update.php";

// SELECTING USER INFOMATION FOR DASHBOARD FROM THE DATABASE;
$session_email = $_SESSION['email'];
$select_query = "SELECT * FROM user WHERE email = '$session_email'";
$select_query_run = mysqli_query($db, $select_query);
$user_result = mysqli_fetch_array($select_query_run);
$_SESSION['id'] = $user_result['id'];

if (isset($_POST['update-profile-btn'])) {
    $file_name = basename($_FILES['update-profile-image']['name']);
    $file_size = $_FILES['update-profile-image']['size'];
    $tmp_name = $_FILES['update-profile-image']['tmp_name'];
    $path = "profile picture/$file_name";
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    move_uploaded_file($tmp_name, $path);
    $new_profile_pic = $file_name;
    $new_fullanme = $_POST['update-fullname'];
    $new_email = $_POST['update-email'];
    $new_phone_number = $_POST['update-phone-number'];
    $new_password = $_POST['update-password'];
    mysqli_query($db, "UPDATE user SET fullname='$new_fullanme', email='$new_email', phone_number='$new_phone_number', profile_pic='$new_profile_pic', password='$new_password' WHERE email='$session_email'");
}

// SELECTING USER INFOMATION FOR DASHBOARD FROM THE DATABASE;
$session_id = $_SESSION['id'];
$select_order_query = "SELECT * FROM user_order_history WHERE user_id = '$session_id'";
$select_order_query_run = mysqli_query($db, $select_order_query);
$user_order_result = $select_order_query_run->fetch_all(MYSQLI_ASSOC);

?>
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

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" async></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0rLBIvztnTJG62LUG7tFj4SwZBbUNgo0&libraries=places&callback=initAutocomplete">
    </script>
    <script type="text/javascript" src="script.js" async></script>

</head>

<body onload="showProfile();">
    <header class="" id="wrapper">
        <?php include_once "navigation.php" ?>
    </header>
    <div id="bk">
        <div id="loader"></div>
    </div>
    <div id="account-page" class="account-grid-container account-page-height">
        <div class="other-section account-list">
            <h5 class="account-link" onclick="showProfile();"><a class="account-anchor-link" href="#profile">My Profile</a></h5>
            <h5 class="account-link" onclick="showUpdateProfile();"><a class="account-anchor-link" href="#update-profile">Update Profile</a></h5>
            <h5 class="account-link" onclick="showOrderHistory();"><a class="account-anchor-link" href="#order-history">Order History</a></h5>
            <h5 class="account-link" onclick="showTrackOrder();"><a class="account-anchor-link" href="#track-order">Track Delivery</a></h5>
            <h5 class="account-link"><a class="account-anchor-link" href="logout.php">Log Out</a></h5>
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
                        <img src="profile picture/<?php echo $user_result['profile_pic']; ?>" class="profile-img" width="300" height="300" alt="Profile Picture" style="border-radius: 50%;" />
                    </div>
                    <div class="profile-details">
                        <div class="profile-details-list">
                            <h6>Full Name: </h6>
                            <p id="details-fullname"><?php echo $user_result['fullname']; ?></p>
                        </div>
                        <div class="profile-details-list">
                            <h6>Email: </h6>
                            <p id="details-email"><?php echo $user_result['email']; ?></p>
                        </div>
                        <div class="profile-details-list">
                            <h6>Phone Number: </h6>
                            <p id="details-phone"><?php echo $user_result['phone_number']; ?></p>
                        </div>
                        <div class="profile-details-list">
                            <h6>Password: </h6>
                            <p id="details-password"><?php echo $user_result['password']; ?></p>
                            <input type="hidden" id="details-id" value="<?php echo $user_result['id']; ?>" />
                        </div>
                    </div>
                </div>
                <div class="update-profile" id="update-profile">
                    <form method="post" action="account.php" enctype="multipart/form-data">
                        <div class="form-grp">
                            <label for="update-fullname">Full Name:</label>
                            <input type="text" class="account-input" id="update-fullname" name="update-fullname" value="<?php echo $user_result['fullname']; ?>">
                        </div>

                        <div class="form-grp">
                            <label for="update-email">Email:</label>
                            <input type="text" class="account-input" id="update-email" name="update-email" value="<?php echo $user_result['email']; ?>">
                        </div>

                        <div class="form-grp">
                            <label for="update-phone-number">Phone Number:</label>
                            <input type="text" class="account-input" id="update-phone-number" name="update-phone-number" value="<?php echo $user_result['phone_number']; ?>">
                        </div>

                        <div class="form-grp">
                            <label for="update-password">Password:</label>
                            <input type="text" class="account-input" id="update-password" name="update-password" value="<?php echo $user_result['password']; ?>">
                        </div>

                        <div class="form-grp">
                            <label for="update-profile-image">Profile Image:</label>
                            <input type="file" class="account-input" id="update-profile-image" name="update-profile-image" value="<?php echo $user_result['profile_pic']; ?>">
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
                            <th>Transaction ID</th>
                            <th>Order Status</th>
                        </tr>
                        <?php
                        if (($user_order_result)) {
                            $i = 1;
                            foreach ($user_order_result as $result) {
                                $or_name = $result['order_name'];
                                $or_amount = $result['order_amount'];
                                $or_id = $result['transaction_id'];
                                $or_status = $result['status'];
                                echo "
                            <tr>
                             <td>" . $i++ . "</td>
                             <td>$or_name</td>
                             <td>$$or_amount</td>
                             <td>$or_id</td>
                             <td>$or_status</td>
                            </tr>";
                            }
                        } else {
                            "";
                        }
                        ?>
                    </table>
                </div>

                <div class="track-order" id="track-order">
                    <div class="form-grp">
                        <label for="user-order-number">Order Number:</label>
                        <input type="text" class="account-input" id="user-order-number" name="user-order-number">
                    </div>
                    <div class="form-grp">
                        <button type="submit" class="track-btn" id="track-order-btn">Track</button>
                    </div>

                    <div class="">
                        <h3 id="order-name"></h3>
                        <table id="track-order-list">
                            <tr>
                                <th>S/N</th>
                                <th>Quantity</th>
                                <th>Product title</th>
                                <th>Price</th>
                            </tr>
                        </table>

                        <div class="profile-details">
                            <div class="profile-details-list">
                                <h6>Total Amount: </h6>
                                <p id="user-total-amount"></p>
                            </div>
                            <div class="profile-details-list">
                                <h6>Delivery location: </h6>
                                <p id="user-delivery-location"></p>
                            </div>
                            <div class="profile-details-list">
                                <h6>Distance of Delivery: </h6>
                                <p id="user-delivery-distance"></p>
                            </div>
                            <div class="profile-details-list">
                                <h6>Estimated Time of Delivery, ETA: </h6>
                                <p id="user-delivery-time"></p>
                            </div>

                        </div>
                        <div id="map2"></div>
                    </div>
                    <hr />

                </div>
            </div>
        </div>
        <?php include_once "footer.php" ?>
</body>

</html>
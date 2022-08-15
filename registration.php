<?php
    include_once "validation.php";
    include_once 'script.php'; 
  ?>

<!doctype html>
<html lang="en">
  <head>
    <title>Regisration</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/x-icon" href="img/food-point-logo-symbol-and-icon-template-to-show-the-location-of-the-food-seller-vector.webp">

  </head>
  <body>
<div class="container mt-5 mx-auto">
<p class="mb-4 account">Already have an <a href="login.php">account?</a></p>
  <div class="row">
    <div class="col-md-6">
    <img height="100%" src="img/istockphoto-1220524110-612x612.jpg" alt="">
          
    </div>
    <div class="col-md-6 d-flex justify-content-center align-items-center bg-light">
    <form class="w-100"  method="POST" action="registration.php" enctype="multipart/form-data">
           
                 <!-- fullname -->
                 <div class="mb-3"> 
    <div class="input-group">
  <input type="text" class="form-control" name="fullname" placeholder="fullname"  aria-label="fullname"  aria-describedby="basic-addon2">
  <span class="input-group-text" id="basic-addon2">fullname</span> 
</div>
  <span class="text-danger" style="font-weight: 500">
         <?php echo $errors['fullname'] ?? '' ?>
 </span>
    </div>

                <!-- email -->
                <div class="mb-3"> 
    <div class="input-group">
  <input type="email" class="form-control" name="email" placeholder="email"  aria-label="email"  aria-describedby="basic-addon2">
  <span class="input-group-text" id="basic-addon2">Email</span> 
</div>
  <span class="text-danger" style="font-weight: 500">
         <?php echo $errors['email'] ?? '' ?>
 </span>
    </div>


          <!-- phone -->
          <div class="mb-3"> 
    <div class="input-group">
  <input type="number" class="form-control" name="phone" placeholder="phone"  aria-label="phone"  aria-describedby="basic-addon2">
  <span class="input-group-text" id="basic-addon2">phone</span> 
</div>
  <span class="text-danger" style="font-weight: 500">
         <?php echo $errors['phone'] ?? '' ?>
 </span>
    </div>

                  <!-- Password -->
                  <div class="mb-3"> 
    <div class="input-group">
  <input type="password" class="form-control" name="password" placeholder="password"  aria-label="password"  aria-describedby="basic-addon2">
  <span class="input-group-text" id="basic-addon2">Password</span> 
</div>
  <span class="text-danger" style="font-weight: 500">
         <?php echo $errors['password'] ?? '' ?>
 </span>
    </div>
    
                  <!-- Picture -->
                  <div class="mb-3"> 
    <div class="input-group">
  <input type="file" class="form-control" name="profile-pic"  aria-label="profile-pic"  aria-describedby="basic-addon2">
  <span class="input-group-text" id="basic-addon2">Profile Picture</span> 
</div>
  <span class="text-danger" style="font-weight: 500">
         <?php echo $errors['profile-pic'] ?? '' ?>
 </span>
    </div>

    <div class="d-grid gap-2 col-12">
      <button type="submit" name="register"  class="btn">SignUp</button>
    </div>

</form>
    </div>
    </div>
  </div>
  <?php include_once "footer.php" ?>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
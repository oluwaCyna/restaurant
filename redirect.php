<?php 
if (!$_SESSION['email']) {
    echo '<script>alert("You don\'t have an an account with us, please register!")
    window.location.href = "/delivery/registration.php";
    </script>';
}

?>

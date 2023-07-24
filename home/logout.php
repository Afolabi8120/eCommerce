<?php
    include('../core/init.php');

    unset($_SESSION['email']);
    $_SESSION['SuccessMessage'] = "Logout Successful";
    header('location: ../index');

?>
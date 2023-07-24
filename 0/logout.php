<?php
    include('../core/init.php');

    unset($_SESSION['admin']);
    $_SESSION['SuccessMessage'] = "Logout Successful";
    header('location: ../index');

?>
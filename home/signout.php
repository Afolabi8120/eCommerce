<?php
    include('../core/init.php');

    $_SESSION[] = array();
    session_destroy();
    $_SESSION['SuccessMessage'] = "Logout Successful";
    header('location: ../../');

?>
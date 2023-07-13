<?php
	include('database/config.php');
	include('classes/Admin.php');
	include('classes/User.php');
    include('classes/Category.php');
    include('classes/Product.php');
    include('classes/Order.php');

	global $pdo;

	$admin = new Admin($pdo);
	$user = new User($pdo);
    $category = new Category($pdo);
    $product = new Product($pdo);
    $order = new Order($pdo);

	session_start();

    function ErrorMessage(){
        if(isset($_SESSION['ErrorMessage'])){
            $output = '<div class = "alert alert-danger bg-danger text-white" style = "text-align: center;" role = "alert">';
            $output .= htmlentities($_SESSION['ErrorMessage']);
            $output .= '</div>';
            $_SESSION['ErrorMessage'] = null;
            return $output;
        }

    }

    function SuccessMessage(){
        if(isset($_SESSION['SuccessMessage'])){
            $output = '<div class = "alert alert-success bg-success text-white" style = "text-align: center;" role = "alert">';
            $output .= htmlentities($_SESSION['SuccessMessage']);
            $output .= '</div>';
            $_SESSION['SuccessMessage'] = null;
            return $output;
        }

    }

	define("BASE_URL", "http://localhost/e-commerce/");

	date_default_timezone_set("Africa/Lagos");
    $h = date('G');

    if($h >= 5 && $h <= 11){
        $getdate = "Good Morning";
    }else if($h >= 12 && $h <= 15){
        $getdate = "Good Afternoon";
    }else if($h >= 16 && $h <= 23){
        $getdate = "Good Evening";
    }else {
        $getdate = "Good Morning";
    }
?>
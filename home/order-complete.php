<?php
  include('../core/init.php');
  $pageTitle = "Order Completed";

  if(isset($_SESSION['email']) AND !empty($_SESSION['email']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['email']);
    $getSession = $user->getCustomerData($_SESSION['email']);

    if($_SESSION['session_id'] !== $getSession->session){
      header('location: ../index');
    }else{
      
    }
  }else{
    header('location: ../index');
  }

?>
  <?php include('../includes/header.php'); ?>
  <body>
    

 <!--start wrapper-->
    <div class="wrapper">
       <!--start sidebar wrapper-->
       <?php include('../includes/sidebar.php'); ?>
       <!--end sidebar wrapper-->

        <!--start top header-->
          <header class="top-header">
            <?php include('../includes/top-header.php'); ?>
          </header>
        <!--end top header-->


        <!-- start page content wrapper-->
        <div class="page-content-wrapper">
          <!-- start page content-->
         <div class="page-content">

          <!--start breadcrumb-->
          <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                  <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Order Complete</li>
                </ol>
              </nav>
            </div>
          </div>
          <!--end breadcrumb-->

          <div class="card">
            <div class="card-body text-center">
              <i class="fa fa-check-circle fa-5x text-success mb-2"></i>
              <h2 class="h4 pb-3 text-success">Thank you for your order!</h2>
              <p class="fs-sm mb-2">Your order has been placed and will be processed as soon as possible.</p>
              <p class="fs-sm mb-2">Make sure you make note of your order number, which is <span class="fw-bold">34VB5540K83.</span>
              </p>
              <p class="fs-sm">You will be receiving an email shortly with confirmation of your order.
              </p>
              <a class="btn btn-primary mt-3" href="dashboard">Go back shopping</a>
              <a class="btn btn-white mt-3" href="track-order"><i class="bx bx-map"></i>Track order</a>
            </div>
          </div>

          </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('../includes/footer.php'); ?>



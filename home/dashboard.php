<?php
  require('../core/validate/order.php');
  $pageTitle = "Dashboard";

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
                  <li class="breadcrumb-item active" aria-current="page">Welcome <?= ucfirst($getCustomer->surname); ?></li>
                </ol>
              </nav>
            </div>
          </div>
          <!--end breadcrumb-->

          <!--start card-->
            <?php include('../includes/card.php'); ?>
          <!--end card-->

            <!--start shop area-->
            <section class="shop-page">
              <?php include('../includes/product-list.php'); ?>
            </section>
            <!--end shop area-->

          </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('../includes/footer.php'); ?>



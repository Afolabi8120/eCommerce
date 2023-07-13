<?php
  require('../core/validate/profile.php');
  $pageTitle = "Set Wallet Pin";

  if(isset($_SESSION['setpin']) AND !empty($_SESSION['setpin']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['setpin']);
    $getSession = $user->getCustomerData($_SESSION['setpin']);

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
                    <li class="breadcrumb-item active" aria-current="page">Set Wallet Pin</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
              <div class="col-lg-12 mx-auto">
                <?php
                  echo ErrorMessage();
                  echo SuccessMessage();
                ?>

                <div class="card radius-10">
                  <div class="card-header fw-bold">
                    Set Wallet Pin <br>
                    <span class="text-danger small fw-normal">You are yet to set your wallet pin</span><br>
                    <span class="text-success small fw-normal">After successfully setting the pin, you will be redirected to your dashboard.</span>
                  </div>
                  <div class="card-body">
                    <form class="form-body row" method="POST">
                      <div class="col-12 mt-2">
                        <label for="inputCPassword" class="form-label">New Pin</label>
                        <input type="password" name="new_pin" class="form-control" id="inputCPassword" placeholder="****" maxlength="4" required>
                      </div>
                      <div class="col-12 mt-2">
                        <label for="inputCPassword" class="form-label">Confirm Pin</label>
                        <input type="password" name="c_pin" class="form-control" id="inputCPassword" placeholder="****" maxlength="4" required>
                      </div>
                      <div class="col-12 mt-2">
                        <input type="submit" class="btn btn-primary btn-md " name="btnSetPin2" value="Set Pin">
                      </div>
                    </form>
                  </div>
              </div>

            </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('../includes/footer.php'); ?>



<?php
  include('../core/init.php');
  $pageTitle = "Track Order";

  if(isset($_SESSION['email']) AND !empty($_SESSION['email']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['email']);
    $getSession = $user->getCustomerData($_SESSION['email']);

    if($_SESSION['session_id'] !== $getSession->session){
      header('location: ../index');
    }else{

      if(!isset($_SESSION['success'])){
        unset($_SESSION['order_payment']);
        header('location: ../home/dashboard');
      }
      
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
                  <li class="breadcrumb-item active" aria-current="page">Track Order</li>
                </ol>
              </nav>
            </div>
          </div>
          <!--end breadcrumb-->

        <!--start shop cart-->
          <section class="shop-page">
            <div class="shop-container">
              <div class="card shadow-sm border-0">
                <div class="card-body">
                  <div class="shop-cart">
                    <div class="row">
                      <div class="col-12 col-xl-12">
                        <div class="checkout-details">
                          <div class="card border-0">
                            <div class="card-body">
                              <div class="steps steps-light">
                                  <a class="step-item active current" href="javascript:;">
                                    <div class="step-progress"><span class="step-count">1</span>
                                    </div>
                                    <div class="step-label"><i class='bx bx-cart'></i>Coming Soon</div>
                                  </a>
                                  <a class="step-item active current" href="javascript:;">
                                    <div class="step-progress"><span class="step-count">2</span>
                                    </div>
                                    <div class="step-label"><i class='bx bx-user-circle'></i>Coming Soon</div>
                                  </a>
                                  <a class="step-item active current" href="javascript:;">
                                    <div class="step-progress"><span class="step-count">3</span>
                                    </div>
                                    <div class="step-label"><i class='bx bx-credit-card'></i>Coming Soon</div>
                                  </a>
                                  <a class="step-item active current" href="javascript:;">
                                    <div class="step-progress"><span class="step-count">4</span>
                                    </div>
                                    <div class="step-label"><i class='bx bx-check-circle'></i>Coming Soon</div>
                                  </a>
                                </div>
                            </div>
                            <div class="card">
                              <div class="card-body text-center">
                                <i class="fa fa-info-circle fa-5x text-info mb-2"></i>
                                <h2 class="h4 pb-3 text-info">Coming Soon!</h2>
                                <a class="btn btn-primary mt-3" href="dashboard">Go back Home</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--end row-->
                  </div>
                </div>
              </div>
            </div>
          </section>
        <!--end shop cart-->

          </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('../includes/footer.php'); ?>



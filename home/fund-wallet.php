<?php
  require('../core/validate/order.php');
  $pageTitle = "Fund Wallet";

  if(isset($_SESSION['email']) AND !empty($_SESSION['email']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['email']);
    $getSession = $user->getCustomerData($_SESSION['email']);

    if($_SESSION['session_id'] !== $getSession->session){
      header('location: ../index');
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
                  <li class="breadcrumb-item active" aria-current="page">Wallet Funding</li>
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
                          <div class="card">
                            <div class="card-header border-bottom">
                              <h2 class="h5">Wallet Funding</h2>
                            </div>
                            <div class="row">
                              <div class="col-xl-6">
                                <div class="card-body">
                                  <div class="p-3 border rounded">
                                    <div class="mb-3">
                                      <p class="mb-3 text-info small">
                                          <strong>Note:</strong> 10% of the amount you want to fund your wallet with will be deducted from your account.
                                          <br>
                                          <span class="text-danger small">Minimum amount to deposit is 5,000 naira</span>
                                      </p>
                                      <p>Wallet Balance:<span class="mb-0 text-dark h5 fw-bold"> ₦ <?= $getCustomer->balance; ?></span>
                                      </p>
                                      <form class="form-body row g-3" method="POST">
                                        <div class="col-12">
                                          <label for="amount" class="form-label">Amount</label>
                                          <input type="tel" class="form-control" onkeyup="getTotal()" name="amount" id="amount" placeholder="2000" required>
                                        </div>
                                        <div class="col-12">
                                          <label for="total" class="form-label">Total Amount</label>
                                          <input type="text" class="form-control payamount" class="total" autocomplete="off" name="total" id="total" placeholder="3000" readonly required>
                                        </div>
                                        <div class="col-12">
                                          <a href="" type="button" data-type="payment" onclick="payWithPaystack('payamount', '<?= $getCustomer->email; ?>', '<?= $getCustomer->surname; ?>')" class="btn btn-md btn-primary">Proceed to Payment</a>
                                          <a href="dashboard" class="btn btn-danger">Back </a>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
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



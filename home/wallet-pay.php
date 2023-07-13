<?php
  require('../core/validate/order.php');
  $pageTitle = "Wallet Pay";

  if(isset($_SESSION['email']) AND !empty($_SESSION['email']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['email']);
    $getSession = $user->getCustomerData($_SESSION['email']);

    if($_SESSION['session_id'] !== $getSession->session){
      header('location: ../index');
    }else{

      if(!isset($_SESSION['wallet-pay'])){
        unset($_SESSION['order_payment']);
        header('location: ../home/checkout-payment');
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
                  <li class="breadcrumb-item active" aria-current="page">Wallet Pay</li>
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
                              <h2 class="h5">Wallet Payment</h2>
                            </div>
                            <div class="row">
                              <div class="col-xl-6">
                                <div class="card-body small">
                                  <div class="p-3 border rounded">
                                    <?php
                                      #$invoiceno = $_SESSION['invoiceno'];
                                      $fetchShippingDetails = $order->fetchShippingAddressDetails($getCustomer->id);
                                    ?>
                                    <p class="mb-2">Full Name: <br><?= ucwords($fetchShippingDetails->surname) . " " . ucwords($fetchShippingDetails->other_name); ?></p>
                                    <p class="mb-2">Email Address: <br><?= $fetchShippingDetails->email; ?></p>
                                    <p class="mb-2">Phone No: <br><?= $fetchShippingDetails->phone; ?></p>
                                    <p class="mb-2">Delivery Address: <br><span class="small"><?= ucwords($fetchShippingDetails->address); ?></span></p>
                                    
                                    <div class="my-3 border-top"></div>
                                    <p class="mb-2">Subtotal: <span class="float-end">₦ <?= $order->getCartSum($getCustomer->id); ?></span>
                                  </p>
                                  <p class="mb-2">Shipping: <span class="float-end">--</span>
                                  </p>
                                  <p class="mb-0">Discount: <span class="float-end">--</span>
                                  </p>
                                  <div class="my-3 border-top"></div>
                                  <h5 class="mb-0">Order Total: <span class="float-end fw-bold">₦ <?= $order->getCartSum($getCustomer->id); ?></span></h5>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-6">
                                <div class="card-body">
                                  <?php
                                    echo ErrorMessage();
                                    echo SuccessMessage();
                                  ?>
                                  <div class="p-3 border rounded">
                                    <div class="mb-3">
                                      <p class="mb-3 text-danger small"><strong>Note:</strong> The order amount would be deducted from your wallet balance, please note that this transaction cannot be reversed.</p>
                                      <p>Wallet Balance:<span class="mb-0 text-dark h5 fw-bold"> ₦ <?= $getCustomer->balance; ?></span></p>
                                      <form class="form-body row g-3" method="POST">
                                        <div class="col-12">
                                          <label for="inputPin" class="form-label">Pin</label>
                                          <input type="hidden" class="form-control" name="amount" value="<?= $order->getCartSum($getCustomer->id); ?>" id="inputPin" readonly required>
                                          <input type="password" class="form-control" autocomplete="off" name="pin" id="inputPin" placeholder="****" maxlength="4" required>
                                        </div>
                                        <div class="col-12">
                                          <label for="inputCPin" class="form-label">Confirm Pin</label>
                                          <input type="password" class="form-control" autocomplete="off" name="cpin" id="inputCPin" placeholder="****" maxlength="4" required>
                                        </div>
                                        <div class="col-12">
                                          <input type="submit" class="btn btn-primary" name="btnPayByWallet" value="Make Payment">
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



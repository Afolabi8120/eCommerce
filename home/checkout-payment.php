<?php
  require('../core/validate/order.php');
  $pageTitle = "Checkout Payment";

  if(isset($_SESSION['email']) AND !empty($_SESSION['email']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['email']);
    $getSession = $user->getCustomerData($_SESSION['email']);

    if($_SESSION['session_id'] !== $getSession->session){
      header('location: ../index');
    }else{

      if(!isset($_SESSION['order_payment'])){
        header('location: ../home/cart');
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
                  <li class="breadcrumb-item active" aria-current="page">Checkout Details</li>
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
                      <div class="col-12 col-xl-8">
                        <div class="checkout-details">
                          <div class="card border-0">
                            <div class="card-body">
                              <div class="steps steps-light">
                                  <a class="step-item active current" href="javascript:;">
                                    <div class="step-progress"><span class="step-count">1</span>
                                    </div>
                                    <div class="step-label"><i class='bx bx-cart'></i>Cart</div>
                                  </a>
                                  <a class="step-item active current" href="javascript:;">
                                    <div class="step-progress"><span class="step-count">2</span>
                                    </div>
                                    <div class="step-label"><i class='bx bx-user-circle'></i>Details</div>
                                  </a>
                                  <a class="step-item active current" href="javascript:;">
                                    <div class="step-progress"><span class="step-count">3</span>
                                    </div>
                                    <div class="step-label"><i class='bx bx-credit-card'></i>Payment</div>
                                  </a>
                                  <a class="step-item" href="javascript:;">
                                    <div class="step-progress"><span class="step-count">4</span>
                                    </div>
                                    <div class="step-label"><i class='bx bx-check-circle'></i>Payment Successful</div>
                                  </a>
                                </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header border-bottom">
                              <h2 class="h5">Choose Payment Method</h2>
                            </div>
                            <div class="card-body">
                              <div class="p-3 border rounded">
                                <form method="POST">
                                    <div class="mb-3">
                                      <p>Select a payment method of your choice</p>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment" id="inlineRadio1" value="1" required>
                                        <label class="form-check-label" for="inlineRadio1">Wallet Balance</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment" id="inlineRadio2" value="2" required>
                                        <label class="form-check-label" for="inlineRadio2">Card Payment</label>
                                      </div>
                                    </div>
                                    <div class="mb-3">
                                      <div class="d-block"> 
                                        <input type="submit" class="btn btn-primary" name="btnProceedToMakePayment" value="Proceed to Make Payment"> 
                                      </div>
                                    </div>
                                    <div class="mb-3">
                                      <p class="mb-0 text-warning small">Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order.</p>
                                    </div>
                                  </div>
                                </form>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="d-grid"><a href="checkout-details" class="btn btn-light btn-ecomm"><i class="bx bx-chevron-left"></i>Back to Shipping</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-xl-4">
                        <div class="order-summary">
                          <div class="card">
                            <div class="card-body">
                              <div class="card">
                                <div class="card-body">
                                  <p class="fs-5">Apply Discount Code</p>
                                  <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter discount code">
                                    <button class="btn btn-primary btn-ecomm" type="button">Apply</button>
                                  </div>
                                </div>
                              </div>
                              <div class="card">
                                <?php include('../includes/order-summary.php'); ?>
                              </div>
                              <div class="card mb-0">
                                <div class="card-body">
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



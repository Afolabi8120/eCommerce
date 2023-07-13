<?php
  require('../core/validate/order.php');
  $pageTitle = "Cart";

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
                  <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
              </nav>
            </div>
          </div>
          <!--end breadcrumb-->

          <!--start shop cart-->
            <section class="shop-page">
              <div class="shop-container">
                <?php
                  echo ErrorMessage();
                  echo SuccessMessage();
                ?>
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <div class="shop-cart">
                      <div class="row">
                        <div class="col-12 col-xl-8">
                          <div class="shop-cart-list">
                            <!-- Cart Items Start -->
                            <?php foreach($order->fetchCartItems($getCustomer->id) as $fetchCartItem): ?>
                            <div class="card">
                              <div class="card-body">
                                <div class="row align-items-center g-2">
                                  <div class="col-12 col-lg-6">
                                    <div class="d-lg-flex align-items-center gap-2">
                                      <div class="cart-img text-center text-lg-start">
                                        <?php
                                          $fetchProduct = $admin->get('tblproducts','id',$fetchCartItem->product_id); // get the product datas by the product id
                                        ?>
                                        <img src="../assets/images/products/<?= $fetchProduct->picture; ?>" width="130" alt="">
                                      </div>
                                      <div class="cart-detail text-center text-lg-start">
                                        <h6 class="mb-2"><?= ucwords($fetchProduct->product_name); ?></h6>
                                        <p class="mb-2 small"><?= $fetchProduct->description; ?></p>
                                        <h5 class="mb-0 fw-bold">₦ <?= $fetchProduct->new_price; ?></h5>
                                      </div>
                                    </div>
                                  </div>
                          
                                  <div class="col-12 col-lg-3">
                                    <form method="POST">
                                    <div class="cart-action text-center">
                                      <div class="input-group">
                                        <input class="btn btn-primary btn-ecomm fw-bold" name="btnDescrease" type="submit" value="-">
                                        <input type="text" name="quantity" readonly class="form-control text-center" value="<?= $fetchCartItem->quantity; ?>">
                                        <input class="btn btn-primary btn-ecomm fw-bold" name="btnIncrease" type="submit" value="+">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12 col-lg-3">
                                    <div class="text-center">
                                      <div class="d-flex gap-2 justify-content-center justify-content-lg-end">
                                        <input type="hidden" name="product_id" readonly class="form-control text-center" value="<?= $fetchCartItem->product_id; ?>">
                                        <input type="hidden" name="cart_id" readonly class="form-control text-center" value="<?= $fetchCartItem->id; ?>">
                                        <input type="submit" name="btnRemoveCartItem" class="btn btn-primary btn-ecomm fw-bold" value="X">
                                      </div>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php endforeach; ?>
                            <!-- Cart Items End -->

                            <?php if(!$order->fetchCartItems($getCustomer->id)): ?>
                            <div class="card">
                              <div class="card-body">
                                <div class="row align-items-center g-2">
                                  <div class="col-12 col-lg-12 " style="text-align: center!important;">
                                    <p class="fw-normal ">Hey, you have no item in your cart</p>
                                    <i class="fa fa-cart-arrow-down fa-5x text-warning"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php endif; ?>

                            <div class="card">
                              <div class="card-body">
                                <div class="d-lg-flex align-items-center gap-3">
                                  <a href="dashboard" class="btn btn-primary btn-ecomm"><i class='bx bx-shopping-bag'></i> Continue Shoping</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-xl-4">
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
                                <div class="my-4"></div>
                                <div class="d-grid"> <a <?php if($order->isCartEmpty($getCustomer->id) === false) { echo "hidden"; } ?> href="checkout-details" class="btn btn-primary btn-ecomm">Proceed to Checkout</a>
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



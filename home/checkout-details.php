<?php
  require('../core/validate/order.php');
  $pageTitle = "Checkout Details";

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
                        <?php
                          echo ErrorMessage();
                          echo SuccessMessage();
                        ?>
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
                                  <a class="step-item" href="javascript:;">
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
                            <div class="card-body">
                              <div class="d-flex align-items-center mb-3">
                                <div class="">
                                  <?php if($getCustomer->picture == ""): ?>
                                    <img src="../assets/images/user/default.jpg" width="80" alt="" class="rounded-circle p-1 shadow-sm">
                                  <?php else: ?>
                                    <img src="../assets/images/user/<?= $getCustomer->picture; ?>" width="80" alt="" class="rounded-circle p-1 shadow-sm">
                                  <?php endif; ?>
                                  </div>
                                <div class="ms-3">
                                  <h6 class="mb-0 small fw-bold"><?= ucwords($getCustomer->surname) . " " . ucwords($getCustomer->other_name); ?></h6>
                                  <p class="mb-0 small"><?= $getCustomer->email; ?></p>
                                </div>
                                <div class="ms-auto"> <a href="profile" class="btn btn-dark btn-ecomm btn-sm">Edit Profile</a>
                                </div>
                              </div>
                              <hr>
                              <div class="">
                                <h2 class="h5 mb-0">Shipping Address</h2>
                                <div class="my-3 border-bottom"></div>
                                <div class="form-body">
                                  <form class="row g-3" method="POST">
                                    <div class="col-md-6">
                                      <label class="form-label">First Name</label>
                                      <input type="text" class="form-control" name="surname" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">Last Name</label>
                                      <input type="text" class="form-control" name="oname" placeholder="Last Name">
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">E-mail Address</label>
                                      <input type="email" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">Phone Number</label>
                                      <input type="text" class="form-control" name="phone" placeholder="Phone No.">
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">Gender</label>
                                      <select class="form-select" name="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">State</label>
                                      <select id="inputState" class="form-control select" name="state">
                                        <option value="Abia State" >Abia State</option>
                                        <option value="Anambra State" >Anambra State</option>
                                        <option value="Bauchi State" >Bauchi State</option>
                                        <option value="Bayelsa State" >Bayelsa State</option>
                                        <option value="Benue State" >Benue State</option>
                                        <option value="Borno State" >Borno State</option>
                                        <option value="Cross River State" >Cross River State</option>
                                        <option value="Delta State" >Delta State</option>
                                        <option value="Enugu State" >Enugu State</option>
                                        <option value="Gombe State" >Gombe State</option>
                                        <option value="Imo State" >Imo State</option>
                                        <option value="Jigawa State" >Jigawa State</option>
                                        <option value="Kastina State" >Kastina State</option>
                                        <option value="Kano State" >Kano State</option>
                                        <option value="Kaduna State" >Kaduna State</option>
                                        <option value="Benin-Kibir State" >Benin-Kibir State</option>
                                        <option value="Kogi State" >Kogi State</option>
                                        <option value="Kwara State" >Kwara State</option>
                                        <option value="Lagos State" >Lagos State</option>
                                        <option value="Nassarawa State" >Nassarawa State</option>
                                        <option value="Niger State" >Niger State</option>
                                        <option value="Ogun State" >Ogun State</option>
                                        <option value="Osun State" >Osun State</option>
                                        <option value="Oyo State" >Oyo State</option>
                                        <option value="Plataeu State" >Plataeu State</option>
                                        <option value="River State" >River State</option>
                                        <option value="Sokoto State" >Sokoto State</option>
                                        <option value="Taraba State" >Taraba State</option>
                                        <option value="F.C.T" >F.C.T</option>
                                      </select>
                                    </div>
                                    <div class="col-md-12">
                                      <label class="form-label">Address </label>
                                      <textarea class="form-control" name="address" placeholder="Your address goes here..."></textarea>
                                    </div>
                                    <div class="col-md-12">
                                      <h6 class="mb-0 h5">OR</h6>
                                      <div class="my-3 border-bottom"></div>
                                      <div class="form-check">
                                        <input class="form-check-input" name="user-info" type="checkbox" id="gridCheck" >
                                        <label class="form-check-label" for="gridCheck">Use my profile details</label>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="d-grid">  <a href="cart" class="btn btn-light btn-ecomm"><i class='bx bx-chevron-left'></i>Back to Cart</a>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="d-grid">  
                                        <input type="submit" class="btn btn-primary btn-ecomm" name="btnProceedToCheckout" value="Proceed to Checkout">
                                      </div>
                                    </div>
                                  </form>
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



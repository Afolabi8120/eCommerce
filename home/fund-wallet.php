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
                                          <strong>Note:</strong> 5% of the amount you want to fund your wallet with will be deducted from your account.
                                          <br>
                                          <span class="text-danger small">Minimum amount to deposit is 5,000 naira</span>
                                      </p>
                                      <p>Wallet Balance:<span class="mb-0 text-dark h5 fw-bold"> ₦ <?= number_format($getCustomer->balance, 00); ?></span>
                                      </p>
                                      <form class="form-body row g-3" method="POST">
                                        <div class="col-12">
                                          <label for="amount" class="form-label">Amount</label>
                                          <input type="tel" class="form-control amount" onkeyup="getTotal()" name="amount" id="amount" placeholder="5000" required>
                                        </div>
                                        <div class="col-12">
                                          <label for="total" class="form-label">Total Amount</label>
                                          <input type="text" class="form-control total" autocomplete="off" name="total" id="total" placeholder="5000" readonly required>
                                        </div>
                                        <div class="col-12">
                                          <a href="" type="button" data-type="payment" onclick="payWithPaystack('payamount', '<?= $getCustomer->email; ?>', '<?= $getCustomer->surname; ?>')" class="btn btn-md btn-primary payamount">Proceed to Payment</a>
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

  <script src="../assets/js/jquery.min.js"></script>
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <script>
        $(document).ready(function() {
            $(document).on('click', '.payamount', function(e) {
                e.preventDefault();

                var amount = $('.amount').val();
                var total = $('.total').val();
                var type = $(this).data('type');
                var email = "<?= $getCustomer->email; ?>";
                var last_name = "<?= $getCustomer->surname; ?>";
                var first_name = "<?= $getCustomer->other_name; ?>";

                if(amount < 5000){
                    alert("Cannot proceed to add payment");
                    return;
                }


                //alert(amount + ' ' + total + ' ' + type + ' ' + email + ' ' + last_name);

                function payWithPaystack(type, email, first_name, last_name){

                    var handler = PaystackPop.setup({
                      key: "<?= PAYMENT_KEY; ?>",
                      email: email,
                      first_name: first_name,
                      last_name: last_name,
                      total: total,
                      mobile: "<?= $getCustomer->phone; ?>",
                      amount: (total) * 100,
                      currency: 'NGN',
                      ref: '<?= date('Ymd') . strtoupper(substr(sha1(uniqid().time()), 3, 10)); ?>',
                      callback: function(response){
                          alert('Your payment reference no is ' + response.reference +'\nYou will be redirect to a page. Please wait for some minutes...');
                          window.location = `${type}_verify?reference=` + response.reference;
                      },
                      onClose: function(){
                        window.location = "fund-wallet?transaction=call";
                        alert('Transaction Cancelled');
                    }
                });
                    handler.openIframe();
                }

                payWithPaystack(type, email, first_name, last_name);

            });
        });
    </script>



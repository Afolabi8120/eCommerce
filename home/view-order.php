<?php
  require('../core/validate/product.php');
  $pageTitle = "View Order";

  if(isset($_SESSION['email']) AND !empty($_SESSION['email']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['email']);
    $getSession = $user->getCustomerData($_SESSION['email']);

    if($_SESSION['session_id'] !== $getSession->session){
      header('location: ../index');
    }else{

      if(isset($_GET['id']) AND !empty($_GET['id'])){
        // check if order id exist
        $order_id = stripcslashes($_GET['id']);
        
        if($admin->checkSingleColumn('tblorder','invoiceno',$order_id)){
          
          $fetchProduct = $admin->selectAll('tblorder','invoiceno',$order_id); // get the product datas by the order id
          $fetchOrderProduct = $admin->get('tblorder_payment','invoiceno',$order_id);
          $fetchTransactionData = $admin->get('tbltransaction','invoiceno',$order_id);
          
          $product_id = $_GET['id'];
        }else{
          header('location: ../dashboard'); // if product id does not exist redirect to product page
        }

      }else{
        header('location: ../dashboard'); // if product id is not found redirect to product page
      }
      
    }
  }else{
    header('location: ../index');
  }

?>
  <?php include('../includes/header2.php'); ?>
  <body>
    

 <!--start wrapper-->
    <div class="wrapper">
       <!--start sidebar wrapper-->
       <?php include('../includes/sidebar2.php'); ?>
       <!--end sidebar wrapper-->

        <!--start top header-->
          <header class="top-header">
            <?php include('../includes/top-header2.php'); ?>
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
                  <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                </ol>
              </nav>
            </div>
          </div>
          <!--end breadcrumb-->

          <div class="col-12 col-lg-12">
            <div class="card radius-10">
              <div class="card-header py-3">
                   <div class="row align-items-center g-3">
                     <div class="col-12 col-lg-6">
                       <h5 class="mb-0">INVOICE DETAILS</h5>
                     </div>
                   </div>
              </div>
              <div class="card-header py-2">
                <div class="row row-cols-1 row-cols-lg-3">
                  <div class="col">
                   <div class="">
                     <small>FROM:</small>
                     <address class="m-t-5 m-b-5">
                        <strong class="text-inverse"><?= ucwords($fetchOrderProduct->surname) . " " . ucwords($fetchOrderProduct->other_name); ?></strong><br>
                        Phone: <?= $fetchOrderProduct->phone; ?><br>
                        State: <?= $fetchOrderProduct->state; ?> <br>
                        Street Address:<br>
                        <?= $fetchOrderProduct->address; ?>
                     </address>
                    </div>
                 </div>
                 <div class="col">
                   <div class="">
                     <small>Invoice Details</small>
                     <div class=""><b>Invoice: <?= $fetchOrderProduct->invoiceno; ?></b></div>
                     <div class="">Date Paid: <?= $fetchOrderProduct->date_paid; ?></div>
                     <div class="">Payment Type: <?= $fetchTransactionData->service_type; ?></div>
                     <div class="">
                      Payment Status: 
                        <?php if($fetchOrderProduct->payment_status == "1"): ?>
                          <span class="badge bg-success">Paid</span>
                        <?php elseif($fetchOrderProduct->payment_status == "0"): ?>
                          <span class="badge bg-danger">Not Paid</span>
                        <?php endif; ?>
                     </div>
                     <div class="">
                      Order Status: 
                        <?php if($fetchOrderProduct->order_status == "1"): ?>
                          <span class="badge bg-success">Approved</span>
                        <?php elseif($fetchOrderProduct->order_status == "0"): ?>
                          <span class="badge bg-warning">Pending</span>
                        <?php elseif($fetchOrderProduct->order_status == "2"): ?>
                          <span class="badge bg-danger">Declined</span>
                        <?php endif; ?>
                     </div>
                   </div>
                 </div>
                </div>
              </div>
             <div class="card-body">
               <div class="table-responsive">
                 <table class="table table-invoice">
                    <thead>
                       <tr>
                          <th>ITEM DESCRIPTION</th>
                          <th class="text-center" width="10%">PRICE</th>
                          <th class="text-center" width="10%">QUANTITY</th>
                          <th class="text-right" width="20%">TOTAL</th>
                       </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1; foreach($fetchProduct as $fetchOrder): 

                            $getProductInfo = $admin->get('tblproducts','id',$fetchOrder->product_id);
                            #var_dump($getProductInfo);exit();
                        ?>

                        <tr>
                          <td>
                             <img src="../../assets/images/products/<?= $getProductInfo->picture; ?>" class="img-fluid" alt="..." height="60" width="60">
                             <small>
                              <?= $getProductInfo->description; ?>
                             </small>
                          </td>
                          <td class="text-center">₦ <?= $fetchOrder->price; ?></td>
                          <td class="text-center"><?= $fetchOrder->quantity; ?></td>
                          <td class="text-right">₦ <?= $fetchOrder->total; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                 </table>
              </div>

              <div class="row bg-light align-items-center m-0">
                <div class="col col-auto p-4">
                   <p class="mb-0">SUBTOTAL</p>
                   <h4 class="mb-0">₦ <?= $admin->Sum($getCustomer->id,$order_id) ?></h4>
                </div>
                <div class="col col-auto p-4">
                   <i class="bi bi-plus-lg text-muted"></i>
                </div>
                <div class="col col-auto me-auto p-4">
                   <p class="mb-0">SHIPPING FEE</p>
                   <h4 class="mb-0">₦ 108.00</h4>
                </div>
                <div class="col bg-primary col-auto p-4">
                 <p class="mb-0 text-white">TOTAL</p>
                 <h4 class="mb-0 text-white">₦ <?= $admin->Sum($getCustomer->id,$order_id) ?></h4>
                </div>
              </div><!--end row-->

            </div>

          </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('../includes/footer2.php'); ?>



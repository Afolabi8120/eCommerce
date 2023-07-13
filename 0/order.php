<?php
  include('../core/init.php');
  $pageTitle = "Orders";

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
                    <li class="breadcrumb-item active" aria-current="page">Order History</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    Order History
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered mt-3">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Invoice No</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; foreach($admin->select('tblorder_payment') as $fetchOrder): ?>
                          <tr>
                            <td><?= $i++; ?></td>
                            <td><a href="<?= $fetchOrder->invoiceno; ?>"><?= $fetchOrder->invoiceno; ?></a></td>
                            <td><?= $fetchOrder->amount; ?></td>
                            <td><?= $fetchOrder->date_paid; ?></td>
                            <td>
                              <?php if($fetchOrder->payment_status == "1"): ?>
                                <span class="badge bg-success">Paid</span>
                              <?php elseif($fetchOrder->payment_status == "0"): ?>
                                <span class="badge bg-danger">Not Paid</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if($fetchOrder->order_status == "1"): ?>
                                <span class="badge bg-success">Approved</span>
                              <?php elseif($fetchOrder->order_status == "0"): ?>
                                <span class="badge bg-warning">Pending</span>
                              <?php endif; ?>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('../includes/footer.php'); ?>



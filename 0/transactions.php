<?php
  include('../core/init.php');
  $pageTitle = "Transactions";

  if(isset($_SESSION['admin']) AND !empty($_SESSION['admin']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['admin']);
    $getSession = $user->getCustomerData($_SESSION['admin']);

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
                    <li class="breadcrumb-item active" aria-current="page">Transaction History</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    Transactions
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered mt-3">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Invoice No</th>
                            <th>Service Type</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($admin->select('tbltransaction') as $fetchTransaction): ?>
                          <tr class="small">
                            <td><?= $i++; ?></td>
                            <td><?= $fetchTransaction->invoiceno; ?></td>
                            <td><?= $fetchTransaction->service_type; ?></td>
                            <td><span class="small"><?= $fetchTransaction->description; ?></span></td>
                            <td>
                                <?= $fetchTransaction->amount; ?>
                            </td>
                            <td>
                                <p>
                                  Old Balance: <?= $fetchTransaction->oldbalance; ?> <br>
                                  New Balance: <?= $fetchTransaction->newbalance; ?>
                                </p>
                            </td>
                            <td><span class="badge bg-dark"><?= $fetchTransaction->date; ?></span></td>
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



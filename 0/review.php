<?php
  require('../core/validate/product.php');
  $pageTitle = "Reviews";

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
                    <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
              <?php
                echo ErrorMessage();
                echo SuccessMessage();
              ?>
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    Reviews
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered mt-3">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Review</th>
                            <th>Date Review</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($admin->selectAll('tblreview','status','0') as $getReview): ?>
                          <tr class="small">
                            <td><?= $i++; ?></td>
                            <td>
                              <?php
                                $pName = $admin->get('tblproducts','id',$getReview->product_id);
                                #var_dump($pName);exit();
                                echo ucwords($pName->product_name);
                              ?>
                                
                            </td>
                            <td>
                              <?php
                                $cusName = $admin->get('tblcustomer','id',$getReview->customer_id);
                                echo ucwords($cusName->surname) . " " . ucwords($cusName->other_name);
                              ?>
                            </td>
                            <td><span class="small pre"><?= $getReview->review; ?></span></td>
                            <td><span class="badge bg-dark"><?= $getReview->date_reviewed; ?></span></td>
                            <td>
                              <?php if($getReview->status == "0"): ?>
                              <form method="POST">
                                <input type="hidden" class="form-control" name="review_id" value="<?= $getReview->id; ?>" readonly>
                                <input type="submit" class="btn btn-success btn-sm" onclick="return confirm('Approve this Review?')" value="Approve" name="btnApproveReview">
                                <input type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this Review?')" value="Delete" name="btnDeleteReview">
                              </form>
                              <?php elseif($getReview->status == "1"): ?>
                              <form method="POST">
                                <input type="hidden" class="form-control" name="review_id" value="<?= $getReview->id; ?>" readonly>
                                <input type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Reject this Review?')" value="Reject" name="btnRejectReview">
                                <input type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this Review?')" value="Delete" name="btnDeleteReview">
                              </form>
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



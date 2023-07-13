<?php
  require('../core/validate/customer.php');
  $pageTitle = "Customer List";

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
                    <li class="breadcrumb-item active" aria-current="page">Customer's List</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
              <div class="col-md-12">
                <?php
                  echo ErrorMessage();
                  echo SuccessMessage();
                ?>
                <div class="card">
                  <div class="card-header">
                    Customer's List
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered mt-3">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; foreach($admin->selectAll('tblcustomer','usertype','customer') as $fetchCustomer): ?>
                          <tr>
                            <td><?= $i++; ?></td>
                            <td><?= ucwords($fetchCustomer->surname . " " . $fetchCustomer->other_name); ?></td>
                            <td><?= $fetchCustomer->email; ?></td>
                            <td><?= $fetchCustomer->phone; ?></td>
                            <td>
                              <?php if($fetchCustomer->status == "active"): ?>
                                <span class="badge bg-success">Active</span>
                              <?php elseif($fetchCustomer->status == "in-active"): ?>
                                <span class="badge bg-danger">In-active</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if($fetchCustomer->status == "active"): ?>
                              <form method="POST">
                                <input type="hidden" class="form-control" name="customer_id" value="<?= $fetchCustomer->id; ?>" readonly>
                                <input type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Disable this Customer Account?')" value="Disable" name="btnDisableCustomer">
                              </form>
                              <?php elseif($fetchCustomer->status == "in-active"): ?>
                              <form method="POST">
                                <input type="hidden" class="form-control" name="customer_id" value="<?= $fetchCustomer->id; ?>" readonly>
                                <input type="submit" class="btn btn-success btn-sm" onclick="return confirm('Enable this Customer Account?')" value="Enable" name="btnEnableCustomer">
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



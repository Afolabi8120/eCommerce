<?php
  require('../core/validate/category.php');
  $pageTitle = "Category";

  if(isset($_SESSION['admin']) AND !empty($_SESSION['admin']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['admin']);
    $getSession = $user->getCustomerData($_SESSION['admin']);

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
                    <li class="breadcrumb-item active" aria-current="page">Category</li>
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
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">Add Category</div>
                  <div class="card-body">
                    <form class="form-body row g-3" method="POST">
                      <div class="col-12">
                        <label for="inputName" class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Mens Clothe" >
                      </div>
                      <div class="col-12">
                        <input type="submit" class="btn btn-primary btn-md " name="btnSaveCategory" value="Save">
                      <a href="dashboard" class="btn btn-danger btn-md">Back</a>
                      </div>
                      
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">All Categories</div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered mt-3">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Category Name</th>
                            <th>Date Added</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; foreach($admin->select('tblcategory') as $fetchCategory): ?>
                          <tr>
                            <td><?= $i++; ?></td>
                            <td><?= ucwords($fetchCategory->cat_name); ?></td>
                            <td>
                              <span class="badge bg-dark"><?= $fetchCategory->added_date; ?></span>
                            </td>
                            <td>
                              <a href="edit_category/<?= $fetchCategory->id; ?>" class="btn btn-warning btn-sm">Edit</a>
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



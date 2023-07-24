<?php
  require('../core/validate/category.php');
  $pageTitle = "Edit Category";

  if(isset($_SESSION['admin']) AND !empty($_SESSION['admin']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['admin']);
    $getSession = $user->getCustomerData($_SESSION['admin']);

    if($_SESSION['session_id'] !== $getSession->session){
      header('location: ../index');
    }else{

      if(isset($_GET['id']) AND !empty($_GET['id'])){
        // check if category id exist
        $_GET['id'] = stripcslashes($_GET['id']);
        if($admin->checkSingleColumn('tblcategory','id',$_GET['id'])){
          
          $fetchCategory = $admin->get('tblcategory','id',$_GET['id']); // get the category datas by the category id
          $category_id = $_GET['id'];
        }else{
          header('location: ../category'); // if category id does not exist redirect to category page
        }

      }else{
        header('location: ../category'); // if category id is not found redirect to category page
      }
      
    }
  }else{
    header('location: ../index');
  }

?>
  <?php include('./../includes/header2.php'); ?>
  <body>
    

 <!--start wrapper-->
    <div class="wrapper">
       <!--start sidebar wrapper-->
       <?php include('./../includes/sidebar2.php'); ?>
       <!--end sidebar wrapper-->

        <!--start top header-->
          <header class="top-header">
            <?php include('./../includes/top-header2.php'); ?>
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
                  <div class="card-header">Edit Category</div>
                  <div class="card-body">
                    <form class="form-body row g-3" method="POST" action="#">
                      <div class="col-12">
                        <label for="inputName" class="form-label">Category Name</label>
                        <input type="hidden" class="form-control" name="cat_id" id="inputName" value="<?= $category_id; ?>" placeholder="Mens Clothe" readonly>
                        <input type="text" class="form-control" name="name" id="inputName" value="<?= $fetchCategory->cat_name; ?>" placeholder="Mens Clothe" required>
                      </div>
                      <div class="col-12">
                        <input type="submit" class="btn btn-primary btn-md " name="btnUpdateCategory" value="Update">
                      <a href="../category" class="btn btn-danger btn-md">Back</a>
                      </div>
                      
                    </form>
                  </div>
                </div>
              </div>
            </div>

        </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('./../includes/footer2.php'); ?>



<?php
  require('../core/validate/product.php');
  $pageTitle = "Product";

  if(isset($_SESSION['email']) AND !empty($_SESSION['email']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['email']);
    $getSession = $user->getCustomerData($_SESSION['email']);

    if($_SESSION['session_id'] !== $getSession->session){
      header('location: ../index');
    }else{

      if(isset($_GET['id']) AND !empty($_GET['id'])){
        // check if product id exist
        $_GET['id'] = stripcslashes($_GET['id']);
        if($admin->checkSingleColumn('tblproducts','id',$_GET['id'])){
          
          $fetchProduct = $admin->get('tblproducts','id',$_GET['id']); // get the product datas by the product id
          $product_id = $_GET['id'];
        }else{
          header('location: ../product'); // if product id does not exist redirect to product page
        }

      }else{
        header('location: ../product'); // if product id is not found redirect to product page
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                    Edit Product
                  </div>
                  <div class="card-body">
                    <form class="form-body row g-3" method="POST" enctype="multipart/form-data">
                      <div class="col-5">
                        <label for="inputName" class="form-label">Product Name</label>
                        <input type="hidden" class="form-control" name="pid" id="inputName" value="<?= $product_id; ?>" placeholder="Mens Clothe" readonly>
                        <input type="text" name="pname" class="form-control" id="inputName" placeholder="Gucci Cap" value="<?= ucwords($fetchProduct->product_name); ?>" required>
                      </div>
                      <div class="col-3">
                        <label for="inputName" class="form-label">Category Name</label>
                        <select class="form-control select" name="cat_id">
                          <?php foreach($admin->select('tblcategory') as $fetchCategory): ?>
                            <option value="<?= $fetchCategory->id; ?>" <?php if($fetchProduct->category_id == $fetchCategory->id) echo "selected"; ?>><?= ucwords($fetchCategory->cat_name); ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-4">
                        <label for="inputSKU" class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control" id="inputSKU" placeholder="PRO-748484" value="<?= $fetchProduct->sku; ?>" required>
                      </div>
                      <div class="col-2">
                        <label for="inputOldPrice" class="form-label">Old Price</label>
                        <input type="number" name="old_price" class="form-control" id="inputOldPrice" placeholder="400" value="<?= $fetchProduct->old_price; ?>" required>
                      </div>
                      <div class="col-2">
                        <label for="inputNewPrice" class="form-label">New Price</label>
                        <input type="number" name="new_price" class="form-control" id="inputNewPrice" placeholder="400" value="<?= $fetchProduct->new_price; ?>" required>
                      </div>
                      <div class="col-2">
                        <label for="inputStock" class="form-label">Available Stock</label>
                        <input type="number" name="stock" class="form-control" id="inputStock" placeholder="400" value="<?= $fetchProduct->stock; ?>" required>
                      </div>
                      <!-- <div class="col-4">
                        <label for="inputImage" class="form-label">Product Image <span class="small text-info">you can select more than one image</span></label>
                        <input type="file" name="product_image[]" class="form-control" id="inputImage" placeholder="400" multiple required>
                      </div> -->
                      <div class="col-12">
                        <label for="inputDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="inputDescription" placeholder="The product description goes here..." required><?= $fetchProduct->description; ?></textarea>
                      </div>
                      <div class="col-12">
                        <input type="submit" class="btn btn-primary btn-md " name="btnUpdateProduct" value="Update Product">
                        <a href="../product" class="btn btn-danger btn-md">Back</a>
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

  <?php include('../includes/footer2.php'); ?>



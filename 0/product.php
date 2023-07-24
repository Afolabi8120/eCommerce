<?php
  require('../core/validate/product.php');
  $pageTitle = "Product";

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
                    <li class="breadcrumb-item active" aria-current="page">All Product</li>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal">Add Product</button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered mt-3">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Product Name</th>
                            <th>Prices </th>
                            <th>SKU</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; foreach($admin->select('tblproducts') as $fetchProduct): ?>
                          <tr>
                            <td><?= $i++; ?></td>
                            <td><?= ucwords($fetchProduct->product_name); ?></td>
                            <td>
                              <span>Old Price: </span><?= $fetchProduct->old_price; ?> <br>
                              <span>New Price: </span><?= $fetchProduct->new_price; ?>
                            </td>
                            <td><?= $fetchProduct->sku; ?></td>
                            <td><span class="badge bg-info"><?= $fetchProduct->stock; ?></span></td>
                            <td>
                              <?php if($fetchProduct->status == "1"): ?>
                                <span class="badge bg-success">Available</span>
                              <?php elseif($fetchProduct->status == "0"): ?>
                                <span class="badge bg-danger">Not Available</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <span class="badge bg-dark"><?= $fetchProduct->added_date; ?></span>
                            </td>
                            <td>
                              <span class="badge bg-dark"><?= $fetchProduct->updated_date; ?></span>
                            </td>
                            <td>
                              <?php if($fetchProduct->status == "1"): ?>
                              <form method="POST">
                                <a href="edit_product/<?= $fetchProduct->id; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <input type="hidden" class="form-control" name="product_id" value="<?= $fetchProduct->id; ?>" readonly>
                                <input type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deactivate this Product?')" value="Disable" name="btnDisableProduct">
                              </form>
                              <?php elseif($fetchProduct->status == "0"): ?>
                              <form method="POST">
                                <a href="edit_product/<?= $fetchProduct->id; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <input type="hidden" class="form-control" name="product_id" value="<?= $fetchProduct->id; ?>" readonly>
                                <input type="submit" class="btn btn-success btn-sm" onclick="return confirm('Activate this Product?')" value="Enable" name="btnEnableProduct">
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

            <!-- Add Product -->
            <div class="modal fade" id="exampleExtraLargeModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="form-body row g-3" method="POST" enctype="multipart/form-data">
                      <div class="col-5">
                        <label for="inputName" class="form-label">Product Name</label>
                        <input type="text" name="pname" class="form-control" id="inputName" placeholder="Gucci Cap" required>
                      </div>
                      <div class="col-3">
                        <label for="inputName" class="form-label">Category Name</label>
                        <select class="form-control select" name="cat_id">
                          <option value="" disabled>Select Category</option>
                          <?php foreach($admin->select('tblcategory') as $fetchCategory): ?>
                            <option value="<?= $fetchCategory->id; ?>"><?= ucwords($fetchCategory->cat_name); ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-4">
                        <label for="inputSKU" class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control" id="inputSKU" placeholder="PRO-748484" required>
                      </div>
                      <div class="col-2">
                        <label for="inputOldPrice" class="form-label">Old Price</label>
                        <input type="number" name="old_price" class="form-control" id="inputOldPrice" placeholder="400" required>
                      </div>
                      <div class="col-2">
                        <label for="inputNewPrice" class="form-label">New Price</label>
                        <input type="number" name="new_price" class="form-control" id="inputNewPrice" placeholder="400" required>
                      </div>
                      <div class="col-2">
                        <label for="inputStock" class="form-label">Available Stock</label>
                        <input type="number" name="stock" class="form-control" id="inputStock" placeholder="400" required>
                      </div>
                      <div class="col-4">
                        <label for="inputImage" class="form-label">Product Image <span class="small text-info">you can select more than one image</span></label>
                        <input type="file" name="product_image[]" class="form-control" id="inputImage" placeholder="400" multiple required>
                      </div>
                      <div class="col-12">
                        <label for="inputDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="inputDescription" placeholder="The product description goes here..." required></textarea>
                      </div>
                      <div class="col-12">
                        <input type="submit" class="btn btn-primary btn-md " name="btnAddProduct" value="Save Product">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Edit Product -->
            <div class="modal fade" id="editProduct" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="form-body row g-3" method="POST" enctype="multipart/form-data">
                      <div class="col-5">
                        <label for="inputName" class="form-label">Product Name</label>
                        <input type="text" name="pname" class="form-control" id="inputName" placeholder="Gucci Cap" value="" required>
                      </div>
                      <div class="col-3">
                        <label for="inputName" class="form-label">Category Name</label>
                        <select class="form-control select" name="cat_id">
                          <option value="" disabled>Select Category</option>
                          <?php foreach($admin->select('tblcategory') as $fetchCategory): ?>
                            <option value="<?= $fetchCategory->id; ?>"><?= ucwords($fetchCategory->cat_name); ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-4">
                        <label for="inputSKU" class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control" id="inputSKU" placeholder="PRO-748484" required>
                      </div>
                      <div class="col-2">
                        <label for="inputOldPrice" class="form-label">Old Price</label>
                        <input type="number" name="old_price" class="form-control" id="inputOldPrice" placeholder="400" required>
                      </div>
                      <div class="col-2">
                        <label for="inputNewPrice" class="form-label">New Price</label>
                        <input type="number" name="new_price" class="form-control" id="inputNewPrice" placeholder="400" required>
                      </div>
                      <div class="col-2">
                        <label for="inputStock" class="form-label">Available Stock</label>
                        <input type="number" name="stock" class="form-control" id="inputStock" placeholder="400" required>
                      </div>
                      <div class="col-4">
                        <label for="inputImage" class="form-label">Product Image <span class="small text-info">you can select more than one image</span></label>
                        <input type="file" name="product_image[]" class="form-control" id="inputImage" placeholder="400" multiple required>
                      </div>
                      <div class="col-12">
                        <label for="inputDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="inputDescription" placeholder="The product description goes here..." required></textarea>
                      </div>
                      <div class="col-12">
                        <input type="submit" class="btn btn-primary btn-md " name="btnUpdateProduct" value="Update Product">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

        </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('../includes/footer.php'); ?>



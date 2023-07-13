<?php
  include('../core/init.php');
  $pageTitle = "Dashboard";

  if(isset($_SESSION['email']) AND !empty($_SESSION['email']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['email']);
    $getSession = $user->getCustomerData($_SESSION['email']);

    if($_SESSION['session_id'] !== $getSession->session){
      header('location: ../index');
    }else{
      unset($_SESSION['invoiceno']);
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
                  <li class="breadcrumb-item active" aria-current="page">Welcome Afolabi</li>
                </ol>
              </nav>
            </div>
          </div>
          <!--end breadcrumb-->

          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-3">
            <!-- Top Card Info Start -->
            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="widget-icon-2 bg-gradient-info text-white">
                      <i class="fa fa-receipt"></i>
                    </div>
                    <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
                  </div>
                  <h5 class="my-3">Total Orders</h5>
                  <p class="mb-0 mt-2 h4 fw-bold"><?= $admin->countSingle('tblorder_payment'); ?></p>
                </div>
              </div>
             </div>
             <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="widget-icon-2 bg-gradient-danger text-white">
                      <i class="fa fa-users"></i>
                    </div>
                    <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
                  </div>
                  <h5 class="my-3">Total Customers</h5>
                  <p class="mb-0 mt-2 h4 fw-bold"><?= $admin->count('tblcustomer','usertype','customer'); ?></p>
                </div>
              </div>
             </div>
             <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="widget-icon-2 bg-gradient-success text-white">
                      <i class="fa fa-bookmark"></i>
                    </div>
                    <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
                  </div>
                  <h5 class="my-3">Categories</h5>
                  <p class="mb-0 mt-2 h4 fw-bold"><?= $admin->countSingle('tblcategory','cat_name'); ?></p>
                </div>
              </div>
             </div>
             <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="widget-icon-2 bg-gradient-purple text-white">
                      <i class="fa fa-box"></i>
                    </div>
                    <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
                  </div>
                  <h5 class="my-3">Products</h5>
                  <p class="mb-0 mt-2 h4 fw-bold"><?= $admin->countSingle('tblproducts','product_name'); ?></p>
                </div>
              </div>
             </div>
             <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="widget-icon-2 bg-gradient-branding text-white">
                      <i class="fa fa-check-circle"></i>
                    </div>
                    <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
                  </div>
                  <h5 class="my-3">Approved Orders</h5>
                  <p class="mb-0 mt-2 h4 fw-bold"><?= $admin->countSingle('tblproducts','product_name'); ?></p>
                </div>
              </div>
             </div>
             <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="widget-icon-2 bg-gradient-warning text-white">
                      <i class="fa fa-info"></i>
                    </div>
                    <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
                  </div>
                  <h5 class="my-3">Pending Orders</h5>
                  <p class="mb-0 mt-2 h4 fw-bold"><?= $admin->countSingle('tblproducts','product_name'); ?></p>
                </div>
              </div>
             </div>
            </div>
            <!-- Top Card Info Ends -->

            <!-- Chart Start -->
            <div class="card radius-10 overflow-hidden w-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <h6 class="mb-0">Monthly Orders</h6>
                  <div class="dropdown options ms-auto">
                    <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                      <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                    </div>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                </div>
                <div class="chart-container1">
                  <canvas id="chart1"></canvas>
                </div>
              </div>
            </div>
            <!-- Chart Ends -->

            <div class="row">
              <div class="col-12 col-lg-12 col-xl-6">
                <div class="card radius-10 w-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <h6 class="mb-0">Top Categories</h6>
                      <div class="dropdown options ms-auto">
                        <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                          <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                        </div>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                          <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                          <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-3 mt-2 align-items-center">
                      <div class="col-lg-7 col-xl-7 col-xxl-8">
                        <div class="chart-container6">
                           <div class="piechart-legend">
                              <h2 class="mb-1">68%</h2>
                              <h6 class="mb-0">Total Sales</h6>
                           </div>
                          <canvas id="chart2"></canvas>
                        </div>
                      </div>
                      <div class="col-lg-5 col-xl-5 col-xxl-4">
                        <div class="">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 d-flex align-items-center gap-2">
                              <ion-icon name="ellipse-sharp" class="text-info"></ion-icon><span>Electronics</span>
                            </li>
                            <li class="list-group-item border-0 d-flex align-items-center gap-2">
                              <ion-icon name="ellipse-sharp" class="text-danger"></ion-icon><span>Furniture</span>
                            </li>
                            <li class="list-group-item border-0 d-flex align-items-center gap-2">
                              <ion-icon name="ellipse-sharp" class="text-success"></ion-icon><span>Fashion</span>
                            </li>
                            <li class="list-group-item border-0 d-flex align-items-center gap-2">
                              <ion-icon name="ellipse-sharp" class="text-primary"></ion-icon><span>Accessories</span>
                            </li>
                            <li class="list-group-item border-0 d-flex align-items-center gap-2">
                              <ion-icon name="ellipse-sharp" class="text-warning"></ion-icon><span>Mobiles</span>
                            </li>
                          </ul>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
               </div>
               <div class="col-12 col-lg-12 col-xl-6">
                <div class="card radius-10 w-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <h6 class="mb-0">Customers</h6>
                      <div class="dropdown options ms-auto">
                        <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                          <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                        </div>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                          <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                          <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-3 mt-2 align-items-center">
                      <div class="col-lg-7 col-xl-7 col-xxl-7">
                        <div class="chart-container6">
                           <div class="piechart-legend">
                              <h2 class="mb-1">48K</h2>
                              <h6 class="mb-0">Customers</h6>
                           </div>
                          <canvas id="chart3"></canvas>
                        </div>
                      </div>
                      <div class="col-lg-5 col-xl-5 col-xxl-5">
                        <div class="">
                          <div class="d-flex align-items-start gap-2 mb-3">
                            <div><ion-icon name="ellipse-sharp" class="text-info"></ion-icon></div>
                            <div>
                              <p class="mb-1">Current Customers</p>
                              <p class="mb-0 h5">66%</p>
                            </div>
                          </div>
                          <div class="d-flex align-items-start gap-2 mb-3">
                            <div><ion-icon name="ellipse-sharp" class="text-danger"></ion-icon></div>
                            <div>
                              <p class="mb-1">New Customers</p>
                              <p class="mb-0 h5">48%</p>
                            </div>
                          </div>
                          <div class="d-flex align-items-start gap-2">
                            <div><ion-icon name="ellipse-sharp" class="text-success"></ion-icon></div>
                            <div>
                              <p class="mb-1">Retargeted Customers</p>
                              <p class="mb-0 h5">25%</p>
                            </div>
                          </div>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
               </div>
            </div><!--end row-->


             <div class="card radius-10">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h6 class="mb-0">Recent Orders</h6>
                  <div class="fs-5 ms-auto dropdown">
                     <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div></div>
                       <ul class="dropdown-menu">
                         <li><a class="dropdown-item" href="#">Action</a></li>
                         <li><a class="dropdown-item" href="#">Another action</a></li>
                         <li><hr class="dropdown-divider"></li>
                         <li><a class="dropdown-item" href="#">Something else here</a></li>
                       </ul>
                   </div>
                 </div>
                 <div class="table-responsive mt-2">
                  <table class="table align-middle mb-0">
                    <thead class="table-light">
                      <tr>
                        <th>#ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>#89742</td>
                        <td>
                          <div class="d-flex align-items-center gap-3">
                            <div class="product-box border">
                               <img src="assets/images/products/11.png" alt="">
                            </div>
                            <div class="product-info">
                              <h6 class="product-name mb-1">Smart Mobile Phone</h6>
                            </div>
                          </div>
                        </td>
                        <td>2</td>
                        <td>$214</td>
                        <td><span class="badge alert-success">Completed</span></td>
                        <td>Apr 8, 2021</td>
                        <td>
                          <div class="d-flex align-items-center gap-3 fs-6">
                            <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><ion-icon name="eye-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><ion-icon name="pencil-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>#68570</td>
                        <td>
                          <div class="d-flex align-items-center gap-3">
                            <div class="product-box border">
                               <img src="assets/images/products/07.png" alt="">
                            </div>
                            <div class="product-info">
                              <h6 class="product-name mb-1">Sports Time Watch</h6>
                            </div>
                          </div>
                        </td>
                        <td>1</td>
                        <td>$185</td>
                        <td><span class="badge alert-success">Completed</span></td>
                        <td>Apr 9, 2021</td>
                        <td>
                          <div class="d-flex align-items-center gap-3 fs-6">
                            <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><ion-icon name="eye-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><ion-icon name="pencil-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>#38567</td>
                        <td>
                          <div class="d-flex align-items-center gap-3">
                            <div class="product-box border">
                               <img src="assets/images/products/17.png" alt="">
                            </div>
                            <div class="product-info">
                              <h6 class="product-name mb-1">Women Red Heals</h6>
                            </div>
                          </div>
                        </td>
                        <td>3</td>
                        <td>$356</td>
                        <td><span class="badge alert-danger">Cancelled</span></td>
                        <td>Apr 10, 2021</td>
                        <td>
                          <div class="d-flex align-items-center gap-3 fs-6">
                            <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><ion-icon name="eye-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><ion-icon name="pencil-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>#48572</td>
                        <td>
                          <div class="d-flex align-items-center gap-3">
                            <div class="product-box border">
                               <img src="assets/images/products/04.png" alt="">
                            </div>
                            <div class="product-info">
                              <h6 class="product-name mb-1">Yellow Winter Jacket</h6>
                            </div>
                          </div>
                        </td>
                        <td>1</td>
                        <td>$149</td>
                        <td><span class="badge alert-success">Completed</span></td>
                        <td>Apr 11, 2021</td>
                        <td>
                          <div class="d-flex align-items-center gap-3 fs-6">
                            <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><ion-icon name="eye-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><ion-icon name="pencil-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>#96857</td>
                        <td>
                          <div class="d-flex align-items-center gap-3">
                            <div class="product-box border">
                               <img src="assets/images/products/10.png" alt="">
                            </div>
                            <div class="product-info">
                              <h6 class="product-name mb-1">Orange Micro Headphone</h6>
                            </div>
                          </div>
                        </td>
                        <td>2</td>
                        <td>$199</td>
                        <td><span class="badge alert-danger">Cancelled</span></td>
                        <td>Apr 15, 2021</td>
                        <td>
                          <div class="d-flex align-items-center gap-3 fs-6">
                            <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><ion-icon name="eye-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><ion-icon name="pencil-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>#96857</td>
                        <td>
                          <div class="d-flex align-items-center gap-3">
                            <div class="product-box border">
                               <img src="assets/images/products/12.png" alt="">
                            </div>
                            <div class="product-info">
                              <h6 class="product-name mb-1">Pro Samsung Laptop</h6>
                            </div>
                          </div>
                        </td>
                        <td>1</td>
                        <td>$699</td>
                        <td><span class="badge alert-warning">Pending</span></td>
                        <td>Apr 18, 2021</td>
                        <td>
                          <div class="d-flex align-items-center gap-3 fs-6">
                            <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><ion-icon name="eye-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><ion-icon name="pencil-sharp"></ion-icon></a>
                            <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><ion-icon name="trash-sharp"></ion-icon></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('../includes/footer.php'); ?>



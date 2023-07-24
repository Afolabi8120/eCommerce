<?php
  require('../core/validate/product.php');
  $pageTitle = "Product Details";

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
                  <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                </ol>
              </nav>
            </div>
          </div>
          <!--end breadcrumb-->

            <!--start product detail-->
            <section class="shop-page">
              <div class="shop-container">

                <div class="card shadow-sm border-0">
                  <div class="card-body">
                     
                    <div class="product-detail-card">
                      <div class="product-detail-body">
                        <div class="row g-0">
                          <div class="col-12 col-lg-5">
                            <div class="image-zoom-section">
                              <div class="product-gallery owl-carousel owl-theme border rounded mb-3 p-3" data-slider-id="1">
                                <?php foreach($admin->selectAll('tblproduct_image','product_id',$fetchProduct->id) as $fetchProductImage): ?>
                                  <div class="item">
                                    <img src="../../assets/images/products/<?= $fetchProductImage->picture; ?>" class="img-fluid" alt="">
                                  </div>
                                <?php endforeach; ?>
                              </div>
                              <div class="owl-thumbs d-flex justify-content-center mb-4" data-slider-id="1">
                                <?php foreach($admin->selectAll('tblproduct_image','product_id',$fetchProduct->id) as $fetchProductImage): ?>
                                <button class="owl-thumb-item">
                                  <img src="../../assets/images/products/<?= $fetchProductImage->picture; ?>" class="" alt="">
                                </button>
                                <?php endforeach; ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-lg-7">
                            <div class="product-info-section p-3">
                              <form method="POST">
                              <h3 class="mt-3 mt-lg-0 mb-0 fw-bold"><?= ucwords($fetchProduct->product_name); ?></h3>
                              <div class="product-rating d-flex align-items-center mt-2">
                                <div class="rates cursor-pointer font-13">  <i class="bx bxs-star text-warning"></i>
                                  <i class="bx bxs-star text-warning"></i>
                                  <i class="bx bxs-star text-warning"></i>
                                  <i class="bx bxs-star text-warning"></i>
                                  <i class="bx bxs-star text-light-4"></i>
                                </div>
                                <div class="ms-1">
                                  <p class="mb-0"> (<?= $admin->count('tblreview','product_id',$product_id); ?> Ratings)</p>
                                </div>
                              </div>
                              <div class="d-flex align-items-center mt-3 gap-2">
                                <?php if($fetchProduct->old_price != "0.00"): ?>
                                <h5 class="mb-0 text-decoration-line-through text-light-3 fw-bold">₦ <?= $fetchProduct->old_price; ?></h5>
                                <?php endif; ?>
                                &nbsp;&nbsp;
                                <h4 class="mb-0 fw-bold">₦ <?= $fetchProduct->new_price; ?></h4>
                              </div>
                              <div class="mt-3">
                                <h6>Discription :</h6>
                                <p class="mb-0"><?= $fetchProduct->description; ?></p>
                              </div>
                              <dl class="row mt-3"> 
                                <dt class="col-sm-3">Product SKU:</dt>
                                <dd class="col-sm-9"><?= $fetchProduct->sku; ?></dd>  

                                <dt class="col-sm-3">Status:</dt>
                                <?php if($fetchProduct->stock > 0): ?>
                                <dd class="col-sm-9"><span class="badge bg-success">In Stock</span></dd>
                                <?php elseif($fetchProduct->stock <= 0): ?>
                                <dd class="col-sm-9"><span class="badge bg-danger">Out of Stock</span></dd>
                                <?php endif; ?>

                                <dt class="col-sm-3">No. Left:</dt>
                                <dd class="col-sm-9"><?= $fetchProduct->stock; ?></dd>  
                              </dl>
                              <div class="row row-cols-auto align-items-center mt-3">
                                <div class="col">
                                  <label class="form-label">Quantity</label>
                                  <input type="number" length="1" value="1" min="1" class="form-control" name="quantity">
                                </div>
                                <div class="col">
                                  
                                </div>
                              </div>
                              <!--end row-->
                              <div class="d-flex gap-2 mt-3">
                                <input type="hidden" name="product_id" value="<?= $fetchProduct->id;?>" readonly>
                                <input type="submit" class="btn btn-primary btn-ecomm" name="btnAddToCart" value="Add to Cart">
                              </div>
                              <hr/>
                            </div>
                            </form>
                          </div>
                        </div>
                        <!--end row-->
                      </div>
                    </div>


                    <!--start product more info-->
                    <div class="product-more-info">
                      <ul class="nav nav-tabs mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" data-bs-toggle="tab" href="#discription" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                              <div class="tab-title text-uppercase fw-500">Description</div>
                            </div>
                          </a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" data-bs-toggle="tab" href="#reviews" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                              <div class="tab-title text-uppercase fw-500">(<?= $product->reviewCount($product_id); ?>) Reviews</div>
                            </div>
                          </a>
                        </li>
                      </ul>
                      <div class="tab-content pt-3">
                        <div class="tab-pane fade" id="discription" role="tabpanel">
                          <p><?= $fetchProduct->description; ?></p>
                        </div>
                        <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                          <div class="row">
                            <div class="col col-lg-8">
                              <div class="product-review">
                                <p class="mb-4 fw-bold small"><?= $product->reviewCount($product_id); ?> Reviews For This Product</p>
                                <div class="review-list">
                                  <!-- Customer Review Display Start -->
                                  <?php foreach($product->fetchAllReview($product_id) as $fetchReview): ?>
                                  <div class="d-flex align-items-start">
                                    <div class="review-user">
                                      <?php if($fetchReview->picture == ""): ?>
                                        <img src="../../assets/images/user/default.jpg" width="65" height="65" class="rounded-circle" alt="" />
                                      <?php else: ?>
                                        <img src="../../assets/images/user/<?= $fetchReview->picture; ?>" width="65" height="65" class="rounded-circle" alt="" />
                                      <?php endif; ?>
                                    </div>
                                    <div class="review-content ms-3">
                                      <div class="rates cursor-pointer fs-6"> <i class="bx bxs-star text-warning"></i>
                                        <?php 
                                          // getting the rating value, then i will use the value to loop through
                                          for($i = 1; $i < $fetchReview->rating; $i++){
                                        ?>
                                        <i class="bx bxs-star text-warning"></i>
                                        <?php } ?>
                                      </div>
                                      <div class="d-flex align-items-center mb-2">
                                        <h6 class="mb-0"><?= ucwords($fetchReview->surname) . " " . ucwords($fetchReview->other_name); ?></h6>
                                        <p class="mb-0 ms-auto"><?= $fetchReview->date_reviewed; ?></p>
                                      </div>
                                      <p class="small"><?= $fetchReview->review; ?></p>
                                    </div>
                                  </div>
                                  <hr/>
                                  <?php endforeach; ?>
                                  <!-- Customer Review Display Ends -->
                                
                                </div>
                              </div>
                            </div>

                            <!-- Review Start -->
                            <div class="col col-lg-4">
                              <div class="add-review">
                                <div class="form-body p-3 rounded border bg-light">
                                  <?php
                                    echo ErrorMessage();
                                    echo SuccessMessage();
                                  ?>
                                  <h5 class="mb-4">Write a Review</h5>
                                  <form method="POST">
                                    <div class="mb-3">
                                      <label class="form-label">Your Name</label>
                                      <input type="hidden" class="form-control" name="product_id" value="<?=$product_id; ?>" readonly>
                                      <input type="text" class="form-control" name="uname" value="<?= ucwords($getCustomer->surname) . " " . ucwords($getCustomer->other_name); ?>">
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Your Email</label>
                                      <input type="email" class="form-control" name="email" value="<?= strtolower($getCustomer->email); ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Rating</label>
                                      <select class="form-select" name="rating">
                                        <option disabled selected value="">Choose Rating</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                      </select>
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Your Review</label>
                                      <textarea class="form-control" name="review" rows="3" placeholder="Your review goes here" required></textarea>
                                    </div>
                                    <div class="d-grid">
                                      <input type="submit" class="btn btn-primary btn-ecomm" name="btnSubmitReview" value="Submit a Review">
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <!-- Review Ends -->
                          </div>
                          <!--end row-->
                        </div>
                      </div>
                    </div>
                <!--end product more info-->

                <!--start similar products-->
                        <div class="d-flex align-items-center mt-3">
                          <h5 class="mb-0">Similar Products</h5>
                          <div class="d-flex align-items-center gap-0 ms-auto"> <a href="javascript:;" class="owl_prev_item fs-2"><i class='bx bx-chevron-left'></i></a>
                            <a href="javascript:;" class="owl_next_item fs-2"><i class='bx bx-chevron-right'></i></a>
                          </div>
                        </div>
                        <hr/>
                        <div class="product-grid">
                          <div class="similar-products owl-carousel owl-theme">
                            
                            <?php foreach($product->fetchSimilarProduct($fetchProduct->category_id,$product_id) as $similarProduct): ?>
                            <div class="item">
                              <div class="card product-card">
                                <div class="card-header bg-transparent border-bottom-0">
                                  <div class="d-flex align-items-center justify-content-end">
                                    <a href="javascript:;">
                                      <div class="product-wishlist"> <i class='bx bx-heart'></i>
                                      </div>
                                    </a>
                                  </div>
                                </div>
                                <img src="../../assets/images/products/<?= $similarProduct->picture; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <div class="product-info">
                                    <?php $category_name = $admin->get('tblcategory','id',$similarProduct->category_id); ?>
                                    <a href="javascript:;">
                                      <p class="product-catergory font-13 mb-1 fw-bold"><?= ucwords($category_name->cat_name); ?></p>
                                    </a>
                                    <a href="../product-details/<?= ucwords($similarProduct->id); ?>">
                                      <h6 class="product-name mb-2 fw-bold"><?= ucwords($similarProduct->product_name); ?></h6>
                                    </a>
                                    <div class="d-flex align-items-center">
                                      <div class="mb-1 product-price"> 
                                        <?php if($similarProduct->old_price != "0.00"): ?>
                                        <span class="me-1 text-decoration-line-through">₦ <?= $similarProduct->old_price; ?></span>
                                        <?php endif; ?>
                                        <span class="fs-5 fw-bold">₦ <?= $similarProduct->new_price; ?></span>
                                      </div>
                                      <div class="cursor-pointer ms-auto">  <span>5.0</span>  <i class="bx bxs-star text-warning"></i>
                                      </div>
                                    </div>
                                    <div class="product-action mt-2">
                                      <div class="d-grid gap-2">
                                        <a href="javascript:;" class="btn btn-primary btn-ecomm"> <i class='bx bxs-cart-add'></i>Add to Cart</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php endforeach; ?>

                          </div>
                        </div>
                     
                    <!--end similar products-->
                    
                  </div>
                </div>
              
            </div>
          </section>
          <!--end product detail-->

          </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('../includes/footer2.php'); ?>



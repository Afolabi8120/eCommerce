<div class="shop-container">
                <div class="card shadow-sm border-0">
                 <div class="card-body">
                <div class="row">
                  <div class="col-12 col-xl-3">
                    <div class="btn-mobile-filter d-xl-none"><i class='bx bx-slider-alt'></i>
                    </div>
                    <div class="filter-sidebar d-none d-xl-flex">
                      <div class="card w-100">
                        <div class="card-body">
                          <div class="align-items-center d-flex d-xl-none">
                            <h6 class="text-uppercase mb-0">Filter</h6>
                            <div class="btn-mobile-filter-close btn-close ms-auto cursor-pointer"></div>
                          </div>
                          <hr class="d-flex d-xl-none" />
                          <div class="product-categories">
                            <h6 class="text-uppercase mb-3">Menus</h6>
                            <ul class="list-unstyled mb-0 categories-list">
                              <li>
                                <a href="order">Order</a>
                              </li>
                              <li>
                                <a href="transactions">Transactions</a>
                              </li>
                              <li>
                                <a href="profile">Profile</a>
                              </li>
                              <li>
                                <a href="fund-wallet">Fund Wallet</a>
                              </li>
                            </ul>
                          </div>
                          <hr class="d-flex d-xl-none" />
                          <div class="product-categories">
                            <h6 class="text-uppercase mb-3">Categories</h6>
                            <ul class="list-unstyled mb-0 categories-list">
                              <?php foreach($admin->select('tblcategory') as $fetchCategories): ?>
                              <li><a href="product_category/<?= $fetchCategories->id; ?>"><?= ucwords($fetchCategories->cat_name); ?> <span class="float-end badge rounded-pill bg-primary"><?= $admin->count('tblproducts','category_id',$fetchCategories->id); ?></span></a>
                              </li>
                              <?php endforeach; ?>
                            </ul>
                          </div>
                          <hr>
                          <div class="price-range">
                            <h6 class="text-uppercase mb-3">Price</h6>
                            <div class="my-4" id="slider"></div>
                            <div class="d-flex align-items-center">
                              <button type="button" class="btn btn-primary btn-sm text-uppercase rounded font-13 fw-500">Filter</button>
                              <div class="ms-auto">
                                <p class="mb-0">
                                  <label for="range"></label>
                                  <input type="range" min="1000" max="10000" name="range" id="range">
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-xl-9">
                    <div class="product-wrapper">
                      <div class="card">
                        <div class="card-body">
                          <div class="position-relative">
                            <div class="col-12">
                             <input type="text" class="form-control ps-5" placeholder="Search Product...">
                             <input type="submit" class="form-control btn btn-primary mt-2" value="Search">
                             <span class="position-absolute top-50 product-show translate-middle-y"><ion-icon name="search-sharp" class="ms-3 fs-6"></ion-icon></span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Product Start -->
                      <div class="product-grid">
                        <?php
                          echo ErrorMessage();
                          echo SuccessMessage();
                        ?>

                        <?php foreach($product->fetchProductForUser() as $fetchProduct): ?>
                        <div class="card product-card">
                          <div class="d-flex align-items-center justify-content-end gap-3 position-absolute end-0 top-0 m-3">
                            <a href="javascript:;">
                              <div class="product-wishlist"> <i class="bx bx-heart"></i>
                              </div>
                            </a>
                          </div>
                          <div class="row g-0">
                            <div class="col-md-4">
                              <div class="p-3">
                                <img src="../assets/images/products/<?= $fetchProduct->picture; ?>" class="img-fluid" alt="...">
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <div class="product-info">
                                  <form method="POST">
                                    <a href="javascript:;">
                                      <p class="product-catergory font-13 mb-1">
                                        <?php $category_name = $admin->get('tblcategory','id',$fetchProduct->category_id); ?>
                                        <span class="fw-bold"><?= ucwords($category_name->cat_name); ?></span>
                                      </p>
                                    </a>
                                    <a href="product-details/<?= $fetchProduct->id; ?>">
                                      <h6 class="product-name mb-2"><?= ucwords($fetchProduct->product_name);?></h6>
                                    </a>
                                    <p class="card-text"><?= $fetchProduct->description;?></p>
                                    <div class="d-flex align-items-center">
                                      <div class="mb-1 product-price"> 
                                        <?php if($fetchProduct->old_price != "0.00"): ?>
                                        <span class="me-1 text-decoration-line-through">₦ <?= $fetchProduct->old_price;?></span>
                                        <?php endif; ?>
                                        <span class="fs-5">₦ <?= $fetchProduct->new_price;?></span>
                                      </div>
                                      <div class="cursor-pointer ms-auto"> <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                      </div>
                                    </div>
                                    <div class="row row-cols-auto align-items-center mt-3">
                                      <div class="col">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" length="1" value="1" min="1" class="form-control" name="quantity">
                                      </div>
                                    </div>
                                    <div class="product-action mt-2">
                                      <div class="d-flex gap-2">
                                          <input type="hidden" name="product_id" value="<?= $fetchProduct->id;?>" readonly>
                                          <input type="submit" class="btn btn-primary btn-ecomm" name="btnAddToCart" value="Add to Cart">
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php endforeach; ?>

                      </div>
                      <!-- Product Ends -->

                    </div>
                  </div>
                  </div><!--end row-->
                </div>
               </div>
              </div>
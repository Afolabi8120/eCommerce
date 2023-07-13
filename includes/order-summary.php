<div class="card-body">
                                  <p class="fs-5">Order summary</p>
                                  <div class="my-3 border-top"></div>
                                    <?php foreach($order->fetchCartItems($getCustomer->id) as $fetchCartItem): ?>
                                    <div class="d-flex align-items-center">
                                      <?php
                                        $fetchProduct = $admin->get('tblproducts','id',$fetchCartItem->product_id); // get the product datas by the product id
                                      ?>
                                      <a class="d-block flex-shrink-0" href="javascript:;">
                                        <img src="../assets/images/products/<?= $fetchProduct->picture; ?>" width="75" alt="Product">
                                      </a>
                                      <div class="ps-2">
                                        <h6 class="mb-1"><?= ucwords($fetchProduct->product_name); ?></h6>
                                        <div class="widget-product-meta"><span class="me-2">₦ <?= $fetchCartItem->price; ?><small></small></span><span class="">x <?= $fetchCartItem->quantity; ?></span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="my-3 border-top"></div>
                                    <?php endforeach; ?>
                                </div>
                                
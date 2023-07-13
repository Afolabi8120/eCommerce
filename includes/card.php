        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-4">
            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="">
                      <p class="mb-1">Total Orders</p>
                      <h4 class="mb-0 text-primary"><?= $admin->count('tblorder_payment','customer_id',$getCustomer->id); ?></h4>
                    </div>
                    <div class="ms-auto text-primary fs-2">
                      <i class="fa fa-receipt"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="">
                      <p class="mb-1">Wallet Balance</p>
                      <h4 class="mb-0 text-info">₦ <?= $getCustomer->balance; ?></h4>
                    </div>
                    <div class="ms-auto text-info fs-2">
                      <i class="fa fa-money-check-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="">
                      <p class="mb-1">Approved Orders</p>
                      <h4 class="mb-0 text-success">0</h4>
                    </div>
                    <div class="ms-auto text-success fs-2">
                      <i class="fa fa-check-circle"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="">
                      <p class="mb-1">Pending Orders</p>
                      <h4 class="mb-0 text-danger">0</h4>
                    </div>
                    <div class="ms-auto text-danger fs-2">
                      <i class="fa fa-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
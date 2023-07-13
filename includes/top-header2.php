<nav class="navbar navbar-expand gap-3">
              <div class="mobile-menu-button"><i class="fa fa-bars"></i></div>
              <form class="searchbar">
                <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><ion-icon name="search-sharp"></ion-icon></div>
                <input class="form-control" type="text" placeholder="Search for anything">
                <div class="position-absolute top-50 translate-middle-y search-close-icon"><ion-icon name="close-sharp"></ion-icon></div>
             </form>
             <div class="top-navbar-right ms-auto">

              <ul class="navbar-nav align-items-center">
                <li class="nav-item mobile-search-button">
                  <a class="nav-link" href="javascript:;">
                    <div class="">
                      <i class="fa fa-search"></i> 
                    </div>
                  </a>
                </li>

                <?php if($getCustomer->usertype == "customer"): ?>
                <li class="nav-item dropdown dropdown-large">
                  <a class="nav-link" href="../cart">
                    <div class="position-relative">
                      <span class="notify-badge"><?= $admin->getCartNotification($getCustomer->id); ?></span>
                      <i class="fa fa-shopping-cart" style="font-size: 22px;"></i>
                    </div>
                  </a>
                </li>
                <?php endif; ?>

                <?php if($getCustomer->usertype == "admin"): ?>
                <li class="nav-item dropdown dropdown-large">
                  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                    <div class="position-relative">
                      <span class="notify-badge">8</span>
                      <i class="fa fa-bell" style="font-size: 22px;"></i>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a href="javascript:;">
                      <div class="msg-header">
                        <p class="msg-header-title">Notifications</p>
                        <p class="msg-header-clear ms-auto">Marks all as read</p>
                      </div>
                    </a>
                    <div class="header-notifications-list">
                      <a class="dropdown-item" href="javascript:;">
                        <div class="d-flex align-items-center">
                          <div class="notify text-primary"><i class="fa fa-envelope"></i>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
                          ago</span></h6>
                            <p class="msg-info">You have recived new orders</p>
                          </div>
                        </div>
                      </a>
                      <a class="dropdown-item" href="javascript:;">
                        <div class="d-flex align-items-center">
                          <div class="notify text-danger"><i class="fa fa-user"></i></ion-icon>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
                           ago</span></h6>
                            <p class="msg-info">a new user registered</p>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <?php endif; ?>
                <li class="nav-item dropdown dropdown-user-setting">
                  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                    <div class="user-setting">
                      <?php if($getCustomer->picture == ""): ?>
                              <img src="../../assets/images/user/default.jpg" alt="" class="user-img">
                            <?php else: ?>
                              <img src="../../assets/images/user/<?= $getCustomer->picture; ?>" alt="" class="user-img">
                            <?php endif; ?>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                       <a class="dropdown-item" href="#">
                         <div class="d-flex flex-row align-items-center gap-2">
                            <?php if($getCustomer->picture == ""): ?>
                              <img src="../../assets/images/user/default.jpg" alt="..." class="rounded-circle" width="54" height="54">
                            <?php else: ?>
                              <img src="../../assets/images/user/<?= $getCustomer->picture; ?>" alt="..." class="rounded-circle" width="54" height="54">
                            <?php endif; ?>
                            <div class="">
                              <h6 class="mb-0 dropdown-user-name small"><?= strtoupper($getCustomer->surname) . " " . strtoupper($getCustomer->other_name); ?></h6>
                              <small class="mb-0 dropdown-user-designation text-secondary"><?= ucfirst($getCustomer->usertype); ?></small>
                            </div>
                         </div>
                       </a>
                     </li>
                     <li><hr class="dropdown-divider"></li>
                      <li>
                        <a class="dropdown-item" href="../dashboard">
                           <div class="d-flex align-items-center">
                             <div class=""><i class="fa fa-home"></i></div>
                             <div class="ms-3"><span>Dashboard</span></div>
                           </div>
                         </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="../profile">
                           <div class="d-flex align-items-center">
                             <div class=""><i class="fa fa-user-circle"></i></div>
                             <div class="ms-3"><span>Profile</span></div>
                           </div>
                         </a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <a class="dropdown-item" href="../../">
                           <div class="d-flex align-items-center">
                             <div class=""><i class="fa fa-power-off"></i></div>
                             <div class="ms-3"><span>Logout</span></div>
                           </div>
                         </a>
                      </li>
                  </ul>
                </li>

               </ul>

              </div>
            </nav>
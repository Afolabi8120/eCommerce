<div class="mini-sidebar-wrapper">
        <div class="mini-sidebar-header">
           <img src="../../assets/images/logo-icon-2.png" alt="" class="logo-icon">
        </div>
        <div class="mini-sidebar-navigation d-flex align-items-center justify-content-center">
         <ul class="nav nav-pills flex-column">
          
           <li class="nav-item" title="Dashboard">
             <a href="../dashboard" class="nav-link"><i class="fa fa-home"></i></ion-icon></a>
           </li>
           <?php if($getCustomer->usertype == 'admin'): ?>

           <li class="nav-item" title="Add Category">
             <a href="../category" class="nav-link"><i class="fa fa-link"></i></a>
           </li>

           <li class="nav-item" title="Add Product">
             <a href="../product" class="nav-link"><i class="fa fa-box"></i></a>
           </li>

           <li class="nav-item" title="Customer List">
             <a href="../customer" class="nav-link"><i class="fa fa-users"></i></a>
           </li>

           <li class="nav-item" title="Order">
             <a href="../order" class="nav-link"><i class="fa fa-file"></i></a>
           </li>

           <li class="nav-item" title="Transactions">
             <a href="../transactions" class="nav-link"><i class="fa fa-credit-card"></i></a>
           </li>

           <li class="nav-item" title="Profile">
             <a href="../profile" class="nav-link"><i class="fa fa-user-circle"></i></a>
           </li>

         <?php endif; ?>

         <?php if($getCustomer->usertype == 'customer'): ?>

           <li class="nav-item" title="Order">
             <a href="../order" class="nav-link"><i class="fa fa-file"></i></a>
           </li>

           <li class="nav-item" title="Transactions">
             <a href="transactions" class="nav-link"><i class="fa fa-credit-card"></i></a>
           </li>

           <li class="nav-item" title="Profile">
             <a href="../profile" class="nav-link"><i class="fa fa-user-circle"></i></a>
           </li>

           <li class="nav-item" title="Fund Wallet">
             <a href="../fund-wallet" class="nav-link"><i class="fa fa-credit-card"></i></a>
           </li>
          
       <?php endif; ?>

         </ul>
       </div>  
      </div>

      
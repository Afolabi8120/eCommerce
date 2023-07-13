<?php
  require('../core/validate/profile.php');
  $pageTitle = "Profile";

  if(isset($_SESSION['email']) AND !empty($_SESSION['email']))
  {

    $getCustomer = $user->getCustomerData($_SESSION['email']);
    $getSession = $user->getCustomerData($_SESSION['email']);

    if($_SESSION['session_id'] !== $getSession->session){
      header('location: ../index');
    }else{
      
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
              <div class="col-lg-12 mx-auto">
                <?php
                  echo ErrorMessage();
                  echo SuccessMessage();
                ?>
                <div class="card radius-10">
                  <div class="card-header fw-bold">
                    Edit Profile
                  </div>
                  <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="mb-4 d-flex flex-column gap-3 align-items-center justify-content-center">
                        <div class="user-change-photo shadow">
                          <?php if($getCustomer->picture == ""): ?>
                            <img src="../assets/images/user/default.jpg" alt="...">
                          <?php else: ?>
                            <img src="../assets/images/user/<?= $getCustomer->picture; ?>" alt="...">
                          <?php endif; ?>
                        </div>
                        <h5 class="fw-bold text-dark mt-3"><?= strtoupper($getCustomer->surname) . " " . strtoupper($getCustomer->other_name); ?></h5>
                        <p class="small mt-0"><?= ucfirst($getCustomer->usertype); ?></p>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="card radius-10">
                  <div class="card-header fw-bold">
                    About
                  </div>
                  <div class="card-body">
                    <form class="form-body row" method="POST">
                      <div class="col-6 mt-2">
                        <label for="inputSurname" class="form-label">Surname</label>
                        <input type="text" name="surname" class="form-control" id="inputSurname" value="<?= $getCustomer->surname; ?>" placeholder="John">
                      </div>
                      <div class="col-6 mt-2">
                        <label for="inputOname" class="form-label">Other Name</label>
                        <input type="text" name="oname" class="form-control" id="inputOname" value="<?= $getCustomer->other_name; ?>"  placeholder="Doe">
                      </div>
                      <div class="col-6 mt-2">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="abc@example.com" value="<?= $getCustomer->email; ?>"  readonly>
                      </div>
                      <div class="col-6 mt-2">
                        <label for="inputPhone" class="form-label">Phone No.</label>
                        <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="08090949669" value="<?= $getCustomer->phone; ?>" >
                      </div>
                      <div class="col-6 mt-2">
                        <label for="inputGender" class="form-label">Gender</label>
                        <select id="inputGender" class="form-control select" name="gender">
                          <option value="Male" <?php if($getCustomer->gender == "Male") echo "selected"; ?> >Male</option>
                          <option value="Female" <?php if($getCustomer->gender == "Female") echo "selected"; ?>>Female</option>
                        </select>
                      </div>
                      <div class="col-6 mt-2">
                        <label for="inputState" class="form-label">State of Origin</label>
                        <select id="inputState" class="form-control select" name="state">
                          <option value="Abia State" <?php if($getCustomer->state =="Abia State") echo "selected"; ?> >Abia State</option>
                          <option value="Anambra State" <?php if($getCustomer->state =="Anambra State") echo "selected"; ?>>Anambra State</option>
                          <option value="Bauchi State" <?php if($getCustomer->state =="Bauchi State") echo "selected"; ?>>Bauchi State</option>
                          <option value="Bayelsa State" <?php if($getCustomer->state =="Bayelsa State") echo "selected"; ?>>Bayelsa State</option>
                          <option value="Benue State" <?php if($getCustomer->state =="Benue State") echo "selected"; ?>>Benue State</option>
                          <option value="Borno State" <?php if($getCustomer->state =="Borno State") echo "selected"; ?>>Borno State</option>
                          <option value="Cross River State" <?php if($getCustomer->state =="Cross River State") echo "selected"; ?>>Cross River State</option>
                          <option value="Delta State" <?php if($getCustomer->state =="Delta State") echo "selected"; ?>>Delta State</option>
                          <option value="Enugu State" <?php if($getCustomer->state =="Enugu State") echo "selected"; ?>>Enugu State</option>
                          <option value="Gombe State" <?php if($getCustomer->state =="Gombe State") echo "selected"; ?>>Gombe State</option>
                          <option value="Imo State" <?php if($getCustomer->state =="Imo State") echo "selected"; ?>>Imo State</option>
                          <option value="Jigawa State" <?php if($getCustomer->state =="Jigawa State") echo "selected"; ?>>Jigawa State</option>
                          <option value="Kastina State" <?php if($getCustomer->state =="Kastina State") echo "selected"; ?>>Kastina State</option>
                          <option value="Kano State" <?php if($getCustomer->state =="Kano State") echo "selected"; ?>>Kano State</option>
                          <option value="Kaduna State" <?php if($getCustomer->state =="Kaduna State") echo "selected"; ?>>Kaduna State</option>
                          <option value="Benin-Kibir State" <?php if($getCustomer->state =="Benin-Kibir State") echo "selected"; ?>>Benin-Kibir State</option>
                          <option value="Kogi State" <?php if($getCustomer->state =="Kogi State") echo "selected"; ?>>Kogi State</option>
                          <option value="Kwara State" <?php if($getCustomer->state =="Kwara State") echo "selected"; ?>>Kwara State</option>
                          <option value="Lagos State" <?php if($getCustomer->state =="Lagos State") echo "selected"; ?>>Lagos State</option>
                          <option value="Nassarawa State" <?php if($getCustomer->state =="Nassarawa State") echo "selected"; ?>>Nassarawa State</option>
                          <option value="Niger State" <?php if($getCustomer->state =="Niger State") echo "selected"; ?>>Niger State</option>
                          <option value="Ogun State" <?php if($getCustomer->state =="Ogun State") echo "selected"; ?>>Ogun State</option>
                          <option value="Osun State" <?php if($getCustomer->state =="Osun State") echo "selected"; ?>>Osun State</option>
                          <option value="Oyo State" <?php if($getCustomer->state =="Oyo State") echo "selected"; ?>>Oyo State</option>
                          <option value="Plataeu State" <?php if($getCustomer->state =="Plataeu State") echo "selected"; ?>>Plataeu State</option>
                          <option value="River State" <?php if($getCustomer->state =="River State") echo "selected"; ?>>River State</option>
                          <option value="Sokoto State" <?php if($getCustomer->state =="Sokoto State") echo "selected"; ?>>Sokoto State</option>
                          <option value="Taraba State" <?php if($getCustomer->state =="Taraba State") echo "selected"; ?>>Taraba State</option>
                          <option value="F.C.T" <?php if($getCustomer->state =="F.C.T") echo "selected"; ?>>F.C.T</option>
                        </select>
                      </div>
                      <div class="col-12 mt-2">
                        <label for="inputAddress" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="inputAddress" placeholder="Your address goes here..." required><?= $getCustomer->address; ?></textarea>
                      </div>
                      <div class="col-12 mt-2">
                        <input type="submit" class="btn btn-primary btn-md " name="btnUpdateProfile" value="Update Profile">
                      </div>
                    </form>
                  </div>
              </div>

              <div class="card radius-10">
                  <div class="card-header fw-bold">
                    Change Password
                  </div>
                  <div class="card-body">
                    <form class="form-body row" method="POST">
                      <div class="col-12 mt-2">
                        <label for="inputCPassword" class="form-label">Old Password</label>
                        <input type="password" name="opassword" class="form-control" id="inputCPassword" placeholder="***********" required>
                      </div>
                      <div class="col-12 mt-2">
                        <label for="inputCPassword" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" id="inputCPassword" placeholder="***********" required>
                      </div>
                      <div class="col-12 mt-2">
                        <label for="inputCPassword" class="form-label">Current Password</label>
                        <input type="password" name="cpassword" class="form-control" id="inputCPassword" placeholder="***********" required>
                      </div>
                      <div class="col-12 mt-2">
                        <input type="submit" class="btn btn-primary btn-md " name="btnUpdatePassword" value="Update Password">
                      </div>
                    </form>
                  </div>
              </div>

              <div class="card radius-10">
                  <div class="card-header fw-bold">
                    Edit Photo
                  </div>
                  <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" >
                      <div class="col-12 mt-2">
                        <label for="inputPicture" class="form-label">Select Picture</label>
                        <input type="file" name="user-img" class="form-control" id="inputPicture" required>
                      </div>
                      <div class="col-12 mt-2">
                        <input type="submit" class="btn btn-primary btn-md " accept=".png,.jpeg,.jpg" name="btnUpdatePhoto" value="Update Photo">
                      </div>
                    </form>
                  </div>
                </div>

                <div class="card radius-10">
                  <div class="card-header fw-bold">
                    Set Wallet Pin
                  </div>
                  <div class="card-body">
                    <form class="form-body row" method="POST">
                      <div class="col-12 mt-2">
                        <label for="inputCPassword" class="form-label">Old Pin</label>
                        <input type="password" name="old_pin" class="form-control" id="inputCPassword" placeholder="****" maxlength="4" required>
                      </div>
                      <div class="col-12 mt-2">
                        <label for="inputCPassword" class="form-label">New Pin</label>
                        <input type="password" name="new_pin" class="form-control" id="inputCPassword" placeholder="****" maxlength="4" required>
                      </div>
                      <div class="col-12 mt-2">
                        <label for="inputCPassword" class="form-label">Confirm Pin</label>
                        <input type="password" name="c_pin" class="form-control" id="inputCPassword" placeholder="****" maxlength="4" required>
                      </div>
                      <div class="col-12 mt-2">
                        <input type="submit" class="btn btn-primary btn-md " name="btnSetPin" value="Set Pin">
                      </div>
                    </form>
                  </div>
              </div>

              <div class="card radius-10">
                  <div class="card-header fw-bold">
                    Two-Factor Authentication
                    <div class="form-check form-switch" style="font-size: 30px; display: flex;position: inherit; float: right;">
                      <form method="POST">
                        <input class="form-check-input" onchange="this.form.submit();" name="two_factor" type="checkbox" role="switch" id="flexSwitchCheckRemember" <?php if($getCustomer->auth =="on") echo "checked"; ?>>
                      </form>
                    </div>
                    <p class="small fw-normal" style="font-size: 10px;">Protect access to your account by turning on two-factor authentication.</p>
                  </div>
              </div>

            </div>
          <!-- end page content-->
         </div>
         <!--end page content wrapper-->

  <?php include('../includes/footer.php'); ?>



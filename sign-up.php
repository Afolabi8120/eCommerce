<?php
  require('core/validate/register.php');

?>
<!doctype html>
<html lang="en" class="light-theme">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="color-scheme" content="#8436A8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--plugins-->
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="../assets/css/fontawesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">

    <title>eCommerce | Sign Up</title>
  </head>
  <body style="background: #8436A8;">

  <!--start wrapper-->
    <div class="wrapper">
      <div class="container">
      <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto mt-5">
          <div class="card radius-10">
            <div class="card-body p-4">
              <div class="text-center">
                <!-- <a href="javascript:;"><img src="assets/images/logo-icon-3.png" width="140" alt=""/></a> -->
                <h4>Sign Up</h4>
                <p>Create a new account</p>
                <?php
                  echo ErrorMessage();
                  echo SuccessMessage();
                ?>
              </div>
              <form class="form-body row g-3" method="POST">
                <div class="col-12">
                  <label for="inputSurname" class="form-label">Surname</label>
                  <input type="text" name="surname" class="form-control" id="inputSurname" placeholder="John">
                </div>
                <div class="col-12">
                  <label for="inputOname" class="form-label">Other Name</label>
                  <input type="text" name="oname" class="form-control" id="inputOname" placeholder="Doe">
                </div>
                <div class="col-12">
                  <label for="inputEmail" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="inputEmail" placeholder="abc@gmail.com">
                </div>
                <div class="col-12">
                  <label for="inputPassword" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="************">
                </div>
                <div class="col-12">
                  <label for="inputCPassword" class="form-label">Confirm Password</label>
                  <input type="password" name="cpassword" class="form-control" id="inputCPassword" placeholder="************">
                </div>
                <div class="col-12 col-lg-12">
                  <div class="d-grid">
                    <input type="submit" class="btn btn-primary" name="btnSignUp" value="Sign Up">
                  </div>
                </div>
                <div class="col-12 col-lg-12 text-center">
                  <p class="mb-0">Already have an account? <a href="index">Sign In</a></p>
                </div>
                <div class="col-12 col-lg-12">
                  <div class="position-relative border-bottom my-3">
                     <div class="position-absolute seperator-2 translate-middle-y">OR</div>
                  </div>
                </div>
                <div class="col-12 col-lg-12">
                  <div class="d-grid gap-2">
                    <a href="javascript:;" class="btn border border-2 border-primary"><img src="assets/images/icons/google.png" width="20" alt=""><span class="ms-3 fw-500">Sign in with Google</span></a>
                    <a href="javascript:;" class="btn border border-2 border-dark"><img src="assets/images/icons/apple-black-logo.png"  width="20" alt=""><span class="ms-3 fw-500">Sign in with Apple</span></a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
     </div>
     <footer class="my-5">
       <div class="container">
          <div class="d-flex align-items-center gap-4 fs-5 justify-content-center social-login-footer">
            <a href="javascript:;"><ion-icon name="logo-twitter"></ion-icon></a>
            <a href="javascript:;"><ion-icon name="logo-linkedin"></ion-icon></a>
            <a href="javascript:;"><ion-icon name="logo-github"></ion-icon></a>
            <a href="javascript:;"><ion-icon name="logo-facebook"></ion-icon></a>
            <a href="javascript:;"><ion-icon name="logo-pinterest"></ion-icon></a>
          </div>
          <div class="text-center text-white">
            <p class="my-4">Copyright © <?= date('Y'); ?> Cyber Ghost.</p>
          </div>
       </div>
     </footer>
     </div>
  <!--end wrapper-->


  </body>
</html>
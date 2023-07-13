<?php

  include('core/init.php');
  $pageTitle = "Verify Email";

  if(isset($_SESSION['verify-email']))
  {
    //header('location: index');
  }
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

    <title>eCommerce | Verify Email</title>
  </head>
  <body style="background: #8436A8;">
  <!--start wrapper-->
    <div class="wrapper">
      <div class="container">
      <div class="row">
        <div class="col-xl-5 col-lg-6 col-md-7 mx-auto">
          <div class="reset-passowrd">
          <div class="card radius-10 w-100 mt-8">
            <div class="card-body p-4">
              <div class="text-center">
                <i class="fa fa-envelope fa-5x mb-2 text-primary"></i>
                <h4>Verification Link Has Been Sent</h4>
                <p>
                  We have sent you an email verification link with instructions to your email address.
                  Follow the link to verify your email address.
                </p>
              </div>
              <div class="col-12 col-lg-12">
                  <div class="d-grid">
                    <a href="index" class="btn btn-primary btn- block">Go Back To Sign In</a>
                  </div>
              </div>
            </div>
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

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/fontawesome.js"></script>


  </body>
</html>
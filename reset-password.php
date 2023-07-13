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

    <title>eCommerce | Reset Password</title>
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
                <h4>Reset password</h4>
                <p>You will receive an e-mail in maximum 60 seconds</p>
              </div>
              <form class="form-body row g-3">
                <div class="col-12">
                  <label for="inputEmail" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="inputEmail" placeholder="abc@example.com">
                </div>
                <div class="col-12 col-lg-12">
                  <div class="d-grid">
                    <button type="button" class="btn btn-primary">Send</button>
                  </div>
                </div>
              </form>
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


  </body>
</html>
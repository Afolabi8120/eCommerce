<?php

    include_once('../core/init.php');

    #session_start();
    $getCustomer = $user->getCustomerData($_SESSION['email']);
    $getSession = $user->getCustomerData($_SESSION['email']);

    $email = $getUserData->email;
    $booking_no = $_SESSION['booking_no'];

    $curl = curl_init();

    $ref = $_GET['reference'];
    $ref = rawurlencode($ref);

    if($ref == null || $ref == '') {
        header("Location:javascript://history.go(-1)");
    }
  
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $ref,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "Authorization: Bearer sk_test_a9d5ab58291d0fa68468f23d91093af73cd5f905",
        "Cache-Control: no-cache"
      ]
    ));
    //Execute cURL
    $response = curl_exec($curl);

    $err = curl_error($curl);
    #curl_close($curl);
    
    if ($err) {
      die("cURL Error #: ") . $err;
    } 

    //var_dump($response);
    $tranx = json_decode($response);

    if(!$tranx->status){
      die("API return some errors: " . $tranx->message);
    }

    if('success' == $tranx->data->status){
      #$fetch = $globalclass->printReceipt($email,$booking_no);
      $fetch = $globalclass->selectByOneColumn('booking_no','tblbooking',$booking_no);

      if($globalclass->savePayment($email,$ref,$booking_no,$fetch->price,1) === true){
        if($globalclass->updateBooking($booking_no) === true){
          header('location: thank-you');
        }
      }
      echo "Success";
    }else{
      echo "<script>alert('Transaction not found')</script>";
      header('location: dashboard');
    }

?>

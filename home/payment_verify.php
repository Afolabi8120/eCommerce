<?php

    require('../core/init.php');

    // if(!isset($_SESSION['email']))
    // {
    //   header('location: fund-wallet');
    //   exit();
    // }

    #session_start();
    $getCustomer = $user->getCustomerData($_SESSION['email']);

    $email = $getCustomer->email;
    $customer_id = $getCustomer->id;

    $curl = curl_init();

    $ref = $_GET['reference'];
    $ref = rawurlencode($ref);

    $transaction_code = $ref; // transaction code

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
    
    if ($err) {
      die("cURL Error #: ") . $err;
    } 

    $tranx = json_decode($response);

    if(!$tranx->status){
      die("API return some errors: " . $tranx->message);
    }

    if('success' == $tranx->data->status){

      $amount = substr($tranx->data->amount, 0, -2);
      $initial_amount = round($amount - (95 / 100));

      //var_dump($amount);exit();

      if($user->addWalletBalance($customer_id,$transaction_code,"Wallet Funding",$amount,$amount) === true){
        if($user->addToUserBalance($customer_id,$amount) === true){
          $_SESSION['SuccessMessage'] = "Your wallet balance has been updated";
          header('location: wallet-record');
        }
      }
      echo "Success";
    }else{
      echo "<script>alert('Transaction not found')</script>";
      header('refresh:3;url=dashboard');
    }

?>

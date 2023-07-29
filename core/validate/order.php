<?php
    include('../core/init.php');

    if(isset($_POST['btnAddToCart']) && !empty($_POST['btnAddToCart'])){
        
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Form Validation 
        if(empty($product_id) || empty($quantity)){
            $_SESSION['ErrorMessage'] = "All fields are Required";
        }elseif(!preg_match("/^[0-9]*$/", $product_id)){
            return;
        }else{

            // validating our data
            $product_id = $admin->validateInput($product_id);
            $quantity = $admin->validateInput($quantity);

            // getting the customer details
            $getCustomer = $user->getCustomerData($_SESSION['email']);

            // fetch product details using the product id
            $fetchProduct = $admin->get('tblproducts','id',$product_id);

            $price = $fetchProduct->new_price;
            $total = $quantity * $price;

            if($order->addToCart("",$getCustomer->id,$fetchProduct->id,$price,$quantity,$total,'0') === true){
                if($order->reduceStock($fetchProduct->id,$quantity) === true){
                    $_SESSION['SuccessMessage'] =  "Item Added To Cart";
                }
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Add Item To Cart";
            }

        }

    }elseif(isset($_POST['btnRemoveCartItem']) AND !empty($_POST['btnRemoveCartItem'])){ // remove item from cart

        $cart_id = $_POST['cart_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $cart_id = $admin->validateInput($cart_id);
        $product_id = $admin->validateInput($product_id);
        $quantity = $admin->validateInput($quantity);

        if($order->removeFromCart($cart_id) === true){
            if($order->increaseStock($product_id,$quantity) === true){
                $_SESSION['SuccessMessage'] =  "Item Removed From Cart";
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Increase Product Stock";
            }
        }else{
            $_SESSION['ErrorMessage'] =  "Failed To Remove Item From Cart";
        }
        
    }elseif(isset($_POST['btnIncrease']) AND !empty($_POST['btnIncrease'])){ // increase item quantity

        $cart_id = $_POST['cart_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $cart_id = $admin->validateInput($cart_id);
        $product_id = $admin->validateInput($product_id);
        $quantity = $admin->validateInput($quantity);

        if($order->increaseCartQuantity($cart_id) === true){
            if($order->reduceStock($product_id,$quantity) === true){
                $_SESSION['SuccessMessage'] =  "Item Quantity Has Been Increased";
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Increase Item Quantity";
            }
        }else{
            $_SESSION['ErrorMessage'] =  "Failed To Increase Item Quantity";
        }
        
    }elseif(isset($_POST['btnDescrease']) AND !empty($_POST['btnDescrease'])){ // decrease item quantity

        $cart_id = $_POST['cart_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $cart_id = $admin->validateInput($cart_id);
        $product_id = $admin->validateInput($product_id);
        $quantity = $admin->validateInput($quantity);

        if($order->decreaseCartQuantity($cart_id) === true){
            if($order->increaseStock($product_id,$quantity) === true){
                $_SESSION['SuccessMessage'] =  "Item Quantity Has Been Decreased";
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Decrease Item Quantity";
            }
        }else{
            $_SESSION['ErrorMessage'] =  "Failed To Decrease Item Quantity";
        }
        
    }elseif(isset($_POST['btnProceedToCheckout']) AND !empty($_POST['btnProceedToCheckout'])){ // proceed to checkout

        if(isset($_POST['user-info'])){ // if the checkbox is checked

            // getting the customer details
            $getCustomer = $user->getCustomerData($_SESSION['email']);

            $surname = $getCustomer->surname;
            $oname = $getCustomer->other_name;
            $email = $getCustomer->email;
            $phone = $getCustomer->phone;
            $gender = $getCustomer->gender;
            $state = $getCustomer->state;
            $address = $getCustomer->address;

            if(empty($surname) || empty($oname) || empty($email) || empty($phone) || empty($gender) || empty($state) || empty($address)){
                $_SESSION['ErrorMessage'] = "You are yet to set up your profile details1";
            }elseif(!preg_match("/^[0-9]*$/", $phone)){
                $_SESSION['ErrorMessage'] =  "Phone No is Not Valid";
            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['ErrorMessage'] =  "Email Address is Invalid";
            }else{

                $surname = $admin->validateInput($surname);
                $oname = $admin->validateInput($oname);
                $email = $admin->validateInput($email);
                $phone = $admin->validateInput($phone);
                $gender = $admin->validateInput($gender);
                $state = $admin->validateInput($state);
                $address = $admin->validateInput($address);

                // getting the customer details
                $getCustomer = $user->getCustomerData($_SESSION['email']);

                if($order->addOrderPayment('',$getCustomer->id,$surname,$oname,$email,$phone,$gender,$state,$address,'0','','','0') === true){
                    $_SESSION['order_payment'] = true;
                    header('location: checkout-payment');
                }else{
                    $_SESSION['ErrorMessage'] =  "Failed To Add Shipping Address";
                }
            }

            return;
                
        }else{
            
            $surname = $_POST['surname'];
            $oname = $_POST['oname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $state = $_POST['state'];
            $address = $_POST['address'];
                
            if(empty($surname) || empty($oname) || empty($email) || empty($phone) || empty($gender) || empty($state) || empty($address)){
                $_SESSION['ErrorMessage'] = "All Fields For Shipping Address is Required";
            }elseif(!preg_match("/^[0-9]*$/", $phone)){
                $_SESSION['ErrorMessage'] =  "Phone No is Not Valid";
            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['ErrorMessage'] =  "Email Address is Invalid";
            }else{
                
                $surname = $admin->validateInput($surname);
                $oname = $admin->validateInput($oname);
                $email = $admin->validateInput($email);
                $phone = $admin->validateInput($phone);
                $gender = $admin->validateInput($gender);
                $state = $admin->validateInput($state);
                $address = $admin->validateInput($address);

                // getting the customer details
                $getCustomer = $user->getCustomerData($_SESSION['email']);

                if($order->addOrderPayment('',$getCustomer->id,$surname,$oname,$email,$phone,$gender,$state,$address,'0','','','0') === true){
                    $_SESSION['order_payment'] = true;
                    header('location: checkout-payment');
                }else{
                    $_SESSION['ErrorMessage'] =  "Failed To Add Shipping Address";
                }
            }
            
        }
        
    }elseif(isset($_POST['btnProceedToMakePayment']) AND !empty($_POST['btnProceedToMakePayment'])){ // select payment option

        if(isset($_POST['payment']) AND !empty($_POST['payment'])){
            $option = $_POST['payment'];

            $option = $admin->validateInput($option);

            if($option == "1"){
                $_SESSION['wallet-pay'] = 1;
                header('location: wallet-pay');
            }elseif ($option == "1") {
                $_SESSION['card-payment'] = 2;
                header('location: card-payment');
            }
            
        }
        
    }elseif(isset($_POST['btnPayByWallet']) AND !empty($_POST['btnPayByWallet'])){ // payment using wallet balance

        $customerData = $user->getCustomerData($_SESSION['email']); // getting the customer data

        $amount = $order->getCartSum($customerData->id);
        $pin = $_POST['pin'];
        $cpin = $_POST['cpin'];

        if(empty($pin) || empty($cpin)){
            $_SESSION['ErrorMessage'] = "All fields are Required";
        }elseif ($pin != $cpin) {
            $_SESSION['ErrorMessage'] = "Your Pin Do Not Match";
            return;
        }else{

            // validating the amount
            $amount = $admin->validateInput($amount);

            if($customerData->balance >= $amount){ // if balance is greater than the amount of item bought

                $fetched_pin = $customerData->pin; // getting the users pin

                $output = strtoupper(substr(md5($pin), 0, 6)); // encrypting the users pin

                // generating invoice number
                $num = date('Ymd').uniqid().time();
                $_SESSION['invoiceno'] = strtoupper($num);

                $invoiceno = $_SESSION['invoiceno'];
                $description = "Dear " . ucfirst($customerData->surname) . ", " . $amount . " has been deducted from your wallet balance";
                $oldbalance = $customerData->balance;
                $newbalance = $oldbalance - $amount;
                $date = date("d M Y g:i A");
                $time = date('g:i A');
                
                if($fetched_pin == $output){ // check if the encrypted pin matches with the provided pin
                    if($order->addTransaction($customerData->id,$invoiceno,'Wallet Balance',$description,$amount,$oldbalance,$newbalance,$date) === true){
                        if($order->deductUserBalance($customerData->id,$amount) === true){ // update user balance
                            if($order->updateCartStatus($invoiceno,$customerData->id) === true){ // update the cart status
                                if($order->updateOrderPayment($invoiceno,$amount,$date,$time,$customerData->id)){
                                    unset($_SESSION['order_payment']); // unset the session for checkout payment
                                    $_SESSION['success'] = true;
                                    header('location: checkout-success');
                                }
                            }
                        }
                    }else{
                        $_SESSION['ErrorMessage'] =  "Failed To Make Payment";
                    }
                }else{
                    $_SESSION['ErrorMessage'] =  "Pin Provided Is Not Valid";
                }

            }else{
                $_SESSION['ErrorMessage'] =  "Insufficient Balance, cannot proceed with transaction.";
            }

        }
        
    }


?>
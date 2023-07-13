<?php
    include('./core/init.php');

    if(isset($_POST['btnSignUp']) && !empty($_POST['btnSignUp'])){
        
        $surname = $_POST['surname'];
        $oname = $_POST['oname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        // Form Validation 
        if(empty($surname) || empty($oname) || empty($email) || empty($password) || empty($cpassword)){
            $_SESSION['ErrorMessage'] = "All fields are Required";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['ErrorMessage'] =  "Email Address is Invalid";
        }elseif(!preg_match("/^[a-z A-Z]*$/", $surname)){
            $_SESSION['ErrorMessage'] =  "Surname is Not Valid";
        }elseif(!preg_match("/^[a-z A-Z]*$/", $oname)){
            $_SESSION['ErrorMessage'] =  "Other Name is Not Valid";
        }elseif($admin->checkSingleColumn('tblcustomer','email',$email)){
            $_SESSION['ErrorMessage'] =  "Email Address Already In Use";
        }elseif ($password !== $cpassword) {
            $_SESSION['ErrorMessage'] =  "Both Password Do Not Match";
        }else{

            $surname = $admin->validateInput($surname);
            $oname = $admin->validateInput($oname);
            $email = $admin->validateInput($email);
            $password = $admin->validateInput($password);
            $cpassword = $admin->validateInput($cpassword);

            $email = strtolower($email);
            $surname = strtolower($surname);
            $oname = strtolower($oname);

            //hashing the password
            $salt = "45&%Cdfgak1Waq7";
            $pass = substr(md5($password), 0, 12);
            $password = $pass.$salt;

            // generate session
            $session = session_id();

            if($user->register($surname,$oname,$email,'','10000.00','','','','',"active","customer",$password,'',$session,'off') === true){
                $_SESSION['verify-email'] = $email;
                $_SESSION['SuccessMessage'] =  "Account Creation Successful";
                header('location: verify-email');
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Create Account";
            }

        }

    }elseif(isset($_POST['btnLogin']) && !empty($_POST['btnLogin'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Form Validation 
        if(empty($email) || empty($password)){
            $_SESSION['ErrorMessage'] = "All fields are Required";
        }else{
            $email = $user->validateInput($email);
            $password = $user->validateInput($password);

            // check if password match
            $salt = "45&%Cdfgak1Waq7";
            $pass = substr(md5($password), 0, 12);
            $password = $pass.$salt;

            if($user->login($email,$password)){
                $getCustomerData = $user->getCustomerData($email);

                if($getCustomerData->status == 'active'){
                    if($getCustomerData->usertype == 'customer'){
                        if($getCustomerData->pin == ''){
                            $_SESSION['session_id'] = session_id();
                            $_SESSION['setpin'] = $getCustomerData->email;
                            $user->updateSession($_SESSION['setpin'], $_SESSION['session_id']);
                            $_SESSION['SuccessMessage'] =  "Login Successful";
                            header('location: home/set-pin');
                        }elseif($getCustomerData->pin != ''){
                            $_SESSION['session_id'] = session_id();
                            $_SESSION['email'] = $getCustomerData->email;
                            $user->updateSession($_SESSION['email'], $_SESSION['session_id']);
                            $_SESSION['SuccessMessage'] =  "Login Successful";
                            header('location: home/dashboard');
                        }
                    }elseif($getCustomerData->usertype == 'admin'){
                        $_SESSION['session_id'] = session_id();
                        $_SESSION['email'] = $getCustomerData->email;
                        $user->updateSession($_SESSION['email'], $_SESSION['session_id']);
                        header('location: 0/dashboard'); 
                    }

                }elseif($getCustomerData->status == 'in-active'){
                        $_SESSION['ErrorMessage'] = "Your Account Has Been Deactivated";
                }
            }else{
                $_SESSION['ErrorMessage'] = "Invalid Details Provided";
            }
        }
    }


?>
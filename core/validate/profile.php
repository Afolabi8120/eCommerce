<?php
    include('../core/init.php');

    if(isset($_POST['btnUpdateProfile']) AND !empty($_POST['btnUpdateProfile'])){ // profile update

        $surname = $_POST['surname'];
        $oname = $_POST['oname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $state = $_POST['state'];
        $address = $_POST['address'];
            
        // Form Validation 
        if(empty($surname) || empty($oname) || empty($email) || empty($phone) || empty($gender) || empty($state) || empty($address)){
            $_SESSION['ErrorMessage'] = "All fields are Required";
        }elseif(!preg_match("/^[0-9]*$/", $phone)){
            $_SESSION['ErrorMessage'] =  "Phone No is Not Valid";
        }else{
            $surname = $admin->validateInput($surname);
            $oname = $admin->validateInput($oname);
            $email = $admin->validateInput($email);
            $phone = $admin->validateInput($phone);
            $gender = $admin->validateInput($gender);
            $state = $admin->validateInput($state);
            $address = $admin->validateInput($address);

            $student = $user->getCustomerData($_SESSION['email']);
            $id = $student->id; 

            if($user->updateProfile($id,$surname,$oname,$email,$phone,$gender,$state,$address) === true){
                $_SESSION['SuccessMessage'] =  "Account Has Been Successfully Updated";    
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Update Profile";
            }
            
        } 
    }else if(isset($_POST['btnUpdatePhoto'])){ // change user photo

        if(isset($_FILES['user-img'])){
            if(!empty($_FILES['user-img']['name'])){

                $getCustomer = $user->getCustomerData($_SESSION['email']);

                $customer_image = $getCustomer->picture;

                $image_name = $_FILES['user-img']['name'];

                //specifying the supported file extension
                $validextensions = ['jpg', 'png', 'jpeg'];
                $ext = explode('.', basename($_FILES['user-img']['name']));

                //explode file name from dot(.)
                $file_extension = end($ext);

                $getImageID = uniqid().time(); #generate a unique id
                $hashImageID = sha1($getImageID); #encrypt the unique id
                $useImageID = "IMG-".date('Y-m-di').substr($hashImageID, 2, 6); #split the unique id

                $image_name = $useImageID.".".$file_extension;
                $target = '../assets/images/user/' . $image_name;

                if($_FILES['user-img']['size'] > 2097152){
                    $_SESSION['ErrorMessage'] = "The allowed file size is 2MB.";
                    return;
                }elseif(!in_array($file_extension, $validextensions)){ 
                    $_SESSION['ErrorMessage'] = "Please select a valid picture format";
                    return;
                }else{
                    if($user->updateImage($getCustomer->id, $image_name) === true){
                        unlink('../assets/images/user/'.$getCustomer->picture);
                        move_uploaded_file($_FILES['user-img']['tmp_name'],  $target);
                        $_SESSION['SuccessMessage'] = "Profile Photo Has Been Changed Successfully";
                    }else{
                        $_SESSION['ErrorMessage'] = "Failed to Change Profile Photo";
                    }
                    
                }
                
            }
        }

    }else if(isset($_POST['btnUpdatePassword']) AND !empty($_POST['btnUpdatePassword'])){ // password update
        // passing data received from user into variable
        $oldpassword = $_POST['opassword'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if(empty($oldpassword) || empty($password) || empty($cpassword)){
            $_SESSION['ErrorMessage'] = "All fields are Required";
        }
        elseif ($password != $cpassword) {
            $_SESSION['ErrorMessage'] = "Both password did not match";
        }
        else{

            $oldpassword = $admin->validateInput($oldpassword);
            $password = $admin->validateInput($password);
            $cpassword = $admin->validateInput($cpassword);

            $salt = "45&%Cdfgak1Waq7";
            $pass = substr(md5($oldpassword), 0, 12);
            $oldpassword = $pass.$salt;

            $student = $user->getCustomerData($_SESSION['email']);
            $getpassword = $student->password; 
            
            if($oldpassword != $getpassword){
                $_SESSION['ErrorMessage'] = "Old Password Provided is Invalid";
            }
            else{
                $salt = "45&%Cdfgak1Waq7";
                $pass = substr(md5($password), 0, 12);
                $newpassword = $pass.$salt;

                if($user->updatePassword($student->id, $newpassword) === true){
                    $_SESSION['SuccessMessage'] = "Password Has Been Changed Successfully";
                }else{
                    $_SESSION['ErrorMessage'] = "Failed to Change Password";   
                }
            }
        }
    }else if(isset($_POST['btnSetPin']) AND !empty($_POST['btnSetPin'])){ // password update
        // passing data received from user into variable
        $old_pin = $_POST['old_pin'];
        $new_pin = $_POST['new_pin'];
        $c_pin = $_POST['c_pin'];

        if(empty($old_pin) || empty($new_pin) || empty($c_pin)){
            $_SESSION['ErrorMessage'] = "All fields are Required";
        }elseif($new_pin == "1234" || $new_pin == "0000" || $new_pin == "1111"){
            $_SESSION['ErrorMessage'] = "This Pin Is Too Weak";
        }
        elseif ($new_pin != $c_pin) {
            $_SESSION['ErrorMessage'] = "Your Pin Do Not Match";
        }
        else{

            $customer = $user->getCustomerData($_SESSION['email']);
            $fetched_pin = $customer->pin; 

            $output = strtoupper(substr(md5($old_pin), 0, 6)); // encrypt the old pin

            if($output != $fetched_pin){
                $_SESSION['ErrorMessage'] = "Old Pin is Invalid";
                return;
            }
            else{

                $output_newpin = substr(md5($new_pin), 0, 6); // encrypt the new pin
                $newPin = strtoupper($output_newpin); // convert to upper case

                if($user->updatePin($customer->id,$newPin) === true){
                    $_SESSION['SuccessMessage'] = "Pin Set Successfully";
                }else{
                    $_SESSION['ErrorMessage'] = "Failed To Set Pin";
                }
            }
        }
    }else if(isset($_POST['btnSetPin2']) AND !empty($_POST['btnSetPin2'])){ // setting pin for the first time
        // passing data received from user into variable
        $new_pin = $_POST['new_pin'];
        $c_pin = $_POST['c_pin'];

        if($new_pin == "1234" || $new_pin == "0000" || $new_pin == "1111"){
            $_SESSION['ErrorMessage'] = "This Pin Is Too Weak";
        }
        elseif ($new_pin != $c_pin) {
            $_SESSION['ErrorMessage'] = "Your Pin Do Not Match";
        }
        else{

            $customer = $user->getCustomerData($_SESSION['setpin']);

            $output = substr(md5($new_pin), 0, 6);
            $newPin = strtoupper($output);

            if($user->updatePin($customer->id,$newPin) === true){
                $_SESSION['email'] = $customer->email;
                $_SESSION['SuccessMessage'] = "Pin Set Successfully";
                header('location: dashboard');
            }else{
                $_SESSION['ErrorMessage'] = "Failed To Set Pin";
            }        
        }
    }elseif(isset($_POST['two_factor']) AND !empty($_POST['two_factor'])){
        $two_factor = $_POST['two_factor'];

        $two_factor = $admin->validateInput($two_factor);

        $customer = $user->getCustomerData($_SESSION['email']);
        $id = $customer->id; 

        if($user->updateTwoStepVerification($id,'on') === true){
            $_SESSION['SuccessMessage'] = "Two Factor Authenticatoin Has Been Enabled";
        }

    }

?>
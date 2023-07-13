<?php
    include('../core/init.php');

    require('../core/classes/class.phpmailer.php');
    require('../core/classes/class.smtp.php');
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    // use PHPMailer\PHPMailer\Exception;

    // require '../PHPMailer/PHPMailer/src/Exception.php';
    // require '../PHPMailer/PHPMailer/src/PHPMailer.php';
    // require '../PHPMailer/PHPMailer/src/SMTP.php';

    // // //Create an instance; passing `true` enables exceptions
    // $mail = new PHPMailer();

    if(isset($_POST['btn-forget'])){
        // passing data received from user into variable
        $email = $_POST['email'];
        $email = $stu->validateInput($email);

        // Form Validation 
        if(empty($email)){
            $_SESSION['ErrorMessage'] = "Please Input Your Email Address";
        }else{
            
            if($stu->checkEmail($email) === true){
                // to generate token
                $randomNumber = md5(rand(1000, 100000)).time();
                $generateToken = md5($randomNumber).rand()."-".md5(uniqid());
                $url = "https://" .$_SERVER["HTTP_HOST"]."/auth/reset-password?token=$generateToken";

                $subject = "Password Reset";
                $body = '
                <a href="{$url}">Click here</a> to reset your password
                ';

                // if($admin->sendMail($email, $subject, $body) === true){
                //     if($stu->saveToken($email, $generateToken)){
                //         $_SESSION['SuccessMessage'] = 'A link has been sent to ' . $email;
                //     }else{
                //         $_SESSION['ErrorMessage'] =  "Failed to save token";
                //     }
                // }else{
                //     $_SESSION['ErrorMessage'] =  "Message could not be sent";
                // }
                
                #$to = $email;

                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->SMTPAuth   = true;
                $mail->Host       = 'smtp.nacostpi.com';
                $mail->Username   = 'contact@nacostpi.com';
                $mail->Password   = ''; 
                $mail->From = "contact@nacostpi.com";
                $mail->FromName = "NACOS The Polytechnic Ibadan";

                $mail->AddAddress($email); 
                $mail->AddCC("afolabi8120@gmail.com");
                $mail->Subject = $subject;
                $mail->Body    = $body;
                $mail->AltBody = 'You requested for a password reset';
                $mail->WordWrap = 100;
                $mail->isHTML(true); 
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 587; //587 465

                if($mail->send()){
                    if($stu->saveToken($email, $generateToken)){
                        $_SESSION['SuccessMessage'] = 'A link has been sent to ' . $email;
                    }else{
                        $_SESSION['ErrorMessage'] =  "Failed to save token";
                    }
                }else{
                    $_SESSION['ErrorMessage'] =  "Message could not be sent";
                }
            }else {
                $_SESSION['ErrorMessage'] =  "Email Address Provided Is Not Valid";   
            }

        }
    }


    
?>
<?php
    include('../core/init.php');

    if(isset($_POST['btnDisableCustomer']) AND !empty($_POST['btnDisableCustomer'])){ // disable customer profile

        $customer_id = $_POST['customer_id'];
            
        $customer_id = $admin->validateInput($customer_id);

        if($admin->disable($customer_id,'tblcustomer','in-active') === true){
            $_SESSION['SuccessMessage'] =  "Customer Account Has Been Disabled";    
        }else{
            $_SESSION['ErrorMessage'] =  "Failed To Disable Customer Account";
        }
    }elseif(isset($_POST['btnEnableCustomer']) AND !empty($_POST['btnEnableCustomer'])){ // enable customer profile

        $customer_id = $_POST['customer_id'];
            
        $customer_id = $admin->validateInput($customer_id);

        if($admin->enable($customer_id,'tblcustomer','in-active') === true){
            $_SESSION['SuccessMessage'] =  "Customer Account Has Been Enabled";    
        }else{
            $_SESSION['ErrorMessage'] =  "Failed To Enable Customer Account";
        }
    }

?>
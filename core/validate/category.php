<?php
    include('../core/init.php');

    if(isset($_POST['btnSaveCategory']) AND !empty($_POST['btnSaveCategory'])){ // profile update

        $name = $_POST['name'];
            
        // Form Validation 
        if(empty($name)){
            $_SESSION['ErrorMessage'] = "Category Name is Required";
        }elseif($admin->checkSingleColumn('tblcategory','cat_name',$name)){
            $_SESSION['ErrorMessage'] = "Category Name Already Exist";
        }else{
            $name = $admin->validateInput($name);
            $name = strtolower($name);

            if($category->saveCategory($name) === true){
                $_SESSION['SuccessMessage'] =  "Category Added Successfully";    
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Add Category";
            }
            
        } 
    }elseif(isset($_POST['btnUpdateCategory']) AND !empty($_POST['btnUpdateCategory'])){ // profile update

        $cat_id = $_POST['cat_id'];
        $name = $_POST['name'];
            
        // Form Validation 
        if(empty($name)){
            $_SESSION['ErrorMessage'] = "Category Name is Required";
        }else{

            $cat_id = $admin->validateInput($cat_id);
            $name = $admin->validateInput($name);
            $name = strtolower($name);

            if($category->updateCategory($cat_id,$name) === true){
                $_SESSION['SuccessMessage'] =  "Category Updated Successfully";    
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Update Category";
            }
            
        } 
    }

?>
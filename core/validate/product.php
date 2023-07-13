<?php
    include('../core/init.php');

    if(isset($_POST['btnAddProduct']) && !empty($_POST['btnAddProduct'])){
        
        $pname = $_POST['pname'];
        $cat_id = $_POST['cat_id'];
        $sku = $_POST['sku'];
        $old_price = $_POST['old_price'];
        $new_price = $_POST['new_price'];
        $stock = $_POST['stock'];
        $description = $_POST['description'];

        // Form Validation 
        if(empty($pname) || empty($cat_id) || empty($sku) || empty($new_price) || empty($stock) || empty($description)){
            $_SESSION['ErrorMessage'] = "All fields are Required";
        }elseif($admin->checkSingleColumn('tblproducts','sku',$sku)){
            $_SESSION['ErrorMessage'] =  "Product SKU Already Exist";
            return;
        }elseif(!preg_match("/^[0-9]*$/", $stock)){
            $_SESSION['ErrorMessage'] =  "Only Numbers Allowed for Stock";
            return;
        }

        // validating our data
        $pname = $admin->validateInput($pname);
        $cat_id = $admin->validateInput($cat_id);
        $sku = $admin->validateInput($sku);
        $old_price = $admin->validateInput($old_price);
        $new_price = $admin->validateInput($new_price);
        $stock = $admin->validateInput($stock);
        $description = $admin->validateInput($description);

        // convert the product name to lowercase
        $pname = strtolower($pname);

        // get the product image(s)
        $product_image = $_FILES['product_image']['name'];

        // save the product
        if($product->addProduct($pname,$sku,$new_price,$old_price,$description,$cat_id,$stock,'1',"") === true){

            $product_id = $admin->get('tblproducts','sku',$sku); // get the product id using the sku
            #var_dump($product_id->id);exit();

            // get the product image(s)
            $product_image = $_FILES['product_image']['name'];

            $count = count($_FILES['product_image']['name']);
            #echo $count;exit();


            // loop through the numbers of images being uploaded
            for ($i = 0; $i < $count; $i++) {

                $product_image = $_FILES['product_image']['name'];

                //specifying the supported file extension
                $validextensions = ['jpg', 'png', 'jpeg'];
                $ext = explode('.', basename($_FILES['product_image']['name'][0]));

                //explode file name from dot(.)
                $file_extension = end($ext);

                $getImageID = uniqid().time(); #generate a unique id
                $hashImageID = sha1($getImageID); #encrypt the unique id
                $useImageID = "PRO".date('Ymdi').substr($hashImageID, 2, 4); #split the unique id
                $useImageID = strtoupper($useImageID);

                $product_image = $useImageID.".".$file_extension;
                $target = '../assets/images/products/' . $product_image;

                if(!in_array($file_extension, $validextensions)){ 
                    $_SESSION['ErrorMessage'] = "Please select a valid picture format";
                    return;
                }

                // move product image to its target folder
                move_uploaded_file($_FILES['product_image']['tmp_name'][$i],  $target);

                if($product->addProductImage($product_id->id,$sku,$product_image)){
                    if($product->updateProductImage($product_id->id,$product_image) === true){
                        $_SESSION['SuccessMessage'] =  "Product Added Successfully";
                    }
                }
            }
        }

    }elseif(isset($_POST['btnDisableProduct']) AND !empty($_POST['btnDisableProduct'])){ // disable product

        $product_id = $_POST['product_id'];
            
        $product_id = $admin->validateInput($product_id);

        if($product->disableProduct($product_id) === true){
            $_SESSION['SuccessMessage'] =  "Product Has Been Deactivated";    
        }else{
            $_SESSION['ErrorMessage'] =  "Failed To Deactivate Product";
        }
    }elseif(isset($_POST['btnEnableProduct']) AND !empty($_POST['btnEnableProduct'])){ // enable product profile

        $product_id = $_POST['product_id'];
            
        $product_id = $admin->validateInput($product_id);

        if($product->enableProduct($product_id) === true){
            $_SESSION['SuccessMessage'] =  "Product Has Been Activated";    
        }else{
            $_SESSION['ErrorMessage'] =  "Failed To Activate Product";
        }
    }if(isset($_POST['btnUpdateProduct']) && !empty($_POST['btnUpdateProduct'])){ // edit product
        
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $cat_id = $_POST['cat_id'];
        $sku = $_POST['sku'];
        $old_price = $_POST['old_price'];
        $new_price = $_POST['new_price'];
        $stock = $_POST['stock'];
        $description = $_POST['description'];

        // Form Validation 
        if(empty($pname) || empty($cat_id) || empty($sku) || empty($new_price) || empty($stock) || empty($description)){
            $_SESSION['ErrorMessage'] = "All fields are Required";
        }elseif(!preg_match("/^[0-9]*$/", $stock)){
            $_SESSION['ErrorMessage'] =  "Only Numbers Allowed for Stock";
            return;
        }

        // validating our data
        $pid = $admin->validateInput($pid);
        $pname = $admin->validateInput($pname);
        $cat_id = $admin->validateInput($cat_id);
        $sku = $admin->validateInput($sku);
        $old_price = $admin->validateInput($old_price);
        $new_price = $admin->validateInput($new_price);
        $stock = $admin->validateInput($stock);
        $description = $admin->validateInput($description);

        // convert the product name to lowercase
        $pname = strtolower($pname);
        $updated_date = date("d M Y g:i A");

        // update the product
        if($product->updateProduct($pid,$pname,$sku,$new_price,$old_price,$description,$cat_id,$stock,$updated_date) === true){
            if($product->updateProductImageTable($pid,$sku) === true){
                $_SESSION['SuccessMessage'] =  "Product Updated Successfully";
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Update Product SKU";
            }

        }else{
            $_SESSION['ErrorMessage'] =  "Failed To Update Product";
        }

    }elseif(isset($_POST['btnSubmitReview']) && !empty($_POST['btnSubmitReview'])){ // submit review
        
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        $product_id = $_POST['product_id'];

        // Form Validation 
        if(empty($rating) || empty($review)){
            $_SESSION['ErrorMessage'] = "All fields are Required";
        }elseif(!preg_match("/^[0-9]*$/", $product_id)){
            return;
        }else{

            // validating our data
            $rating = $admin->validateInput($rating);
            $review = $admin->validateInput($review);
            $product_id = $admin->validateInput($product_id);

            $date_reviewed = date("d M Y g:i A");

            // getting customer id
            $getCustomer = $user->getCustomerData($_SESSION['email']);

            if($admin->addReview($product_id,$getCustomer->id,$rating,$review,$date_reviewed) === true){
                $_SESSION['SuccessMessage'] =  "Review Submitted";
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Submit Review";
            }
        }

    }if(isset($_POST['btnAddToCart']) && !empty($_POST['btnAddToCart'])){ // add item to cart
        
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

            #var_dump($total);exit();

            if($order->addToCart("",$getCustomer->id,$fetchProduct->id,$price,$quantity,$total,'0') === true){
                if($order->reduceStock($fetchProduct->id,$quantity) === true){
                    $_SESSION['SuccessMessage'] =  "Item Added To Cart";
                }
            }else{
                $_SESSION['ErrorMessage'] =  "Failed To Add Item To Cart";
            }

        }

    }


?>
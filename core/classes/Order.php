<?php

	class Order extends Admin{

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

        public function addToCart($invoiceno,$customer_id,$product_id,$price,$quantity,$total,$status){

			$stmt = $this->pdo->prepare("SELECT * FROM `tblorder` WHERE `customer_id` = :customer_id AND `product_id` = :product_id AND invoiceno = '' ");
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
			$stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        	$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			$count = $stmt->rowCount();

			if($count > 0){

				$stmt = $this->pdo->prepare("UPDATE `tblorder` SET quantity = quantity + :quantity, total = quantity * price,status = '0'  WHERE customer_id = :customer_id AND product_id = :product_id AND invoiceno = '' ");
				$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
				$stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
				$stmt->bindParam(":quantity", $quantity, PDO::PARAM_STR);
				$stmt->execute();
				return true;

			}else{

				$stmt = $this->pdo->prepare("INSERT INTO tblorder (invoiceno,customer_id,product_id,price,quantity,total,status) VALUES(:invoiceno,:customer_id,:product_id,:price,:quantity,:total,:status)");
				$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
				$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_STR);
				$stmt->bindParam(":product_id", $product_id, PDO::PARAM_STR);
				$stmt->bindParam(":price", $price, PDO::PARAM_STR);
				$stmt->bindParam(":quantity", $quantity, PDO::PARAM_STR);
				$stmt->bindParam(":total", $total, PDO::PARAM_STR);
				$stmt->bindParam(":status", $status, PDO::PARAM_STR);
				$stmt->execute();

				return true;

			}
			
		}

		public function addOrderPayment($invoiceno,$customer_id,$surname,$other_name,$email,$phone,$gender,$state,$address,$order_status,$date_paid,$time_paid,$payment_status){
			$stmt = $this->pdo->prepare("INSERT INTO tblorder_payment (invoiceno,customer_id,surname,other_name,email,phone,gender,state,address,order_status,date_paid,time_paid,payment_status) VALUES(:invoiceno,:customer_id,:surname,:other_name,:email,:phone,:gender,:state,:address,:order_status,:date_paid,:time_paid,:payment_status)");
			$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_STR);
			$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
			$stmt->bindParam(":other_name", $other_name, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
			$stmt->bindParam(":state", $state, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_STR);
			$stmt->bindParam(":order_status", $order_status, PDO::PARAM_STR);
			$stmt->bindParam(":date_paid", $date_paid, PDO::PARAM_STR);
			$stmt->bindParam(":time_paid", $time_paid, PDO::PARAM_STR);
			$stmt->bindParam(":payment_status", $payment_status, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateCart($invoiceno,$customer_id){

			$stmt = $this->pdo->prepare("UPDATE `tblorder` SET invoiceno = :invoiceno  WHERE customer_id = :customer_id AND invoiceno = '' ");
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
			$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
			$stmt->execute();
			return true;
			
		}

		public function removeFromCart($id){
			$stmt = $this->pdo->prepare("DELETE FROM tblorder WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();

			return true;
		}

		public function fetchShippingAddressDetails($customer_id){
			$stmt = $this->pdo->prepare("SELECT * FROM tblorder_payment WHERE customer_id = :customer_id AND invoiceno = '' ");
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_OBJ);
		}

		public function reduceStock($id,$quantity){
			$stmt = $this->pdo->prepare("UPDATE tblproducts SET stock=stock - :quantity WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":quantity", $quantity, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function increaseStock($id,$quantity){
			$stmt = $this->pdo->prepare("UPDATE tblproducts SET stock=stock + :quantity WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":quantity", $quantity, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function fetchCartItems($customer_id){
			$stmt = $this->pdo->prepare("SELECT * FROM tblorder WHERE customer_id = :customer_id AND invoiceno = '' AND quantity > 0 AND status = 0 ");
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function getCartSum($customer_id){
        	$stmt = $this->pdo->prepare("SELECT SUM(total) FROM `tblorder` WHERE customer_id = :customer_id AND invoiceno = '' AND status = '0' ");
        	$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_STR);
			$stmt->execute();
			$total = $stmt->fetch(PDO::FETCH_NUM);
			return $total_income = $total[0];
        }

		public function increaseCartQuantity($id){
			$stmt = $this->pdo->prepare("UPDATE tblorder SET quantity = quantity + 1, total = quantity * price WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function decreaseCartQuantity($id){
			$stmt = $this->pdo->prepare("UPDATE tblorder SET quantity = quantity - 1, total = quantity * price WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function addTransaction($customer_id,$invoiceno,$service_type,$description,$amount,$oldbalance,$newbalance,$date){
			$stmt = $this->pdo->prepare("INSERT INTO tbltransaction (customer_id,invoiceno,service_type,description,amount,oldbalance,newbalance,date) VALUES(:customer_id,:invoiceno,:service_type,:description,:amount,:oldbalance,:newbalance,:date)");
			$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
			$stmt->bindParam(":service_type", $service_type, PDO::PARAM_STR);
			$stmt->bindParam(":description", $description, PDO::PARAM_STR);
			$stmt->bindParam(":amount", $amount, PDO::PARAM_STR);
			$stmt->bindParam(":oldbalance", $oldbalance, PDO::PARAM_STR);
			$stmt->bindParam(":newbalance", $newbalance, PDO::PARAM_STR);
			$stmt->bindParam(":date", $date, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function deductUserBalance($id,$amount){
			$stmt = $this->pdo->prepare("UPDATE tblcustomer SET balance = balance - '$amount' WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateOrderPayment($invoiceno,$amount,$date_paid,$time_paid,$customer_id){
			$stmt = $this->pdo->prepare("UPDATE tblorder_payment SET invoiceno = :invoiceno, amount = :amount,date_paid = :date_paid, time_paid = :time_paid, payment_status = '1' WHERE customer_id=:customer_id AND invoiceno = '' ");
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_STR);
			$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
			$stmt->bindParam(":amount", $amount, PDO::PARAM_STR);
			$stmt->bindParam(":time_paid", $time_paid, PDO::PARAM_STR);
			$stmt->bindParam(":date_paid", $date_paid, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateCartStatus($invoiceno,$customer_id){
			$stmt = $this->pdo->prepare("UPDATE tblorder SET invoiceno = :invoiceno, status = '1' WHERE customer_id=:customer_id AND invoiceno = '' ");
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_STR);
			$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function fetchUsersTransactions($customer_id){
			$stmt = $this->pdo->prepare("SELECT * FROM tblorder_payment WHERE customer_id = :customer_id AND payment_status = 1 ");
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function isCartEmpty($customer_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tblorder` WHERE `invoiceno` = '' AND customer_id = :customer_id");
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_STR);
			$stmt->execute();

			$user = $stmt->fetch(PDO::FETCH_OBJ);
			$count = $stmt->rowCount();

			if($count > 0){
                return true;
			}else{
				return false;
			}
		}


	}

?>
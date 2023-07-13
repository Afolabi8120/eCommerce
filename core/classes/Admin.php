<?php

	class Admin {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

		public function validateInput($var){
			$var = htmlspecialchars($var);
			$var = trim($var);
			$var = stripcslashes($var);
			return $var;
		}

        public function checkSingleColumn($table,$column,$value){
        	$stmt = $this->pdo->prepare("SELECT `$column` FROM `$table` WHERE `$column` = :value ");
        	$stmt->bindParam(":value", $value, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

		public function exportStudentList(){
			$stmt = $this->pdo->prepare("SELECT * FROM tblstudent WHERE usertype = 'Student' ");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function countSingle($table){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` ");
			$stmt->execute();

			$user = $stmt->fetch(PDO::FETCH_OBJ);
			$count = $stmt->rowCount();

			return $count;
		}

		public function getCartNotification($customer_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tblorder` WHERE `customer_id` = :customer_id AND invoiceno = '' AND quantity > 0 AND status = '0' ");
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
        	$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

		public function count($table,$column,$value){
			$stmt = $this->pdo->prepare("SELECT COUNT(`$column`) FROM `$table` WHERE `$column` = '$value' ");
			$stmt->execute();

			$count = $stmt->fetchColumn();

			return $count;
		}

		public function Sum($customer_id,$invoiceno){
        	$stmt = $this->pdo->prepare("SELECT SUM(total) FROM `tblorder` WHERE `customer_id` = :customer_id AND invoiceno = :invoiceno ");
        	$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
        	$stmt->bindParam(":invoiceno", $invoiceno, PDO::PARAM_STR);
        	$stmt->execute();
			$total = $stmt->fetch(PDO::FETCH_NUM);
			return $total_income = $total[0];
        }

		public function check($table,$column,$value){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value'");
			$stmt->execute();

			$user = $stmt->fetch(PDO::FETCH_OBJ);
			$count = $stmt->rowCount();

			if($count > 0){
                return true;
			}else{
				return false;
			}
		}

		// add review
		public function addReview($product_id,$customer_id,$rating,$review,$date_reviewed){
			$stmt = $this->pdo->prepare("INSERT INTO tblreview (product_id,customer_id,rating,review,date_reviewed) VALUES(:product_id,:customer_id,:rating,:review,:date_reviewed)");
			$stmt->bindParam(":product_id", $product_id, PDO::PARAM_STR);
			$stmt->bindParam(":customer_id", $customer_id, PDO::PARAM_STR);
			$stmt->bindParam(":rating", $rating, PDO::PARAM_STR);
			$stmt->bindParam(":review", $review, PDO::PARAM_STR);
			$stmt->bindParam(":date_reviewed", $date_reviewed, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function get($table,$column,$value){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = :value ");
			$stmt->bindParam(":value", $value, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_OBJ);
		}

		public function disable($id,$table,$value){
			$stmt = $this->pdo->prepare("UPDATE `$table` SET status = 'in-active' WHERE id= '$id' ");
			$stmt->execute();
			return true;
		}

		public function enable($id,$table,$value){
			$stmt = $this->pdo->prepare("UPDATE `$table` SET status = 'active' WHERE id= '$id' ");
			$stmt->execute();
			return true;
		}

		public function selectAll($table,$column,$value){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value'");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function select($table){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` ORDER BY id ASC");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function updateSession($username,$session){
			$stmt = $this->pdo->prepare("UPDATE tbluser SET session=:session WHERE username = :username ");
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->bindParam(":session", $session, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function getSession($username){
			$stmt = $this->pdo->prepare("SELECT session FROM tbluser WHERE username = :username");
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_OBJ);
		}

	}

?>
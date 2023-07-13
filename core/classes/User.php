<?php

	class User extends Admin{

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

		public function passwordMatch($password,$cpassword){
			if($password === $cpassword){
				return true;
			}else{
				return false;
			}
		}

        public function saveToken($email, $token){
        	$stmt = $this->pdo->prepare("INSERT INTO tblreset (email,token) VALUES(:email, :token)");
        	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
        	$stmt->bindParam(":token", $token, PDO::PARAM_STR);
        	$stmt->execute();
        	return true;
        }

        public function delete($table,$column,$value){
        	$stmt = $this->pdo->prepare("DELETE FROM `$table` WHERE `$column` = :value");
        	$stmt->bindParam(":table", $table, PDO::PARAM_STR);
        	$stmt->bindParam(":column", $column, PDO::PARAM_STR);
        	$stmt->bindParam(":value", $value, PDO::PARAM_STR);
        	$stmt->execute();
        	return true;
        }

		public function register($surname,$other_name,$email,$phone,$balance,$pin,$gender,$state,$address,$status,$usertype,$password,$picture,$session,$auth){
			$stmt = $this->pdo->prepare("INSERT INTO tblcustomer (surname,other_name,email,phone,balance,pin,gender,state,address,status,usertype,password,picture,session,auth) VALUES(:surname,:other_name,:email,:phone,:balance,:pin,:gender,:state,:address,:status,:usertype,:password,:picture,:session,:auth)");
			$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
			$stmt->bindParam(":other_name", $other_name, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":balance", $balance, PDO::PARAM_STR);
			$stmt->bindParam(":pin", $pin, PDO::PARAM_STR);
			$stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
			$stmt->bindParam(":state", $state, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":usertype", $usertype, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":picture", $picture, PDO::PARAM_STR);
			$stmt->bindParam(":session", $session, PDO::PARAM_STR);
			$stmt->bindParam(":auth", $auth, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function manualPayment($email,$receipt_no,$amount_paid,$payment_status,$section){
			$stmt = $this->pdo->prepare("INSERT INTO tblpayment (email,receipt_no,amount_paid,payment_status,section) VALUES(:email,:receipt_no,:amount_paid,:payment_status,:section)");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":receipt_no", $receipt_no, PDO::PARAM_STR);
			$stmt->bindParam(":amount_paid", $amount_paid, PDO::PARAM_STR);
			$stmt->bindParam(":payment_status", $payment_status, PDO::PARAM_STR);
			$stmt->bindParam(":section", $section, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function login($email,$password){
			$stmt = $this->pdo->prepare("SELECT * FROM tblcustomer WHERE email = :email AND password = :password");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->execute();

			$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
		}

		public function updateProfile($id,$surname,$other_name,$email,$phone,$gender,$state,$address){
			$stmt = $this->pdo->prepare("UPDATE tblcustomer SET surname=:surname,other_name=:other_name,email=:email,phone=:phone,gender=:gender,state=:state,address=:address WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
			$stmt->bindParam(":other_name", $other_name, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
			$stmt->bindParam(":state", $state, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updatePassword($id,$password){
			$stmt = $this->pdo->prepare("UPDATE tblcustomer SET password=:password WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateImage($id,$picture){
			$stmt = $this->pdo->prepare("UPDATE tblcustomer SET picture=:picture WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":picture", $picture, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updatePin($id,$pin){
			$stmt = $this->pdo->prepare("UPDATE tblcustomer SET pin=:pin WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":pin", $pin, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateTwoStepVerification($id,$auth){
			$stmt = $this->pdo->prepare("UPDATE tblcustomer SET auth=:auth WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":auth", $auth, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateResetPassword($email,$password){
			$stmt = $this->pdo->prepare("UPDATE tblstudent SET password=:password WHERE email=:email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateResetPasswordStatus($email){
			$stmt = $this->pdo->prepare("UPDATE tblreset SET status='1' WHERE email=:email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function deleteToken($email,$token){
			$stmt = $this->pdo->prepare("DELETE FROM tblreset WHERE token=:token AND email=:email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":token", $token, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function getCustomerData($email){
			$stmt = $this->pdo->prepare("SELECT * FROM tblcustomer WHERE email = :email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_OBJ);
		}

		public function getResetEmail($token){
			$stmt = $this->pdo->prepare("SELECT * FROM tblreset WHERE token = :token");
			$stmt->bindParam(":token", $token, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_OBJ);
		}

		public function updateSession($email,$session){
			$stmt = $this->pdo->prepare("UPDATE tblcustomer SET session=:session WHERE email = :email ");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":session", $session, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function getSession($email){
			$stmt = $this->pdo->prepare("SELECT session FROM tblcustomer WHERE email = :email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_OBJ);
		}

		public function checkIfTokenExist($token){
			$stmt = $this->pdo->prepare("SELECT * FROM tblreset WHERE token=:token ");
			$stmt->bindParam(":token", $token, PDO::PARAM_STR);
			$stmt->execute();

			$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
		}


	}

?>
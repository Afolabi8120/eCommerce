<?php

	class Category extends Admin{

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

        public function saveCategory($name){
        	$stmt = $this->pdo->prepare("INSERT INTO tblcategory (cat_name) VALUES(:cat_name)");
        	$stmt->bindParam(":cat_name", $name, PDO::PARAM_STR);
        	$stmt->execute();
        	return true;
        }

		public function updateCategory($id,$cat_name){
			$stmt = $this->pdo->prepare("UPDATE tblcategory SET cat_name=:cat_name WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":cat_name", $cat_name, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}


	}

?>
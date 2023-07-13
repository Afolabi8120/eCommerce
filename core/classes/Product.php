<?php

	class Product extends Admin{

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

        public function addProduct($product_name,$sku,$new_price,$old_price,$description,$category_id,$stock,$status,$picture){
			$stmt = $this->pdo->prepare("INSERT INTO tblproducts (product_name,sku,new_price,old_price,description,category_id,stock,status,picture) VALUES(:product_name,:sku,:new_price,:old_price,:description,:category_id,:stock,:status,:picture)");
			$stmt->bindParam(":product_name", $product_name, PDO::PARAM_STR);
			$stmt->bindParam(":sku", $sku, PDO::PARAM_STR);
			$stmt->bindParam(":new_price", $new_price, PDO::PARAM_STR);
			$stmt->bindParam(":old_price", $old_price, PDO::PARAM_STR);
			$stmt->bindParam(":description", $description, PDO::PARAM_STR);
			$stmt->bindParam(":category_id", $category_id, PDO::PARAM_STR);
			$stmt->bindParam(":stock", $stock, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":picture", $picture, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateProduct($id,$product_name,$sku,$new_price,$old_price,$description,$category_id,$stock,$updated_date){
			$stmt = $this->pdo->prepare("UPDATE tblproducts SET product_name=:product_name,sku=:sku,new_price=:new_price,old_price=:old_price,description=:description,category_id=:category_id,stock=:stock,updated_date=:updated_date WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":product_name", $product_name, PDO::PARAM_STR);
			$stmt->bindParam(":sku", $sku, PDO::PARAM_STR);
			$stmt->bindParam(":new_price", $new_price, PDO::PARAM_STR);
			$stmt->bindParam(":old_price", $old_price, PDO::PARAM_STR);
			$stmt->bindParam(":description", $description, PDO::PARAM_STR);
			$stmt->bindParam(":category_id", $category_id, PDO::PARAM_STR);
			$stmt->bindParam(":stock", $stock, PDO::PARAM_STR);
			$stmt->bindParam(":updated_date", $updated_date, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function addProductImage($product_id,$product_sku,$picture){
			$stmt = $this->pdo->prepare("INSERT INTO tblproduct_image (product_id,product_sku,picture) VALUES(:product_id,:product_sku,:picture)");
			$stmt->bindParam(":product_id", $product_id, PDO::PARAM_STR);
			$stmt->bindParam(":product_sku", $product_sku, PDO::PARAM_STR);
			$stmt->bindParam(":picture", $picture, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateProductImage($id,$picture){
			$stmt = $this->pdo->prepare("UPDATE tblproducts SET picture=:picture WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":picture", $picture, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateProductImageTable($id,$product_sku){
			$stmt = $this->pdo->prepare("UPDATE tblproduct_image SET product_sku=:product_sku WHERE product_id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":product_sku", $product_sku, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function fetchAllProduct(){
			$stmt = $this->pdo->prepare("SELECT * FROM tblproducts AS p INNER JOIN tblproduct_image AS i ON p.id = i.product_id ");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function disableProduct($id){
			$stmt = $this->pdo->prepare("UPDATE tblproducts SET status = '0' WHERE id= '$id' ");
			$stmt->execute();
			return true;
		}

		public function enableProduct($id){
			$stmt = $this->pdo->prepare("UPDATE tblproducts SET status = '1' WHERE id= '$id' ");
			$stmt->execute();
			return true;
		}

		public function fetchProductForUser(){
			$stmt = $this->pdo->prepare("SELECT * FROM tblproducts WHERE status = 1 AND stock > 0 ORDER BY RAND() ");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function fetchSimilarProduct($category_id,$product_id){
			$stmt = $this->pdo->prepare("SELECT * FROM tblproducts WHERE status = 1 AND category_id = :category_id AND id != :product_id ");
			$stmt->bindParam(":category_id", $category_id, PDO::PARAM_STR);
			$stmt->bindParam(":product_id", $product_id, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function fetchAllReview($product_id){
			$stmt = $this->pdo->prepare("SELECT * FROM tblreview AS r INNER JOIN tblcustomer AS c ON c.id = r.customer_id WHERE r.product_id = :product_id ");
			$stmt->bindParam(":product_id", $product_id, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}


	}

?>
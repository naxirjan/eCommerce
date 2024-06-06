<?php
	require_once("../business_logic_layer/bll_sub_category.php");

	Class SubCategoryDAL extends SubCategoryBLL
	{
		private $connection;

		public function __construct($hostname, $username, $password, $database){
			$this->connection = mysqli_connect($hostname, $username, $password, $database);

			if(mysqli_connect_errno())
			{
				echo "Database Connection Problem ".mysqli_connect_error()."<br />";
			}
		}


    		public function AddSubCategory() {
            
			$query = "INSERT INTO sub_category (category_id,sub_category) VALUES('".$this->getMainCategoryId()."','".$this->getSubCategory()."')";

			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));

			if($result)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

    
            public function getSubCategories(){
            $query = "SELECT category.category_id,category.category_title,sub_category.sub_category_id,sub_category.sub_category, sub_category.status FROM category,sub_category WHERE category.category_id=sub_category.category_id";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            } 
        
        
            public function getSubCategoryById(){
            $query = "SELECT * FROM sub_category WHERE sub_category_id='".$this->getSubCategoryId()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            }
        
            public function getSubCategoryByMainCategoryId(){
            $query = "SELECT sub_category.sub_category_id,sub_category.sub_category,sub_category.category_id, category.category_id FROM sub_category,category WHERE sub_category.category_id=category.category_id AND category.category_id= '".$this->getMainCategoryId()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            }
        
            
            public function getSubCategoryByStatus(){
            $query = "SELECT * FROM sub_category WHERE status='".$this->getStatus()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            } 
        
            public function updateSubCategory(){
            $query = "UPDATE sub_category SET sub_category='".$this->getSubCategory()."' WHERE sub_category_id='".$this->getSubCategoryId()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            } 
        
            
            public function enableSubCategory(){
            $query = "UPDATE sub_category SET status='".$this->getStatus()."' WHERE sub_category_id='".$this->getSubCategoryId()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            } 
        
    }
?>
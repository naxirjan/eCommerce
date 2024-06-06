<?php
	require_once("../business_logic_layer/bll_category.php");

	Class CategoryDAL extends CategoryBLL
	{
		private $connection;

		public function __construct($hostname, $username, $password, $database){
			$this->connection = mysqli_connect($hostname, $username, $password, $database);

			if(mysqli_connect_errno())
			{
				echo "Database Connection Problem ".mysqli_connect_error()."<br />";
			}
		}


    		public function AddMainCategory() {
            
			$query = "INSERT INTO category (category_title) VALUES('".$this->getMainCategory()."')";

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

    
            public function getMainCategories(){
            $query = "SELECT * FROM category ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            } 
        
        
            public function getMainCategoryById(){
            $query = "SELECT * FROM category WHERE category_id='".$this->getMainCategoryId()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            } 
        
            public function getMainCategoryByStatus(){
            $query = "SELECT * FROM category WHERE status='".$this->getStatus()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            } 
        
            public function updateMainCategory(){
            $query = "UPDATE category SET category_title='".$this->getMainCategory()."' WHERE category_id='".$this->getMainCategoryId()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            } 
        
            
            public function enableMainCategory(){
            $query = "UPDATE category SET status='".$this->getStatus()."' WHERE category_id='".$this->getMainCategoryId()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
            } 
        
    }
?>
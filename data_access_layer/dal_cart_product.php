<?php
		require_once("../business_logic_layer/bll_cart_product.php");
		





		class Cart_Product_DAL extends Cart_Product_BLL
		{
			private $connection;
			
		
           	public function __construct($hostname, $username, $password, $database){
			$this->connection = mysqli_connect($hostname, $username, $password, $database);

			if(mysqli_connect_errno())
			{
				echo "Database Connection Problem ".mysqli_connect_error()."<br />";
			}
		} 
            

            
			public function getCartProduct()
			{
				$query = "SELECT * FROM cart_product WHERE cart_id = ".$this->getCartId()." AND product_id = ".$this->getProductId();
				$result = mysqli_query($this->connection,$query);
				if($result)
					return $result;
				else
				return mysqli_error($this->connection);
					
			}
            
            	public function updateCartProduct()
			{				
				$query = "UPDATE cart_product SET quantity = ".$this->getQuantity()." WHERE cart_id = ".$this->getCartId()." AND product_id = ".$this->getProductId();
	 		  	$result = mysqli_query($this->connection,$query);
				if($result)
				{
					return $result;
				}
			  	else
				{
					return mysqli_error($this->connection);
			    }
			}
			public function deleteCartProduct()
			{
		$query = "DELETE FROM cart_product WHERE cart_id = ".$this->getCartId()." AND product_id = ".$this->getProductId()." ";
				
				$result = mysqli_query($this->connection,$query);
				if($result){
					return $result;}
				else{
				return mysqli_error($this->connection);
			}}
		

			public function addCartProduct()
			{									
				$query = "INSERT INTO cart_product ( cart_id, product_id, quantity) VALUES( ".$this->getCartId().", ".$this->getProductId().", ".$this->getQuantity()." )";
				$result = mysqli_query($this->connection,$query);
				if($result)
				{
					return $result;
				}
			  	else
				{
					 return mysqli_error($this->connection);;
			    }
			}
		

			public function getCartProducts()
			{
				$query = "SELECT c.product_id, c.quantity,p.stock,p.product,p.price FROM cart_product c,product p WHERE c.product_id = p.product_id  AND c.cart_id = ".$this->getCartId();
				 $result = mysqli_query($this->connection,$query);
				if($result){
					return $result;
                }else{
				 return mysqli_error($this->connection);
			
                
        			}        
                }



		public function getCartProductsForDetails()
			{
$query = "SELECT p.product,p.price,p.free_shipping ,c.quantity,p.price*c.quantity ,p.product,p.price
 FROM cart_product c,product p 
WHERE c.product_id = p.product_id AND c.cart_id =".$this->getCartId()." ";
 $result = mysqli_query($this->connection,$query);
				if($result){
					return $result;
                }else{
				 return mysqli_error($this->connection);
}

}            
  	}

?>
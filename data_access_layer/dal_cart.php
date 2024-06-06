<?php
		require_once("../business_logic_layer/bll_cart.php");
		







		class Cart_DAL extends Cart_BLL
		{
			private $connection;
			
		public function __construct($hostname, $username, $password, $database){
			$this->connection = mysqli_connect($hostname, $username, $password, $database);

			if(mysqli_connect_errno())
			{
				echo "Database Connection Problem ".mysqli_connect_error()."<br />";
			}
		}
		
			public function addCart(&$insert_id)
			{									
				$query = "INSERT INTO cart (user_id) VALUES( ".$this->getUserId()." )";
				$result = mysqli_query($this->connection,$query);
				if($result == true)
				{
					$insert_id = $this->connection->insert_id;
					return $result;
				}
				else
				return mysqli_error($this->connection);
			}
			public function updateCartStatus()
			{				
				$query = "UPDATE cart SET status = ".$this->getStatus()." WHERE cart_id = ".$this->getCartId();
	 		  	$result = mysqli_query($this->connection,$query);
			  if($result)
					return $result;
				else
				return mysqli_error($this->connection);
			}

			public function deleteCart()
			{
				$query = "DELETE FROM cart WHERE cart_id = ".$this->getCartId();
				$result = mysqli_query($this->connection,$query);
				if($result)
					return $result;
				else
				return mysqli_error($this->connection);
			}
			public function getCart()
			{
				$query = "SELECT * FROM cart WHERE cart_id = ".$this->getCartId();
				 $result = mysqli_query($this->connection,$query);
				if($result->num_rows)
					return $result;
				else
					return mysqli_fetch_assoc($this->connection);
					
			}
			public function getUserCart()
			{
				$query = "SELECT cart_id FROM cart WHERE user_id = ".$this->getUserId()." AND status = 0";
				 $result = mysqli_query($this->connection,$query);
				if($result->num_rows)
					return $result;
				else
					return mysqli_error($this->connection);
					
			}

            public function getCarts()
			{
				$query = "SELECT * FROM cart WHERE user_id = ".$this->getUserId()." AND cart_id = ".$this->getCartId();
				$result = mysqli_query($this->connection,$query);
			if($result){
                return $result;
            }
            else{
                return mysqli_fetch_assoc($this->connection);
            }    
                
            }			
		
        
            //My getters & setters
            
            
                public function getPendingCartProducts(){
        
            $query="SELECT  user.user_id,user.first_name, product.product_id,product.product,product.price,cart_product.quantity,product.price*cart_product.quantity AS 'Sub Total',cart.status FROM USER, product,cart_product,cart WHERE 
            cart.user_id=user.user_id AND cart.cart_id=cart_product.cart_id AND product.product_id=cart_product.product_id AND cart.status=0 AND user.user_id= ".$this->getUserId()." ";
                    
            	$result = mysqli_query($this->connection,$query);
			if($result){
                return $result;
            }
            else{
                return mysqli_fetch_assoc($this->connection);
            }    
                 
    }    
       
            
            
            public function countCart(){
                
            $query="SELECT SUM(cart_product.quantity) FROM cart_product,cart WHERE cart_product.cart_id=cart.cart_id AND cart.status=0 AND cart.user_id=".$this->getUserId()." ";    
          
            	$result = mysqli_query($this->connection,$query);
			if($result){
                return $result;
            }
            else{
                return mysqli_error($this->connection);
            }    
            }
        
        }

?>
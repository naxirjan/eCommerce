<?php
	session_start();

	class Session
	{
	
        
        
        
        	public function setAdminSession($admin)
		{
			$_SESSION["admin"] = $admin;
		}


		 	public function setUserSession($user)
		{
			$_SESSION["user"] = $user;
		}

	
 public function isAdmin(){
if (!isset($_SESSION["admin"]["email"]) && $_SESSION["admin"]["role_id"]!=1) {
header("location:../Admin/index.php?message=Please Signin First!...");
}
}

        
        
public function isUser(){
if (!isset($_SESSION["user"]["email"]) && $_SESSION["user"]["role_id"]!=2) {
header("location:../User/signin.php?message=Please Signin First!...");
}
}
        


public function isSessionUserId(){
if (isset($_SESSION["user"]["email"]) && $_SESSION["user"]["role_id"]==2) {
return true;
}
else{
return false;
}
}
        
    

		public function getUserId()
		{
			return $_SESSION["user"]["user_id"];
		}

		public function destroyAdminSession()
		{
			session_destroy(); if(isset($_SESSION["admin"]["email"])){
           unset($_SESSION["admin"]["email"]);
                
            }
        
        }
        public function destroyUserSession()
		{
		
            if(isset($_SESSION["user"]["email"])){
           unset($_SESSION["user"]["email"]);
                
            }

        }
        

        
     public function addProductInSession($product_id,$product_name,$quantity,$price)
		{
			$product['product_id']=$product_id;
            $product['product_name'] = $product_name;
			$product['quantity'] = $quantity;
			$product['price'] = $price;
			if(isset($_SESSION['products'][$product_id]) && $quantity == 0)
			{
				$this->deleteProductSession($_SESSION['products'][$product_id]);
			}
			else if(!isset($_SESSION['products'][$product_id]))
			{
				if($quantity > 0)
				{
                     $msg1='<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Product Has Been Added Into Cart!...</div>';
					$_SESSION['products'][$product_id] = $product;
					return $msg1;
				}
			}
			else
			{

                $msg1='<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Product Exists Aleready, Quantity Has Been Increased!...</div>';
                $msg2='<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Product Has Already Been Added Into Cart!...</div>';
				if($quantity > 0 && $_SESSION['products'][$product_id]['quantity'] != $quantity)
				{
					$_SESSION['products'][$product_id]['quantity'] = $quantity;
					return $msg1;
				}
				return $msg2;
			}
		}
        //Plural
		public function getSessionProducts()
		{
			if(isset($_SESSION['products']))
			{
				return $_SESSION['products'];
			}
			else
			{
				return false;
			}
		}
//Plural More Products
		public function deleteProductsSession()
		{
			if(isset($_SESSION['products']) || count($_SESSION['products']) <= 0)
			{
				unset($_SESSION['products']);
			}
		}

		public function deleteProductSession($product_id)
		{
			if(isset($_SESSION['products'][$product_id]))
			{
				unset($_SESSION['products'][$product_id]);
				if(count($_SESSION['products']) <= 0)
				{
				$this->deleteProductsSession();
                    //Check This
				}
			}
		}
	    
        
        
        
        
	}
?>
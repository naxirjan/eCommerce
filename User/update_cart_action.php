<?php
	

require_once("../library/session.php");
require_once("../library/database.php");
require_once("../data_access_layer/dal_cart.php");
require_once("../data_access_layer/dal_cart_product.php");
require_once("../data_access_layer/dal_user.php");

	


if(isset($_POST['btn-update-cart']))
	{

		
        $session  = new Session();
        
	  
      
   	
		  
        if($session->isSessionUserId())
		{
	
            
        $database = new Database();
             $dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);


    $cart = new Cart_DAL($database->hostname, $database->username, $database->password, $database->database);
    
        $cartProduct = new Cart_Product_DAL($database->hostname, $database->username, $database->password, $database->database);    
            
            
            
            
            $cart->setUserId($_SESSION['user']['user_id']);

			$result = $cart->getUserCart();
			if($result->num_rows)
			{
				$row = mysqli_fetch_assoc($result);
				$cartProduct->setCartId($row['cart_id']);
				$flag = 0;
				for($i = 1; isset($_REQUEST['product_id'.$i]); $i++)
				{
				$cartProduct->setProductId($_REQUEST['product_id'.$i]);
				$cartProduct->setQuantity($_REQUEST['quantity'.$i]);

				$result = $cartProduct->getCartProduct();
				if($result->num_rows)
						{
                        if($cartProduct->getQuantity() <=0)
							{
								$result = $cartProduct->deleteCartProduct();
							}
							else
							{
								
								$result = $cartProduct->updateCartProduct();								
							}	
							echo "Product has been updated ".$result;						
				  //  header("location:view_cart_items.php?message=Product has been added ".$result);
	            	
                }
						else
						{
							if($cartProduct->getQuantity() > 0)
							{
								$result = $cartProduct->addCartProduct();
							}
						echo "Product has been added ".$result;
                	//header("location:view_cart_items.php?message=Product has been added ".$result);
	            
                            
						}
						if($result=== true)
						{     $id=$cartProduct->getProductId();
							$session->deleteProductSession($id);
							$flag++;
						}					
					}					
			}
			else
			{
				$result = $cart->addCart($cartId);
				if($result=== true)
				{
					$cartProduct->setCartId($cartId);
					$flag = 0;
					for($i = 1; isset($_REQUEST['product_id'.$i]); $i++)
					{
						$cartProduct->setProductId($_REQUEST['product_id'.$i]);
						$cartProduct->setQuantity($_REQUEST['quantity'.$i]);
						if($cartProduct->getQuantity() > 0)
						{
							$result = $cartProduct->addCartProduct();
						}
						else
						{
                            $id=$cartProduct->getProductId();
							$session->deleteProductSession($id);
						}
						if($result)
						{
                            $id=$cartProduct->getProductId();    
							$session->deleteProductSession($id);
							$flag++;
						}
					}					
				}
			}
			header("location:view_cart_items.php?message=$flag products updated successfully");
		}
        
		else
		{		
			for($i = 1; isset($_POST['product_id'.$i]); $i++)
			{
				if($_POST['quantity'.$i] <= 0)
				{
					$session->deleteProductSession($_POST['product_id'.$i]);
				}
				else
				{
				 $session->addProductInSession($_POST['product_id'.$i],$_POST['product_name'.$i],$_POST['quantity'.$i],$_POST['price'.$i]);
				
                
                }
			}
			$i-=1;
			header("location:view_cart_items.php?message=$i products updated successfully.");
			exit();
		}


}

?>
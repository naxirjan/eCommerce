<?php

require_once("../library/session.php");
require_once("../library/database.php");
require_once("../data_access_layer/dal_cart.php");
require_once("../data_access_layer/dal_cart_product.php");




	

$error=false;

$error_message="";
$success_message="";
$stock="";


	if(isset($_REQUEST['product_id']))
	{$stock=$_REQUEST['stock'];
        
    if($_REQUEST['quantity']>$stock){
      
        echo '<div class="alert alert-Info center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Alert </u> </strong>
                    Please insert less quantity, only '.$stock.' items are available in stock</div>';
    }    
                
        
else{            
        
        
        
		$session = new Session();
		if($session->isSessionUserId())
		{
			$database = new Database();
			$cart = new Cart_DAL($database->hostname, $database->username, $database->password, $database->database);	
			
            $cartProduct = new Cart_Product_DAL($database->hostname, $database->username, $database->password, 
                                                 $database->database);	
			$cart->setUserId($_SESSION['user']['user_id']);
			$result = $cart->getUserCart();
			if($result)
			{
				$row = mysqli_fetch_assoc($result);
				$cartProduct->setCartId($row['cart_id']);				
				
					
				$cartProduct->setProductId($_REQUEST['product_id']);
				$cartProduct->setQuantity($_REQUEST['quantity']);

						$result = $cartProduct->getCartProduct();
						if(is_object($result) && $result->num_rows){
							if($cartProduct->getQuantity() <=0)
							{
								$result = $cartProduct->deleteCartProduct();
                                if($result === true)
                                {
                                    
                                $error=false;    
								$success_message.= '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Product Has Been Deleted From Cart!...</div>';
                                }
                                    
                                   
							}
							else
							{
								$result = $cartProduct->updateCartProduct();
                                if($result === true){
                                $error=false;    
								$success_message.= '<div class="alert alert-success cenetr">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Product Has Been Updated Into Cart!...</div>';
                                }
                                else{
                                $error=true;    
                                     $error_message.='<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Fail, </u> </strong> Product Has Not Been Updated Into Cart</div>';
                                }
                                    
                                    
                                    							
							}	
													
						}
						else{
							if($cartProduct->getQuantity() > 0)
							{
								$result = $cartProduct->addCartProduct();
                                if($result === true)
                                {
                                    $error=false;
								$success_message .= '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Product Has Been Updated Into Cart!...</div>';
                                }
                                else
                                {
                                    $error=true;
                                     $error_message .='<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Fail, </u> </strong> Product Has Not Been Updated Into Cart</div>';
                                }
                          								
							}
						
						}
						
                
                if($result)
						{
                                
							$session->deleteProductSession($cartProduct->getProductId());
							$error=false;
                    $success_message.='<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success  </u> </strong> Product Has Been Added Into Cart</div>';
						}
                        else{
                            $error=true;
                            $error_message .='<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong>Product Has Not Been Added Into Cart</div>';
                           
                        }
										
			}
			else
			{
				$result = $cart->addCart($cartId);
				if($result)
				{
					$cartProduct->setCartId($cartId);					
					
						$cartProduct->setProductId($_REQUEST['product_id']);
						$cartProduct->setQuantity($_REQUEST['quantity']);
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
						{     $id=$cartProduct->getProductId();
							$session->deleteProductSession($id);
						$error=false;	
                         $success_message.='<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Product has Been Added!...</div>';
                                
                                							
						}
                 
				}
			}

        if($error==false){
            echo $success_message;
        }
        elseif($error==true){
         echo $error_message;   
        }    
    
        
        
        }
        
        else
		{
			$session = new Session();
			 $session->addProductInSession($_REQUEST['product_id'],$_REQUEST['product_name'], $_REQUEST['quantity'], $_REQUEST['price']);
            
            	echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Product Has Been Added Into Cart!...</div>';
		}//Else If user is not sign in
	

}// Else If stock is qreater than quantity
        
    }//Check Request ID


	else
	{
		echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Failed, </u> </strong> Opps, something gone wrong, please try again!...</div>';
	}
?>
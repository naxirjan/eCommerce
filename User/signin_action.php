<?php








require_once("../library/session.php");
require_once("../library/database.php");
require_once("../data_access_layer/dal_cart.php");
require_once("../data_access_layer/dal_cart_product.php");
require_once("../data_access_layer/dal_user.php");


$session  = new Session();
$database = new Database();
	$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);

$cart = new Cart_DAL($database->hostname, $database->username, $database->password, $database->database);	
$cartProduct = new Cart_Product_DAL($database->hostname, $database->username, $database->password, 
                                                 $database->database);	
		
$error=true;
$error_message="";

if(isset($_POST['btn-sign-in'])){


$email=$_POST["email"];
$password =$_POST["password"];	
    
    
$email_pattern="/^[a-zA-Z_.]{5,12}@{1}[a-z]{5,8}.{1}[a-z]{2,3}$/i";	



/*Condition Email*/
if(!preg_match($email_pattern,$email) && $email!="") {
$error=false;	
$error_message.="Email : Email format must be correct<br />";
}
else if($email=="") {
$error=false;	
$error_message.="Email : Please Enter Your Email<br />";	
}
else {
$error_message.="";	
}
/*Condition Email*/


/*Condition Password*/
if($password=="") {	
$error=false;	
$error_message.="Password : Please Enter Your Password<br />";	
}
else {	
$error_message.="";	
}
/*Condition Password*/


if($error==true){
	$dal_user->setEmail($_POST["email"]);
	$dal_user->setPassword($_POST["password"]);
    $dal_user->setStatus(1);
    $dal_user->setUserRoleId(2);
	
    $result = $dal_user->signin();

	if($result->num_rows)
	{
		$user = mysqli_fetch_assoc($result);
		$session->setUserSession($user);
	
     

        
    $res_products = $session->getSessionProducts();
				if(isset($res_products) && count($res_products) > 0)
				{		
				$cart->setUserId($_SESSION['user']['user_id']);
					$result = $cart->getUserCart();
					if(is_object($result) && $result->num_rows)
					{
				        $row = mysqli_fetch_assoc($result)	;
						$cartProduct->setCartId($row['cart_id']);
					}
					else
					{
						$result = $cart->addCart($insert_id);
						if($result === true)
						{
							$cartProduct->setCartId($insert_id);
						}
					}
					$count = 0;
					foreach ($res_products as $productId => $values)
					{	
					
						$cartProduct->setProductId($productId);
						$cartProduct->setQuantity($values['quantity']);

						$result = $cartProduct->getCartProduct();
						if(is_object($result) && $result->num_rows){
					
							if($cartProduct->getQuantity() <= 0)
							{
								$result = $cartProduct->deleteCartProduct();
							}
							else
							{
								$cartProductRow = mysqli_fetch_assoc($result);
								$cartProduct->setQuantity($values['quantity']+$cartProductRow['quantity']);	
								$result = $cartProduct->updateCartProduct();								
							}	
						}
						else{
							
							if($cartProduct->getQuantity() > 0)
							{
								$result = $cartProduct->addCartProduct();
							}
							
						}
						
                        if($result === true)
						{
                            
                            echo $id=$cartProduct->getProductId();
							$session->deleteProductSession($id);
							$count++;
						}					
					}
                
				header("location:view_cart_items.php");
			}
    else{
        header("location:index.php");
    }    
        
        
        
        
        
        
        
        
        
        
	}
	else
	{
		header("location: signin.php?message=Authentication failed, email or password wrong.");
	}
}

else{
$error=false;
header("location:signin.php?message=$error_message");        
}


}














?>
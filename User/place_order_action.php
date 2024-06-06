<?php








require_once("../library/session.php");
require_once("../library/database.php");
require_once("../data_access_layer/dal_cart.php");
require_once("../data_access_layer/dal_order.php");
require_once("../data_access_layer/dal_user.php");
require_once("../data_access_layer/dal_cart_product.php");
require_once("../data_access_layer/dal_product.php");
require_once("../lib_email/PHPMailerAutoload.php");


$session  = new Session();
$database = new Database();

$dal_order = new OrderDAL($database->hostname, $database->username, $database->password, $database->database);

$dal_user= new UserDAL($database->hostname, $database->username, $database->password, $database->database);

$cart = new Cart_DAL($database->hostname, $database->username, $database->password, $database->database);	

$cart_product = new Cart_Product_DAL($database->hostname, $database->username, $database->password, $database->database);

$dal_product = new ProductDAL($database->hostname, $database->username, $database->password, $database->database);

 $dal_Product = new ProductDAL($database->hostname, $database->username, $database->password, $database->database); 


$orderDate=date("d-m-Y h:i:s");

$success="";
$error="";



if(isset($_POST['btn-place-order'])){
         
   

	$cart->setUserId($_SESSION['user']['user_id']);
		$result = $cart->getUserCart();
		$flag=true;
    
   
		if(is_object($result) && $result->num_rows)
		{
			$cart_result = mysqli_fetch_assoc($result);
            
			$dal_order->setCityId($_POST['city']);
			$dal_order->setEmail($_POST['email']);
			$dal_order->setBillingAddress($_POST['billing_address']);
			$dal_order->setShippingAddress($_POST['shipping_address']);
			$dal_order->setCell($_POST['cell']);
            $dal_order->setPaymentId($_POST['pay_method']);
          
	
			 $dal_order->setCartId($cart_result['cart_id']);
			 $cart->setCartId($cart_result['cart_id']);
			 $dal_order->setPaymentId($_POST['pay_method']);
			 $dal_order->setOrderDate($orderDate);
			 $dal_order->setDeliveryDate(date("Y-m-d H:i:s",strtotime("+3 day")));
			 $result =  $dal_order->addOrder();
             
			if($result === true)
			{
                
				$success .= "Order Has Been Placed Successfully, ";
				$cart->setStatus(1);
                $result = $cart->updateCartStatus();
				if($result === true)
				{
                    
             
             $cart_product->setCartId($dal_order->getCartId());
             $result_cart_product= $cart_product->getCartProducts();
                    
                if(is_object($result_cart_product) && $result_cart_product->num_rows)  {
                    
                    while($row=mysqli_fetch_assoc($result_cart_product)){
                
               $dal_product->setProductId($row['product_id']);
               $dal_product->setStock($row['quantity']);
               $result_update=$dal_product->decreaseStock();
                
                if($result_update)
                {
                 $success .="Stock Updated";   
                }
                else{
                    $flag=false;
                 $error.="Stock Not Updated";   
                }
          
            
            }       
                    
                }  
                    
                    
                    
                    
                    
                    $flag=true;
					$success .= " Pleas check your inbox!...";
            $dal_user->setEmail($_POST['email']);        
            $dal_user->setEmailMessage("<h2>Your order been placed suceessfully.</h2><br><h4>According to the delivery ploices, you will recieve it in 1st session within 3 days or in 2nd session within 7 days.</h4><br><p>For More Detail, Read our delivery policies. Thank you!..</p>");
             $dal_user->sendEmail("Customer Order Information");
				}
                else{
                $flag=false;    
                $error .="cart status not updated!...";    
                }
                
			}
			else
			{
				
			$flag = false;
             $error .="Order Has Not Been Added Succeesfully!...";   
			}
		}
else{
    $flag=false;
    $message .="Record Not Found!...";
  	 
}
			
    
    
    if($flag === true)
			{
	header("location:place_order.php?success=$success");	
			}
    
    if($flag === false)
			{
	header("location:place_order.php?success=$error");	
			}




}

	


?>
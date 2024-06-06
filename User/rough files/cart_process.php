<?php
require_once("../library/session.php");
$session  = new Session();





$error=true;







//btn add action
if(isset($_POST['add-cart'])){

    
    
        $pro_id=$_POST['pro_id'];
        $price=$_POST['price'];
        $quantity=$_POST['quantity'];    

//if suer is not signin
if(! $session->isSessionUserId()){

//if cart is empty then add data in cart
if(!isset($_SESSION['cart-items'])){
$product_price = ($price*$quantity);
$_SESSION['cart-items'] = array(array($pro_id ,$price,$quantity));       
  
$error=false;       
} 
            
else{        
foreach ($_SESSION['cart-items'] as $key => $value){

if($_SESSION['cart-items'][$key][0] == $pro_id){
$new_price =  $price*$quantity;
@$price2 =$_SESSION['cart-items'][$key][1]+$new_price;
@$quantity2 = $_SESSION['cart-items'][$key][2]+$quantity;

$_SESSION['cart-items'][$key][1] = $price2;
$_SESSION['cart-items'][$key][2] = $quantity2;
//header("location:preview.php?id=".$pro_id."&cart=success");
$error=false;
}				
}  
        
        
        
        
if($_SESSION['cart-items'][$key][0] != $pro_id){	
$price = $price*$quantity;
$array2 =array($pro_id ,$price,$quantity);
array_push($_SESSION['cart-items'],$array2);
//header("location:preview.php?id=".$pro_id."&cart=success");
$error=false;
}        
                         
 }
    
    
    
    
 if($error==false){
header("location:preview.php?id=".$pro_id."&cart=success");
}        
else{   
header("location:preview.php?id=".$pro_id."&cart=fail");    
}   
    
  
    
    
    
 }
    
 
    
    
/*
	if($session->isSessionUserId())
	{
		$query1 = "select * from cart";
		$sql1 = mysqli_query($con,$query1);
		$res1 = mysqli_fetch_assoc($sql1);
		var_dump($res1);
		print_r($res1);
		if($res1==null)
		{
			$session_id = session_id();
			$price = $_REQUEST['price'] *$_REQUEST['quantity'];
			$query2 = "INSERT INTO cart(user_id,session_id,product_id,quantity,price)VALUE('".$_SESSION['user']['user_id']."','$session_id','".$_REQUEST['product_id']."','".$_REQUEST['quantity']."','".$price."')";
			$sql2 = mysqli_query($con,$query2);
				header("location:check_product.php?flag=1&product_id=".$_REQUEST['product_id']);
			exit();	
		}
		else{
		do{ 
			if($res1['product_id'] == $_REQUEST['product_id'] && $res1['user_id'] == $_SESSION['user']['user_id'])
				{	

					@$price = $_REQUEST['price']*$_REQUEST['quantity'];
					@$price2 =$res1['price']+$price;
					@$quantity = $res1['quantity'] + $_REQUEST['quantity'];
					$query0 = "update cart set price='".$price2."',quantity ='".$quantity."' where product_id = '".$_REQUEST['product_id']."' and user_id = '".$_SESSION['user']['user_id']."'";
					$sql0 = mysqli_query($con,$query0);
					header("location:check_product.php?flag=1&product_id=".$_REQUEST['product_id']);
					break;	
				}					
				}while($res1 = mysqli_fetch_assoc($sql1));			
			}
					if($res1['product_id'] !== $_REQUEST['product_id'] )
					{	
							$session_id = session_id();
							$price = $_REQUEST['price'] *$_REQUEST['quantity'];
							$query2 = "INSERT INTO cart(user_id,session_id,product_id,quantity,price)VALUE('".$_SESSION['user']['user_id']."','$session_id','".$_REQUEST['product_id']."','".$_REQUEST['quantity']."','".$price."')";
		 				$sql2 = mysqli_query($con,$query2);	
		 				header("location:check_product.php?flag=1&product_id=".$_REQUEST['product_id']);	
					}
	}		
	*/		
    
    
    
    
}

?>     
            
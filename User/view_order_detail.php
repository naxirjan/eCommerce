<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- Update User</title>

  <?php
include_once("require/libs_header.php");
?>
  
    
    
     
    
   
</head>

<body>
   
    <?php
include_once("require/headerbar.php");

$session = new Session();
$session->isUser();
$database = new Database();
$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);
$dal_order = new  OrderDAL($database->hostname, $database->username, $database->password, $database->database);
  
$dal_cartproducts = new  Cart_Product_DAL($database->hostname, $database->username, $database->password, $database->database);

    
    
$result= $dal_order->getOrderByOrderId($_SESSION['user']['user_id'],$_REQUEST['orderid']); 
if(is_object($result) && $result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
    
$orderId=$row['order_id'];
$cartId=$row['cart_id'];
$payment_method=$row['method'];
$city=$row['city'];
$orderDate=$row['order_date'];
$deliveryDate=$row['delivery_date'];
$shippingAddress=$row['shipping_address'];
$billingAddress=$row['billing_address'];
$status=$row['status'];    

}
}
?>
    

    
    
<div class="ch-container">
    <div class="row">
        
      
    <?php
include_once("require/navbar.php");
?>
      <noscript>
     
            <div class="col-md-offset-3 col-md-5">
            <input type="button" value="Javascript Is Disabled Or Your Browser Does Not Support Javascript" class="btn btn-danger btn-lg ">    
</div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">View Order Details</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-glyphicon glyphicon-edit"></i> View Order Details</h2>

                <div class="box-icon">
                  
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
 
      
                
      <div class="well col-md-12 center login-box">
        
             <div id="msg"> </div> 
            
                <fieldset>
				<legend>Your Order Details</legend>
                    
        <div class="row"> 
                    
         <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Order Id:</span>
                        <input type="button" class="form-control btn-round" name="role" value="<?php echo $orderId;?>" >
                        
                           
                    </div>
					</div>
        <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Cart Id:</span>
                        <input type="button" class="form-control btn-round" name="role" value="<?php echo $cartId;?>" >
       
                    </div>
					</div>
        <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Status:</span>
                        <input type="button" class="form-control btn-round" name="role" value="<?php echo $status;?>" >
                        
                           
                    </div>
					</div> 
         </div>
               
            <div class="clearfix"></div><br />
                    
                    
                    <div class="row"> 
                    
         <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Order Date:</span>
                        <input type="button" class="form-control btn-round" name="role" value="<?php echo $orderDate;?>" >
                        
                           
                    </div>
					</div>
        <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Delivery Date:</span>
                        <input type="button" class="form-control btn-round" name="role" value="<?php echo $deliveryDate;?>" >
                        
                           
                    </div>
					</div>
        <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Payment Method:</span>
                        <input type="button" class="form-control btn-round" name="role" value="<?php echo $payment_method;?>" >
                        
                           
                    </div>
					</div> 
         </div>
               
            <div class="clearfix"></div><br />  
                    
                    
                
                    
               
                    <div class="row"> 
                    
         <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Billing Address:</span>
                        <input type="button" class="form-control btn-round" name="role" value="<?php echo $shippingAddress;?>" >
                        
                           
                    </div>
					</div>
        <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Shipping Address:</span>
                        <input type="button" class="form-control btn-round" name="role" value="<?php echo $shippingAddress;?>" >
                        
                           
                    </div>
					</div>
        <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">City:</span>
                        <input type="button" class="form-control btn-round" name="role" value="<?php echo $city;?>" >
                    </div>
					</div> 
         </div>
               
            <div class="clearfix"></div><br />              

       <div class="row">             
     <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">Product</th>
        <th style="text-align:center;">Price</th>
        <th style="text-align:center;">Quantity</th>
        
        <th style="text-align:center;">Shipping Charges</th>
        <th style="text-align:center;">Sub Total</th>

 
    </tr>
    </thead>
    <tbody>
        
    <?php
        
        
    $subTotal=0;    
    $total=0;    
    $dal_cartproducts->setCartId($cartId); 
$result= $dal_cartproducts-> getCartProductsForDetails(); 
if(is_object($result) && $result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
   
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['product']?></td>
        <td style="text-align:center;"><?php echo $row['price']?></td>
        <td style="text-align:center;"><?php echo $row['quantity']?></td>
        <td style="text-align:center;"><?php echo $row['free_shipping'];
        $subTotal=($row['price']+$row['free_shipping'] );
        $total+=$subTotal;    
        ?></td>
       
        <td style="text-align:center;"><?php  echo $subTotal;?></td>
        </tr>
        
<?php 
        
}           
}
else{
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Sorry, </strong>Records Not Found!...
                </div>';   
}        
        
        
?> 
        </tbody>
       
    </table>
           
    
           <div class="col-md-3 col-md-offset-9">  
               <button class="btn btn-primary btn-round"><span>Grand Total : <?php echo $total;?></span></button>
         </div>        
           
                    </div>       
                    
                    
                    
                    
    
                    
                    
                    
                    
                    
                    
   

                    
                   
                </fieldset>
           
        </div>
        <!--/span-->
        
         
                </div>
            </div>
        </div><!--/row-->
        <!-- content ends -->
 
            
           
        </div><!--/row-->
        <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

   
   

<?php
    include_once("require/footer.php");
?>


</div><!--/.fluid-container-->


<!-- external javascript -->

      <?php
include_once("require/libs_footer.php");
?>

<!-- external javascript -->


</body>
</html>

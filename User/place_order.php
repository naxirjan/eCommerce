<!DOCTYPE html>
<html lang="en">
<head>
<title>-Online Purchasing-Checkout</title>
 

    
    
    
<?php
require_once("require/libs_header.php");        
?> 
</head>

<body>
<?php
require_once("require/headerbar.php"); 
$session= new Session();
$session->isUser();    
$database = new Database();
$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);
    
  $cart = new Cart_DAL($database->hostname, $database->username, $database->password, $database->database);	
			$cartProduct = new Cart_Product_DAL($database->hostname, $database->username, $database->password, 
                                                 $database->database);	
$dal_Product = new ProductDAL($database->hostname, $database->username, $database->password, $database->database);  
		    
?>
    
    
  
<div class="ch-container" id="got-to-top">
    <div class="row">
        
        <noscript>
     
            <div class="col-md-offset-3 col-md-5">
            <input type="button" value="Javascript Is Disabled Or Your Browser Does Not Support Javascript" class="btn btn-danger btn-lg ">    
</div>
        </noscript>

          

    
        
        <div id="content" class="col-md-12">
      
            
            
                  
                <?php
                
                if(isset($_REQUEST['success'])){
                ?>
                <div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong><?php echo $_REQUEST['success'];?></div>    
                <?php    
                }
            if(isset($_REQUEST['error'])){
                ?>
                <div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Fail, </u> </strong><?php echo $_REQUEST['error'];?></div>    
                <?php    
                }
                
                
                
                
                ?>
                
                
            <form method="POST" action="place_order_action.php">    
              <div class="row">
        <div class="box col-md-8 col-md-offset-2">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-shopping-cart"></i> Shipping Details</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        
                    </div>
                </div>
                   <div class="box-content ">
                       
                <ul class="nav nav-tabs" id="myTab">
                    <li class=""><a href="#email"><i class="glyphicon glyphicon-envelope"></i> 1. Your Email</a></li>
                    <li class=""><a href="#address"><i class="glyphicon glyphicon-map-marker"></i> 2. Your Address</a></li>
                    <li class=""><a href="#summary"><i class="glyphicon glyphicon-list-alt"></i> 3. Order Summary</a></li>
                    <li class=""><a href="#payment"><i class="glyphicon glyphicon-usd"></i> 4. Payment</a></li>
                    
                </ul>

                <div id="myTabContent" class="tab-content">
                  
                    <br />
                    <div class="tab-pane" id="email">
                        
                    <div class="input-group col-md-8">
                    <span class="input-group-addon">Email Address:</span>
                    <input type="text" class="form-control" placeholder="user@gmail.com" name="email" value="<?php echo $_SESSION['user']['email'];?>">
                    </div>    
                    </div>
                    <div class="tab-pane" id="address">
                       
                    <div class="input-group col-md-10">
                    <span class="input-group-addon">Billing Address:</span>
                    <input type="text" class="form-control" placeholder="enter complete billing address with city and state" name="billing_address" value="<?php echo $_SESSION['user']['address'];?>">
                    </div><br />
                    
                        
                    
                     
                    <div class="input-group col-md-10">
                    <span class="input-group-addon">Shipping Address:</span>
                    <input type="text" class="form-control" placeholder="enter complete shipping address with city and state" name="shipping_address" value="<?php echo $_SESSION['user']['address'];?>">
                    </div><br />
                    
                     
                     <div class="input-group col-md-10">
                    <span class="input-group-addon">City:</span>
                    <select class="form-control" name="city">
                    <option value="">select the city</option>    
                    <?php
                         
                         
                         
                        
                        $result=$dal_user->getCities(); 
                         if($result->num_rows){
                        while($row=mysqli_fetch_assoc($result)){
                        ?>
                         <option value="<?php echo $row['city_id'];?>"><?php  echo $row['city'];?></option>
                        <?php 
                        }}
                         ?>
                         </select> 
                         
                         
                         </div><br />    
                        
                        
                    <div class="input-group col-md-10">
                    <span class="input-group-addon">Cell:</span>
                    <input type="text" class="form-control" placeholder="enter cell no" name="cell" value="<?php echo $_SESSION['user']['cell'];?>">
                    </div><br />
                        
                        
                    
                    </div>    
                    <div class="tab-pane" id="summary">
                    <?php
                        
                        
   if($session->isSessionUserId()){   
?>
<table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            
                            <th style="text-align:center;">Product Name</th>
                            <th style="text-align:center;">Price</th>
                            <th style="text-align:center;">Quantity</th>
                            <th style="text-align:center;">Discount (x%)</th>
                             <th style="text-align:center;">Sub Total</th>
                            
                    
                            
                        </tr>
                        </thead>
                        <tbody>
  
                            
              <?php
               
                        $count=0;
                        $i=0; 
                        $price=0;       
                        $cart->setUserId($_SESSION['user']['user_id']);
                       $result= $cart->getUserCart();           
                    if($result){    
                   
                                           
                    $row=mysqli_fetch_assoc($result);
                        
                    ?> 
                    <input type="hidden" value="<?php echo $row['cart_id'];?>" name="cart_id" />        
                   
      
                            <?php        
                    $cartProduct->setCartId($row['cart_id']);
                  
                    $result_cartProduct=$cartProduct->getCartProducts();    
                        
                    if($result_cartProduct->num_rows){
                   while($row_cartProduct=mysqli_fetch_assoc($result_cartProduct)){
                    $i+=1;
                       
                       $dal_Product->setProductId($row_cartProduct['product_id']);
                       $result_discount= $dal_Product->getProductDiscount(date('Y-m-d'));    
                        $row_discount=mysqli_fetch_assoc($result_discount);
                           
                
                if(isset($row_discount['product_discount']) && $row_discount['product_discount']>0){
$price=($row_cartProduct['price'] - ($row_cartProduct['price']*$row_discount['product_discount']/100));    
}else{
$price=$row_cartProduct['price'];    
 }    
         
                       
                       
                    ?>    
        <tr>
        <td style="text-align:center;"><?php echo $row_cartProduct['product'];?></td>
        <td style="text-align:center;"><?php echo $price;?></td>
        <td style="text-align:center;"><?php echo $row_cartProduct['quantity'];?></td>
        <td style="text-align:center;"><?php echo $row_discount['product_discount'];?></td>    
        
            <td style="text-align:center;">  
        <?php echo ($price*$row_cartProduct['quantity']);?></td>
        <input type="hidden" name="tmp_product_id" value="<?php echo $row_cartProduct['product_id'];?>" />
        <input type="hidden" name="tmp_quantity" value="<?php echo $row_cartProduct['quantity'];?>" />   
             
         </tr>
                  <?php        
                      $count+=($price*$row_cartProduct['quantity']);    
                   
                    }
                         }
                         
                        }
                    else{
                        echo "No Products";
                    }     

?>                    
    </tbody></table>
<div>    
<button class="btn btn-primary col-md-offset-7 col-md-5"><i class="glyphicon glyphicon-usd"></i>&nbsp;<?php echo "Total Amount : ".$count;?></button>

                  </div>                         
<?php 
 }  
                   
elseif(!$session->isSessionUserId()){        
$result=$session->getSessionProducts();    
?>    
<table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            
                            <th style="text-align:center;">Product Name</th>
                            <th style="text-align:center;">Price</th>
                            <th style="text-align:center;">Quantity</th>
                             <th style="text-align:center;">Sub Total</th>
                            
                    
                            
                        </tr>
                        </thead>
                        <tbody>
  
                            
                        <?php
               
                        $count=0;
                        $i=0; 
                        if($result){    
                            
                    foreach($result as $key=>$value){
                   $i+=1;
                       
                    ?>    
                   
                            
                    
                        <tr>
                            
                             <td style="text-align:center;"><?php echo $result[$key]['product_name'];?></td>
                             <td style="text-align:center;"><?php echo $result[$key]['price'];?></td>
                             <td style="text-align:center;"><?php echo $result[$key]['quantity'];?></td>
                
                            <td style="text-align:center;">  <?php echo ($result[$key]['price']*$result[$key]['quantity']);?></td>
               
               <input type="hidden" value="<?php echo $result[$key]['product_id'];?>" name="product_id<?php echo $i;?>" />             
                <input type="hidden" value="<?php echo $result[$key]['product_name'];?>" name="product_name<?php echo $i;?>" /> 
                <input type="hidden" value="<?php echo $result[$key]['quantity'];?>" name="quantity<?php echo $i;?>" />
                <input type="hidden" value="<?php echo $result[$key]['price'];?>" name="price<?php echo $i;?>" />            
              
                            
                            
                            </tr>
                   <?php        
                     $count+=($result[$key]['price']*$result[$key]['quantity']);    
                    }
                        }
                    ?>
                    
                        </tbody>
                   
                    </table> 
<div>    
<button class="btn btn-primary col-md-offset-7 col-md-5"><i class="glyphicon glyphicon-usd"></i>&nbsp;<?php echo "Total Amount : ".$count;?></button>
                    
                    
                  </div>                         
<?php
}
?>        
   
                  </div>
                    <div class="tab-pane " id="payment">
                        
                       
                <div class="radio">
                    <label>
                        <input type="radio" name="pay_method" id="pay_method" value="1" >
                        Mobicash Payment Method
                    </label>
                </div>
            
                    <div class="radio ">
                    <label>
                        <input type="radio" name="pay_method" id="pay_method" value="2" >
                        Easypaisa Payment Method
                    </label>
                </div>
            
                        <div class="radio">
                    <label>
                        <input type="radio" name="pay_method" id="pay_method" value="3" >
                       Credit Card Payment Method
                    </label>
                </div>
            
                        <div class="radio">
                    <label >
                        <input type="radio" name="pay_method" id="pay_method" value="4" >
                        Bank Transfer Payment Method
                    </label>
                </div>
                    
            
                    <div class="radio">
                        
                    <label>
                        <input type="radio" name="pay_method" id="pay_method" value="5" >
                        Cash On Delivery Payment Method
                    </label>
                </div>
             
               
                        
                <div> <input type="submit" name="btn-place-order" value="Place Order Now" class="btn btn-primary col-md-3 col-md-offset-9">
                      </div>        
                       
                        
                        
                        <?php
                        if(isset($_REQUEST['message'])){
                            
                            echo $_REQUEST['message']; 
                        }
                        
                        ?>
                        
                </div>            
               
             
                       
            
                       
            </div>
            </div> 
                    
            </div>
        </div>
        <!--/span-->

    </div><!--/row-->
</form>
            
            
            
            
            
      
             
</div><!--/fluid-row-->

    </div> 
    


</div><!--/.fluid-container-->

    
<!-- external javascript -->  
<?php
require_once("require/libs_footer.php");        
?> 
<!-- external javascript -->


</body>
</html>

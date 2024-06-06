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

    
    
            $database = new Database();
             $sesion=new Session();
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
                
                if(isset($_REQUEST['message'])){
                ?>
                <div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong>&nbsp;<?php echo $_REQUEST['message'];?></div>    
                <?php    
                }
                
                
                
                
                ?>
                
                
              <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-shopping-cart"></i> Your Cart Details</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        
                    </div>
                </div>
             <form method="POST" action="update_cart_action.php">    
                <div class="box-content">
                    
             <?php
        if($session->isSessionUserId())
		{   
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
                        $cart->setUserId($_SESSION['user']['user_id']);
                       $result= $cart->getUserCart();           
                    if($result){    
                   
                                           
                    $row=mysqli_fetch_assoc($result);
                        
                       
                    $cartProduct->setCartId($row['cart_id']);
                  
                    $result_cartProduct=$cartProduct->getCartProducts();    
                        
                    if($result_cartProduct->num_rows){
                      $price=0;  
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
<td style="text-align:center;"><?php  echo $price;?>
</td>
                        
                    <td style="text-align:center;"><input type="number" class="form-control" value="<?php echo $row_cartProduct['quantity'];?>" name="quantity<?php echo $i;?>" min="0" max="20"></td>
                             
                    <td style="text-align:center;">  <?php echo $row_discount['product_discount'];?></td>
          
                         <td style="text-align:center;">  <?php echo ($price*$row_cartProduct['quantity']);?></td>
      
            <input type="hidden" value="<?php echo $row_cartProduct['product_id'];?>" name="product_id<?php echo $i;?>" /> 
                        
                        
            <input type="hidden" value="<?php echo $row_cartProduct['product'];?>" name="product_name<?php echo $i;?>" /> 
            
            <input type="hidden" value="<?php echo $price;?>" name="price<?php echo $i;?>" />            
                </tr>
                    <?php    
                    $count+=($price*$row_cartProduct['quantity']);    
                  
                    }    
                    }
                      else{
               echo "<script>window.location='index.php'</script>";
            }
                        
                    }
          
                    
                    ?>
                    </tbody>
                    </table>
                    <div>    
                    <input type="submit" value="Update" name="btn-update-cart" class="btn btn-primary col-md-offset-1 col-md-1" />    
                    <a  href="place_order.php" class="btn btn-success col-md-offset-2 col-md-4" >Process To Next Step&nbsp;<i class="glyphicon glyphicon-forward"></i><i class="glyphicon glyphicon-forward"></i></a>    
                    <button class="btn btn-primary col-md-offset-2 col-md-2"><i class="glyphicon glyphicon-usd"></i>&nbsp;<?php echo "Total Amount : ",$count;?></button>
                  </div>                 
<?php 
 }    
                    
    
                    
                    
                    
                    
                    
                    
        elseif(! $session->isSessionUserId()){
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
                             <td style="text-align:center;"><input type="number" class="form-control" value="<?php echo $result[$key]['quantity'];?>" name="quantity<?php echo $i;?>" min="0" max="20"></td>
                
                            <td style="text-align:center;">  <?php echo ($result[$key]['price']*$result[$key]['quantity']);?></td>
               <input type="hidden" value="<?php echo $result[$key]['product_id'];?>" name="product_id<?php echo $i;?>" />      
                <input type="hidden" value="<?php echo $result[$key]['product_name'];?>" name="product_name<?php echo $i;?>" /> 
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
                    <input type="submit" value="Update" name="btn-update-cart" class="btn btn-primary col-md-offset-1 col-md-1" />    
                    <a  href="place_order.php" class="btn btn-success col-md-offset-2 col-md-4" >Process To Next Step&nbsp;<i class="glyphicon glyphicon-forward"></i><i class="glyphicon glyphicon-forward"></i></a>    
                    <button class="btn btn-primary col-md-offset-2 col-md-2"><i class="glyphicon glyphicon-usd"></i>&nbsp;<?php echo "Total Amount : ",$count;?></button>
                  </div>                 
                    
    <?php                
     }        
    ?>           
                 </div>
              </form>      
            </div>
        </div>
        <!--/span-->

    </div><!--/row-->

            
            
            
            
            
      
             
</div><!--/fluid-row-->

    </div> 
    

    
    
<?php
require_once("require/footer.php");        
?>  

</div><!--/.fluid-container-->

    
<!-- external javascript -->  
<?php
require_once("require/libs_footer.php");        
?> 
<!-- external javascript -->


</body>
</html>

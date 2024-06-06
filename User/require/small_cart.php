<!-- topbar starts -->
    
<div class="col-md-5 ">
</div>
<div class="col-md-5 ">
</div>




    <div class="col-md-2">
        <a  class="well top-block" >
            <i class="glyphicon glyphicon-shopping-cart red"></i>

            <div>Cart Items</div>
        
            
            
            
            <?php
           
            $database = new Database();
             $sesion=new Session();
            
            $cart = new Cart_DAL($database->hostname, $database->username, $database->password, $database->database);	
			$cartProduct = new Cart_Product_DAL($database->hostname, $database->username, $database->password, 
                                                 $database->database);	
			    
            
            if($sesion->isSessionUserId())
            {
              $res=0;  
            $cart->setUserId($_SESSION['user']['user_id']);
			$result = $cart->countCart();
		   if($result->num_rows){
            $row= mysqli_fetch_assoc($result);   
           foreach ($row as $key => $value) {
              $res= $value; 
           }
            }


if($res>0){
?>
<form method="POST" action="view_cart_items.php">
            <div><input type="submit" value="View Cart" name="btn-view-cart" class="btn btn-round"/></div>
            </form> 

   <span class="notification red"><?php echo $res;?></span>         
<?php
}
else{
?>
<span class="notification red">
 <?php if(!$res>0){echo "0";}
else{
   echo $res; 
}
?>
</span>    
 <?php
} 
          }//signin user    
            
            
            
            
            elseif(! $sesion->isSessionUserId())
            {
             $result=$session->getSessionProducts();
            if($result){
            ?>
            <form method="POST" action="view_cart_items.php">
            <div><input type="submit" value="View Cart" name="btn-view-cart" class="btn btn-round"/></div>
            </form>    
            <?php
            }
           ?>
            <span class="notification red">
              <?php if($result){
            echo  count($result);        
                }
                else{
                    echo "0";
                }
                ?>
            </span>
           <?php
            }
            ?>
            
           
        
                 
           
        </a>
    </div>    
    

            
            
       
    <!-- topbar ends -->

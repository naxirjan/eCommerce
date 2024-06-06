



<?php



require_once("../library/session.php");
require_once("../library/database.php");
require_once("../data_access_layer/dal_order.php");
require_once("../data_access_layer/dal_cart_product.php");
require_once("../data_access_layer/dal_product.php");
require_once("../lib_email/PHPMailerAutoload.php");


$session  = new Session();
$session->isUser();
$database = new Database();
$dal_order = new  OrderDAL($database->hostname, $database->username, $database->password, $database->database);
    

//Cancel Order
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==1) {
   
    
        $dal_order->setOrderId($_REQUEST['orderid']);
        $dal_order->setStatus("cancelled");
        $result = $dal_order->changeOrderStatus()();

if ($result) {

    
    
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
                      
    
    
    
    
    
    
    
    echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert")>×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Order Has Been Cancelled successfully!...
                </div>';
?>    
    

<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">Order ID</th>
        <th style="text-align:center;">Cart ID</th>
        <th style="text-align:center;">Order Date</th>
        <th style="text-align:center;">Delivery Date</th>
        <th style="text-align:center;">Shipping Address</th>
        <th style="text-align:center;">Billing Address</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
     
$result= $dal_order->getAllOrdersByUserId($_SESSION['user']['user_id']); 
if(is_object($result) && $result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['order_id']?></td>
        <td style="text-align:center;"><?php echo $row['cart_id']?></td>
        <td style="text-align:center;"><?php echo $row['order_date']?></td>
        <td style="text-align:center;"><?php echo $row['delivery_date']?></td>
        <td style="text-align:center;"><?php echo $row['shipping_address']?></td>
       <td style="text-align:center;"><?php echo $row['billing_address']?></td>
        <td style="text-align:center;">
            <?php
          if($row['status']=='pending'){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']=='cancelled'){
            ?>    
            <span class="label-danger label label-default"><?php echo "Cancelled";?></span>
            <?php    
            }                                 
           
            elseif($row['status']=='delivered'){
            ?>    
            <span class="label-success label label-default"><?php echo "Delivered";?></span>
            <?php    
            }
             elseif($row['status']=='processed'){
            ?>    
            <span class="label-info label label-default"><?php echo "Processed";?></span>
            <?php    
            }                            
            ?>
            
            
        </td>   
        <td style="text-align:center;">
            <a class="btn btn-info btn-sm" href="">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                View
            </a>
         
            <?php
            if($row['status']=='pending'){
            ?>    
           <input  type="button" class="btn btn-danger btn-sm"  value="Cancel" onclick="CancelOrder(<?php echo $row['order_id']?>)">
            <?php    
            } 
            else{
            ?>    
            
            <input  type="button" class="btn btn-danger btn-sm"   value="Cancel" onclick="CancelOrder(<?php echo $row['order_id']?>)" disabled>
            <?php  
            }                            
            ?>
                 
        </td>
        <input type="hidden" id="orderid<?php echo $row['order_id']?>" value="<?php echo $row['order_id']?>">
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
   
    
<?php    
}else{
	echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> 
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Order Has Not Been Cancelled successfully!...
                </div>';
?>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">Order ID</th>
        <th style="text-align:center;">Cart ID</th>
        <th style="text-align:center;">Order Date</th>
        <th style="text-align:center;">Delivery Date</th>
        <th style="text-align:center;">Shipping Address</th>
        <th style="text-align:center;">Billing Address</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
     
$result= $dal_order->getAllOrdersByUserId($_SESSION['user']['user_id']); 
if(is_object($result) && $result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['order_id']?></td>
        <td style="text-align:center;"><?php echo $row['cart_id']?></td>
        <td style="text-align:center;"><?php echo $row['order_date']?></td>
        <td style="text-align:center;"><?php echo $row['delivery_date']?></td>
        <td style="text-align:center;"><?php echo $row['shipping_address']?></td>
       <td style="text-align:center;"><?php echo $row['billing_address']?></td>
        <td style="text-align:center;">
            <?php
          if($row['status']=='pending'){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']=='cancelled'){
            ?>    
            <span class="label-danger label label-default"><?php echo "Cancelled";?></span>
            <?php    
            }                                 
           
            elseif($row['status']=='delivered'){
            ?>    
            <span class="label-success label label-default"><?php echo "Delivered";?></span>
            <?php    
            }
             elseif($row['status']=='processed'){
            ?>    
            <span class="label-info label label-default"><?php echo "Processed";?></span>
            <?php    
            }                            
            ?>
            
            
        </td>   
        <td style="text-align:center;">
            <a class="btn btn-info btn-sm" href="">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                View
            </a>
         
            <?php
            if($row['status']=='pending'){
            ?>    
           <input  type="button" class="btn btn-danger btn-sm"  value="Cancel" onclick="CancelOrder(<?php echo $row['order_id']?>)">
            <?php    
            } 
            else{
            ?>    
            
            <input  type="button" class="btn btn-danger btn-sm"   value="Cancel" onclick="CancelOrder(<?php echo $row['order_id']?>)" disabled>
            <?php  
            }                            
            ?>
                 
        </td>
        <input type="hidden" id="orderid<?php echo $row['order_id']?>" value="<?php echo $row['order_id']?>">
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


<?php
}
}
?>



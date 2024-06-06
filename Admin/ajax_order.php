



<?php



require_once("../library/session.php");
require_once("../library/database.php");
require_once("../data_access_layer/dal_order.php");

$session  = new Session();
$session->isAdmin();
$database = new Database();
$dal_order = new  OrderDAL($database->hostname, $database->username, $database->password, $database->database);
    

//Process Order
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==1) {
   
    
        $dal_order->setOrderId($_REQUEST['orderid']);
        $dal_order->setStatus("processed");
        $result = $dal_order->changeOrderStatus()();

if ($result) {
    
    
    $dal_user->setEmail($_POST['email']);        
            $dal_user->setEmailMessage("<h2>Your order been placed suceessfully.</h2><br><h4>According to the delivery ploices, you will recieve it in 1st session within 3 days or in 2nd session within 7 days.</h4><br><p>For More Detail, Read our delivery policies. Thank you!..</p>");
             $dal_user->sendEmail("Customer Order Information");
			
    
    
	echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert")>×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Order Has Been Processed Forward Successfully!...
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
     
$result= $dal_order->getAllUserOrders(); 
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
            <a class="btn btn-primary btn-sm" href="view_user_order_detail.php?orderid=<?php echo $row['order_id']; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                View
            </a>
         
            <?php
            if($row['status']=='pending'){
            ?>    
           <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
            <?php    
            } 
            elseif($row['status']=='processed'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" >
 
            
            <?php  
            } 
             elseif($row['status']=='delivered'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
 
            
            <?php  
            } 
            elseif($row['status']=='cancelled'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
 
            
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
	echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong>Order Has Not Been Cancelled successfully!...
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
     
$result= $dal_order->getAllUserOrders(); 
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
            <a class="btn btn-primary btn-sm" href="view_user_order_detail.php?orderid=<?php echo $row['order_id']; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                View
            </a>
         
            <?php
            if($row['status']=='pending'){
            ?>    
           <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
            <?php    
            } 
            elseif($row['status']=='processed'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" >
 
            
            <?php  
            } 
             elseif($row['status']=='delivered'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
 
            
            <?php  
            } 
            elseif($row['status']=='cancelled'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
 
            
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



//Complete Order
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==2) {
   
    
        $dal_order->setOrderId($_REQUEST['orderid']);
        $dal_order->setStatus("delivered");
        $result = $dal_order->changeOrderStatus();

if ($result) {
	echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert")>×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Order Has Been Completed Successfully!...
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
     
$result= $dal_order->getAllUserOrders(); 
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
            <a class="btn btn-primary btn-sm" href="view_user_order_detail.php?orderid=<?php echo $row['order_id']; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                View
            </a>
         
            <?php
            if($row['status']=='pending'){
            ?>    
           <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
            <?php    
            } 
            elseif($row['status']=='processed'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" >
 
            
            <?php  
            } 
             elseif($row['status']=='delivered'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
 
            
            <?php  
            } 
            elseif($row['status']=='cancelled'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
 
            
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
	echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> 
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Order Has Not Been Completed successfully!...
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
     
$result= $dal_order->getAllUserOrders(); 
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
            <a class="btn btn-primary btn-sm" href="view_user_order_detail.php?orderid=<?php echo $row['order_id']; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                View
            </a>
         
            <?php
            if($row['status']=='pending'){
            ?>    
           <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
            <?php    
            } 
            elseif($row['status']=='processed'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" >
 
            
            <?php  
            } 
             elseif($row['status']=='delivered'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
 
            
            <?php  
            } 
            elseif($row['status']=='cancelled'){
            ?>    
              <input  type="button" class="btn btn-info btn-sm"  value="Process" onclick="ProcessOrder(<?php echo $row['order_id']?>)" disabled >
        
            <input  type="button" class="btn btn-success btn-sm"  value="Complete" onclick="CompleteOrder(<?php echo $row['order_id']?>)" disabled>
 
            
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
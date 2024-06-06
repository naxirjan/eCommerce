<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- View Orders</title>
    
<script>
function ProcessOrder(id){
var orderid = document.getElementById("orderid"+id).value;
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("order_result").innerHTML= ajax.responseText;
}
}

ajax.open("GET","ajax_order.php?flag=1&orderid="+orderid);
ajax.send();    
}
    
function CompleteOrder(id){
var orderid = document.getElementById("orderid"+id).value;
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("order_result").innerHTML= ajax.responseText;
}
}

ajax.open("GET","ajax_order.php?flag=2&orderid="+orderid);
ajax.send();    
}
    
    
    </script>     
    

  
 <?php      
    
include_once("require/libs_header.php");
?>
  
</head>

<body>
   
    
    <?php

    include_once("require/header.php");

    
 $session = new Session();
    $session->isAdmin();
    $database = new Database();
	$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);
    
    
    
    $dal_order = new  OrderDAL($database->hostname, $database->username, $database->password, $database->database);
     
    
    
?>
    
    
<div class="ch-container">
    <div class="row">
        
      
    <?php
include_once("require/nav_bar.php");
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
            <a href="#">View User Orders</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-eye-open"></i> View User Orders</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                
                </div>
            </div>
            <?php
            
            if(isset($_REQUEST['message'])){
            echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Report Has Been Generated Successfullys!...
                </div>';    
                
                
            }
            
            ?>
            
            
            <br />
            <form method="post" action="generate_reports.php">
            &nbsp;<input type="submit" value="Generate Report" class="btn btn-round btn-success"/>
            </form>
        <br />    
            <div class="box-content" id="order_result"> 
            
              
            
         <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">Order No</th>
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
      
                
                
                
                
                
                
                
                
                
            </div>
                </div>
            </div>
        </div><!--/row-->
        <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->


    
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>  

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

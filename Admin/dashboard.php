
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>N-Online Purchasing- Dashboard</title>
    

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
    $dal_product = new  ProductDAL($database->hostname, $database->username, $database->password, $database->database);

    
    ?>
    
    
<div class="ch-container">
    <div class="row">
        
      
    <?php
include_once("require/nav_bar.php");
?>

        
        <noscript>
     
            <div class="col-md-offset-2 col-md-5">
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
            <a href="#">Dashboard</a>
        </li>
    </ul>
</div>
<div class=" row">
   
    
    <div class="col-md-4 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="View User Requests" class="well top-block" href="account_requests.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Total Registered Users</div>
            <div><?php 
                $dal_user->setStatus(0);
                $result = $dal_user->getTotalRegisteredUsers();
                if($result->num_rows){
                $row= mysqli_fetch_assoc($result);    
                echo implode($row);    
                }
                ?></div>
            <span class="notification"><?php 
                $dal_user->setStatus(0);
                $result = $dal_user->getTotalPendingUsers();
                if($result->num_rows){
                $row= mysqli_fetch_assoc($result);    
                echo implode($row);    
                }
                ?></span>
        </a>
    </div>

    <div class="col-md-4 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="4 new orders." class="well top-block" href="view_orders.php">
            <i class="glyphicon glyphicon-shopping-cart green"></i>

            <div>Total Delivered Orders</div>
            <div><?php 
                $dal_order->setStatus("delivered");
                $result=$dal_order->countOrdersByStatus();
                if($result->num_rows){
                $row=mysqli_fetch_assoc($result);
                echo implode($row);    
                  
                }
                ?></div>
            <span class="notification green"><?php 
                $dal_order->setStatus("pending");
                $result=$dal_order->countOrdersByStatus();
                if($result->num_rows){
                $row=mysqli_fetch_assoc($result);
                echo implode($row);    
                  
                }
                ?></span>
        </a>
    </div>

    
    <div class="col-md-4 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="New Comments." class="well top-block" href="view_comments.php">
            <i class="glyphicon glyphicon-comment green"></i>

            <div>New Reviews</div>
             <div>Pending</div>

            <span class="notification green"><?php 
                $result=$dal_product->getCommentsByStatus("pending");
                if($result->num_rows){
                $row=mysqli_fetch_assoc($result);
                echo implode($row);    
                  
                }
                ?></span>
        </a>
    </div>


          
    <?php 
        $flag=false;
         $rows="";    
                $result_ids = $dal_product-> getAllProductsIds();
                if($result_ids->num_rows){
          
                    while($row_ids=mysqli_fetch_assoc($result_ids)){
                  $dal_product->setProductId($row_ids['product_id']);   
                $result_stock = $dal_product->getProductStockByProductId();
                if( $result_stock->num_rows){
                ?>  
            <?php
                    while($row_stock=mysqli_fetch_assoc($result_stock)){
                  if($row_stock['stock']<10){
                    $flag=true;  
               
                 
              $rows.="<tr>";
            $rows.="<td style='text-align:center'>";
            $rows.=$row_stock['product'];
            $rows.="</td>";
            $rows.="<td style='text-align:center'>";
            $rows.=$row_stock['stock'];
            $rows.="</td> </tr>";
                     
                 
     }
                  }
                }
                }
                }
            
            
            if($flag==true){
            
            ?>    
<div class="col-md-8 ">
        <a data-toggle="tooltip"  class=" top-block">

    <Button type="button" class="btn btn-danger btn-lg btn-round"><i class="glyphicon glyphicon-phone blue"></i>&nbsp;Product Stock Readched To The Limit, Please Add The Stock Of The Following Products</Button>
           <br /><br />
            <div>
            <table class="table table-striped  table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th style="text-align:center">Product Name</th>
        <th style="text-align:center">Total Product Stcok</th>
       
    </tr>
    </thead>
    <tbody>
         <?php echo $rows;?>   
   
             </tbody>
    </table> 
    </div> 
     </a>
    </div>        
      <?php
                
            }
            ?>
     

    
    
    <?php
            
                $result = $dal_product->countProductStock(1);
                if($result->num_rows){
                $row= mysqli_fetch_assoc($result);    
                ?>

 <div class="col-md-2 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="View User Requests" class="well top-block" href="account_requests.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Oppp In Stock</div>
            <div> <?php  if(implode($row)!=null){echo implode($row);}else{echo "0";}   ?></div>
        </a>
    </div>    
  <?php                
    }
    
    ?>
    
    
    
    <?php
            
                $result = $dal_product->countProductStock(2);
                if($result->num_rows){
                $row= mysqli_fetch_assoc($result);    
                ?>

 <div class="col-md-2 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="View User Requests" class="well top-block" href="account_requests.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Nokia In Stock</div>
            <div>  <?php  if(implode($row)!=null){echo implode($row);}else{echo "0";}   ?></div>
        </a>
    </div>    
  <?php                
    }
    ?>
    
    
<?php
            
                $result = $dal_product->countProductStock(3);
                if($result->num_rows){
                $row= mysqli_fetch_assoc($result);    
                ?>

 <div class="col-md-2 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="View User Requests" class="well top-block" href="account_requests.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Honor In Stock</div>
            <div> <?php  if(implode($row)!=null){echo implode($row);}else{echo "0";}   ?></div>
        </a>
    </div>    
  <?php                
    }
    ?>    
    
    
    <?php
            
                $result = $dal_product->countProductStock(4);
                if($result->num_rows){
                $row= mysqli_fetch_assoc($result);    
                ?>

 <div class="col-md-2 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="View User Requests" class="well top-block" href="account_requests.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Infinix In Stock</div>
            <div> <?php  if(implode($row)!=null){echo implode($row);}else{echo "0";}   ?></div>
        </a>
    </div>    
  <?php                
    }
    ?>
    
    
    <?php
            
                $result = $dal_product->countProductStock(5);
                if($result->num_rows){
                $row= mysqli_fetch_assoc($result);    
                ?>

 <div class="col-md-2 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="View User Requests" class="well top-block" href="account_requests.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>QMobile In Stock</div>
            <div> <?php  if(implode($row)!=null){echo implode($row);}else{echo "0";}   ?></div>
        </a>
    </div>    
  <?php                
    }
    ?>
    
    <?php
            
                $result = $dal_product->countProductStock(6);
                if($result->num_rows){
                $row= mysqli_fetch_assoc($result);    
                ?>

 <div class="col-md-2 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="View User Requests" class="well top-block" href="account_requests.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Motorolla In Stock</div>
            <div> <?php  if(implode($row)!=null){echo implode($row);}else{echo "0";}   ?></div>
        </a>
    </div>    
  <?php                
    }
    ?>
    
    
    <?php
            
                $result = $dal_product->countProductStock(7);
                if($result->num_rows){
                $row= mysqli_fetch_assoc($result);    
                ?>

 <div class="col-md-4 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="View User Requests" class="well top-block" href="account_requests.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Samsung In Stock</div>
            <div> <?php  if(implode($row)!=null){echo implode($row);}else{echo "0";}   ?></div>
        </a>
    </div>    
  <?php                
    }
    ?>
    
</div>

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->


    <!-- Ad, you can remove it -->

    
    
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

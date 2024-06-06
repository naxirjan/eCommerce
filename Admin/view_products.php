<!DOCTYPE html>
<html lang="en">
<head>
  


   <title>N-Online Purchasing- View Products</title>

  <?php
include_once("require/libs_header.php");
?>
  
    
<script>
function EnableProduct(id){
var ajax;
if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("active_result").innerHTML= ajax.responseText;
//window.location="view_users.php";
}
}

ajax.open("GET","ajax_product.php?flag=1&userid="+id);
ajax.send();    
}
         
function DisableProduct(id){
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("active_result").innerHTML= ajax.responseText;
}
}
ajax.open("GET","ajax_product.php?flag=2&userid="+id);
ajax.send();
    
}
    </script>      
    
    
</head>

<body>
   
    <?php
include_once("require/header.php");

   
$session  = new Session();
$session->isAdmin();
$database = new Database();     
 
$dal_Product = new ProductDAL($database->hostname, $database->username, $database->password, $database->database);  


    
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
            <a href="#">View Products</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-eye-open"></i> View Products</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content" id="active_result"> 
            
     <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">Category</th>
        <th style="text-align:center;">Sub Category</th>
        <th style="text-align:center;">Product</th>
       <!-- <th style="text-align:center;">Featured</th>
       --> <th style="text-align:center;">Price</th>
        <th style="text-align:center;">Stock</th>
      <!--  <th style="text-align:center;">Free Shipping</th>
      -->  <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
        
        
    </tr>
    </thead>
    <tbody>
        
    <?php
        
$result= $dal_Product->getAllProducts();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['product_id']?></td>
        <td style="text-align:center;"><?php echo $row['category_title']?></td>
        <td style="text-align:center;"><?php echo $row['sub_category']?></td>
        <td style="text-align:center;"><?php echo $row['product']?></td>
   <!--     <td style="text-align:center;"><?php echo $row['featured']?></td>
   -->   <!--  <td style="text-align:center;"><?php echo $row['free_shipping']?></td>
      -->  <td style="text-align:center;"><?php echo $row['price']?></td>
        <td style="text-align:center;"><?php echo $row['stock']?></td>
        <td style="text-align:center;">
        <span class="<?php if($row['status']=="Pending"){ echo "label-warning";}elseif($row['status']=="Enabled"){echo"label-success"; }elseif($row['status']=="Disabled"){echo"label-danger"; }?> label label-default"><?php echo $row['status'];?></span>
        </td> 
        <td style="text-align:center;">
            <a href="update_product.php?id=<?php echo $row['product_id'];?>" class="btn btn-info btn-sm">Edit</a>
        
            <?php 
        if($row['status']=="Pending"){
        ?>
        <input type="button" class="btn btn-success btn-sm" onclick="EnableProduct(<?php echo $row['product_id']?>)" value="Enable" />
        <input type="button" class="btn btn-danger btn-sm" onclick="DisableProduct(<?php echo $row['product_id']?>)" value="Disable" />
        <?php    
        }                                                               
        elseif($row['status']=="Enabled"){
        ?>
        <input type="button" class="btn btn-success btn-sm" onclick="EnableProduct(<?php echo $row['product_id']?>)" value="Enable"  disabled />
        <input type="button" class="btn btn-danger btn-sm" onclick="DisableProduct(<?php echo $row['product_id']?>)" value="Disable" />
        <?php    
        }
        elseif($row['status']=="Disabled"){
        ?>
        <input type="button" class="btn btn-success btn-sm" onclick="EnableProduct(<?php echo $row['product_id']?>)" value="Enable"  />
        <input type="button" class="btn btn-danger btn-sm" onclick="DisableProduct(<?php echo $row['product_id']?>)" value="Disable" disabled />
        <?php    
        }                                    
        ?>   
                   
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

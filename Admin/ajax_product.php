<?php

 require_once("../library/session.php");
	require_once("../library/database.php");
	require_once("../data_access_layer/dal_product.php");
   
$session  = new Session();
$session->isAdmin();
$database = new Database();     
 
$dal_Product = new ProductDAL($database->hostname, $database->username, $database->password, $database->database);  





//Enable Product
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==1) {
       
        $dal_Product->setProductId($_REQUEST['userid']);
        $dal_Product->setStatus("Enabled");
        $result = $dal_Product ->enable_disableProduct();

       

if ($result) {   
	echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Product has been enabled successfully!...
                </div>';
?>    
  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">Category</th>
        <th style="text-align:center;">Sub Category</th>
        <th style="text-align:center;">Product</th>
        <th style="text-align:center;">Featured</th>
        <th style="text-align:center;">Price</th>
        <th style="text-align:center;">Stock</th>
        <th style="text-align:center;">Free Shipping</th>
        <th style="text-align:center;">Status</th>
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
        <td style="text-align:center;"><?php echo $row['featured']?></td>
        <td style="text-align:center;"><?php echo $row['free_shipping']?></td>
        <td style="text-align:center;"><?php echo $row['price']?></td>
        <td style="text-align:center;"><?php echo $row['stock']?></td>
        <td style="text-align:center;">
        <span class="<?php if($row['status']=="Pending"){ echo "label-warning";}elseif($row['status']=="Enabled"){echo"label-success"; }elseif($row['status']=="Disabled"){echo"label-danger"; }?> label label-default"><?php echo $row['status'];?></span>
        </td> 
        <td>
        <input type="button" class="btn btn-info" value="Edit" />
        
            <?php 
        if($row['status']=="Pending"){
        ?>
        <input type="button" class="btn btn-success" value="Enable" />
        <input type="button" class="btn btn-danger" value="Disable" />
        <?php    
        }                                                               
        elseif($row['status']=="Enabled"){
        ?>
        <input type="button" class="btn btn-success" onclick="ActiveProduct(<?php echo $row['product_id']?>)" value="Enable"  disabled />
        <input type="button" class="btn btn-danger" onclick="DeativeProduct(<?php echo $row['product_id']?>)" value="Disable" />
        <?php    
        }
        elseif($row['status']=="Disabled"){
        ?>
        <input type="button" class="btn btn-success" onclick="ActiveProduct(<?php echo $row['product_id']?>)" value="Enable"  />
        <input type="button" class="btn btn-danger" onclick="DeativeProduct(<?php echo $row['product_id']?>)" value="Disable" disabled />
        <?php    
        }                                    
        ?>   
            
        
        
        </td>
        
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

else{
	echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Product has not been enabled successfully!...
                </div>';
?>
 <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">Category</th>
        <th style="text-align:center;">Sub Category</th>
        <th style="text-align:center;">Product</th>
        <th style="text-align:center;">Featured</th>
        <th style="text-align:center;">Price</th>
        <th style="text-align:center;">Stock</th>
        <th style="text-align:center;">Free Shipping</th>
        <th style="text-align:center;">Status</th>
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
        <td style="text-align:center;"><?php echo $row['featured']?></td>
        <td style="text-align:center;"><?php echo $row['free_shipping']?></td>
        <td style="text-align:center;"><?php echo $row['price']?></td>
        <td style="text-align:center;"><?php echo $row['stock']?></td>
        <td style="text-align:center;">
        <span class="<?php if($row['status']=="Pending"){ echo "label-warning";}elseif($row['status']=="Enabled"){echo"label-success"; }elseif($row['status']=="Disabled"){echo"label-danger"; }?> label label-default"><?php echo $row['status'];?></span>
        </td> 
        <td>
        <input type="button" class="btn btn-info" value="Edit" />
        
            <?php 
        if($row['status']=="Pending"){
        ?>
        <input type="button" class="btn btn-success" value="Enable" />
        <input type="button" class="btn btn-danger" value="Disable" />
        <?php    
        }                                                               
        elseif($row['status']=="Enabled"){
        ?>
        <input type="button" class="btn btn-success" onclick="ActiveProduct(<?php echo $row['product_id']?>)" value="Enable"  disabled />
        <input type="button" class="btn btn-danger" onclick="DeativeProduct(<?php echo $row['product_id']?>)" value="Disable" />
        <?php    
        }
        elseif($row['status']=="Disabled"){
        ?>
        <input type="button" class="btn btn-success" onclick="ActiveProduct(<?php echo $row['product_id']?>)" value="Enable"  />
        <input type="button" class="btn btn-danger" onclick="DeativeProduct(<?php echo $row['product_id']?>)" value="Disable" disabled />
        <?php    
        }                                    
        ?>   
            
        
        
        </td>
        
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



//Disable Product
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==2) {
       
        $dal_Product->setProductId($_REQUEST['userid']);
        $dal_Product->setStatus("Disabled");
        $result = $dal_Product ->enable_disableProduct();

       

if ($result) {   
	echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Product has been disabled successfully!...
                </div>';
?>    
  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">Category</th>
        <th style="text-align:center;">Sub Category</th>
        <th style="text-align:center;">Product</th>
        <th style="text-align:center;">Featured</th>
        <th style="text-align:center;">Price</th>
        <th style="text-align:center;">Stock</th>
        <th style="text-align:center;">Free Shipping</th>
        <th style="text-align:center;">Status</th>
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
        <td style="text-align:center;"><?php echo $row['featured']?></td>
        <td style="text-align:center;"><?php echo $row['free_shipping']?></td>
        <td style="text-align:center;"><?php echo $row['price']?></td>
        <td style="text-align:center;"><?php echo $row['stock']?></td>
        <td style="text-align:center;">
        <span class="<?php if($row['status']=="Pending"){ echo "label-warning";}elseif($row['status']=="Enabled"){echo"label-success"; }elseif($row['status']=="Disabled"){echo"label-danger"; }?> label label-default"><?php echo $row['status'];?></span>
        </td> 
        <td>
        <input type="button" class="btn btn-info" value="Edit" />
        
            <?php 
        if($row['status']=="Pending"){
        ?>
        <input type="button" class="btn btn-success" value="Enable" />
        <input type="button" class="btn btn-danger" value="Disable" />
        <?php    
        }                                                               
        elseif($row['status']=="Enabled"){
        ?>
        <input type="button" class="btn btn-success" onclick="ActiveProduct(<?php echo $row['product_id']?>)" value="Enable"  disabled />
        <input type="button" class="btn btn-danger" onclick="DeativeProduct(<?php echo $row['product_id']?>)" value="Disable" />
        <?php    
        }
        elseif($row['status']=="Disabled"){
        ?>
        <input type="button" class="btn btn-success" onclick="ActiveProduct(<?php echo $row['product_id']?>)" value="Enable"  />
        <input type="button" class="btn btn-danger" onclick="DeativeProduct(<?php echo $row['product_id']?>)" value="Disable"  disabled/>
        <?php    
        }                                    
        ?>   
            
        
        
        </td>
        
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

else{
	echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Product has not been disabled successfully!...
                </div>';
?>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">Category</th>
        <th style="text-align:center;">Sub Category</th>
        <th style="text-align:center;">Product</th>
        <th style="text-align:center;">Featured</th>
        <th style="text-align:center;">Price</th>
        <th style="text-align:center;">Stock</th>
        <th style="text-align:center;">Free Shipping</th>
        <th style="text-align:center;">Status</th>
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
        <td style="text-align:center;"><?php echo $row['featured']?></td>
        <td style="text-align:center;"><?php echo $row['free_shipping']?></td>
        <td style="text-align:center;"><?php echo $row['price']?></td>
        <td style="text-align:center;"><?php echo $row['stock']?></td>
        <td style="text-align:center;">
        <span class="<?php if($row['status']=="Pending"){ echo "label-warning";}elseif($row['status']=="Enabled"){echo"label-success"; }elseif($row['status']=="Disabled"){echo"label-danger"; }?> label label-default"><?php echo $row['status'];?></span>
        </td> 
        <td>
        <input type="button" class="btn btn-info" value="Edit" />
        
            <?php 
        if($row['status']=="Pending"){
        ?>
        <input type="button" class="btn btn-success" value="Enable" />
        <input type="button" class="btn btn-danger" value="Disable" />
        <?php    
        }                                                               
        elseif($row['status']=="Enabled"){
        ?>
        <input type="button" class="btn btn-success" onclick="ActiveProduct(<?php echo $row['product_id']?>)" value="Enable"  disabled />
        <input type="button" class="btn btn-danger" onclick="DeativeProduct(<?php echo $row['product_id']?>)" value="Disable" />
        <?php    
        }
        elseif($row['status']=="Disabled"){
        ?>
        <input type="button" class="btn btn-success" onclick="ActiveProduct(<?php echo $row['product_id']?>)" value="Enable"  />
        <input type="button" class="btn btn-danger" onclick="DeativeProduct(<?php echo $row['product_id']?>)" value="Disable"  disabled/>
        <?php    
        }                                    
        ?>   
            
        
        
        </td>
        
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



//Update Product
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==3)
{

$dal_Product->setProductId($_REQUEST['id']);
$dal_Product->setProduct($_REQUEST['product_name']);
$dal_Product->setDescription($_REQUEST['description']);        
$dal_Product->setPrice($_REQUEST['price']);
$dal_Product->setStock($_REQUEST['stock']);
$dal_Product->setShipAmount($_REQUEST['free_shipping_price']);
$dal_Product->setIsFeatured($_REQUEST['is_featured']);

    $dal_Product->setWeight($_REQUEST['weight']);
    $dal_Product->setOperatingSystem($_REQUEST['operating_system']);
    $dal_Product->setDisplaySize($_REQUEST['display_size']);
    $dal_Product->setProcessor($_REQUEST['processor']);
    $dal_Product->setFrontCamera($_REQUEST['front_camera']);
    $dal_Product->setBackCamera($_REQUEST['back_camera']);
    $dal_Product->setSimType($_REQUEST['sim_type']);
    $dal_Product->setRam($_REQUEST['ram']);
    $dal_Product->setRom($_REQUEST['rom']);
    $dal_Product->setBattery($_REQUEST['battery']);
    
    
$result=$dal_Product->updateProduct();    
    
if($result){
echo '<div class="alert alert-success center" >
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Product has been updated successfully!...
                </div>';    
}
else{
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Product has not been updated successfully!...
                </div>';    
}    
}



//Allow Review
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==4)
{

    
    
$result=$dal_Product->setAllowRejectReview("allow",$_REQUEST['review_id']);    
    
if($result){
echo '<div class="alert alert-success center" >
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Review has been allowed successfully!...
                </div>';    
?>
  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">User ID</th>
        <th style="text-align:center;">Full Name</th>
        <th style="text-align:center;">Product</th>
        <th style="text-align:center;">Reviews</th>
        <th style="text-align:center;">Review Date</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
        
    </tr>
    </thead>
    <tbody>
        
    <?php
     
$result= $dal_Product->getProductReviewsByStatus(); 
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['review_id']?></td>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']." ".$row['last_name']?></td>
        <td style="text-align:center;"><?php echo $row['product']?></td>
       <td style="text-align:center;"><?php echo $row['review']?></td>
    <td style="text-align:center;"><?php echo $row['review_date']?></td>
    
        <td style="text-align:center;">
            <?php
          if($row['status']=='allow'){
            ?>    
            <span class="label-success label label-default"><?php echo "Allowed";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']=='pending'){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending";?></span>
            <?php    
            } 
                                        
             elseif($row['status']=='reject'){
            ?>    
            <span class="label-danger label label-default"><?php echo "Rejected";?></span>
            <?php    
            }                             
            ?>
        </td>   
        
        
        <td style="text-align:center;">
            <?php
          if($row['status']=='allow'){
            ?>    
           
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)"  disabled>
        
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectrReview(<?php echo $row['review_id']?>)" disabled>
            
            
            <?php    
            }  
                                                                                 
            elseif($row['status']=='pending'){
            ?>    
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)" >
            
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectReview(<?php echo $row['review_id']?>)" >
            
            <?php    
            }  
                                        
             elseif($row['status']=='reject'){
            ?>    
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)" disabled>
            
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectReview(<?php echo $row['review_id']?>)" disabled>
            
            <?php    
            }                              
            ?>
        </td>  
               <input type="hidden" id="review_id<?php echo $row['review_id']?>" value="<?php echo $row['review_id']?>">
          
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
else{
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Review has not been allowed successfully!...
                </div>';    
?>
  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">User ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Product</th>
        <th style="text-align:center;">Reviews</th>
        <th style="text-align:center;">Review Date</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
        
    </tr>
    </thead>
    <tbody>
        
    <?php
     
$result= $dal_Product->getProductReviewsByStatus(); 
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"><?php echo $row['product']?></td>
       <td style="text-align:center;"><?php echo $row['review']?></td>
    <td style="text-align:center;"><?php echo $row['review_date']?></td>
    
        <td style="text-align:center;">
            <?php
          if($row['status']=='allow'){
            ?>    
            <span class="label-success label label-default"><?php echo "Allowed";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']=='pending'){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending";?></span>
            <?php    
            } 
                                        
             elseif($row['status']=='reject'){
            ?>    
            <span class="label-danger label label-default"><?php echo "Rejected";?></span>
            <?php    
            }                             
            ?>
        </td>   
        
        
        <td style="text-align:center;">
            <?php
          if($row['status']=='allow'){
            ?>    
           
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)"  disabled>
        
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectrReview(<?php echo $row['review_id']?>)" disabled>
            
            
            <?php    
            }  
                                                                                 
            elseif($row['status']=='pending'){
            ?>    
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)" >
            
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectReview(<?php echo $row['review_id']?>)" >
            
            <?php    
            }  
                                        
             elseif($row['status']=='reject'){
            ?>    
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)" disabled>
            
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectReview(<?php echo $row['review_id']?>)" disabled>
            
            <?php    
            }                              
            ?>
        </td>  
               <input type="hidden" id="review_id<?php echo $row['review_id']?>" value="<?php echo $row['review_id']?>">
          
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


//Reject Review
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==5)
{

    
    
$result=$dal_Product->setAllowRejectReview("reject",$_REQUEST['review_id']);    
    
if($result){
echo '<div class="alert alert-success center" >
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Review has been rejected successfully!...
                </div>';    
?>
  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">User ID</th>
        <th style="text-align:center;">Full Name</th>
        <th style="text-align:center;">Product</th>
        <th style="text-align:center;">Reviews</th>
        <th style="text-align:center;">Review Date</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
        
    </tr>
    </thead>
    <tbody>
        
    <?php
     
$result= $dal_Product->getProductReviewsByStatus(); 
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['review_id']?></td>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']." ".$row['last_name']?></td>
        <td style="text-align:center;"><?php echo $row['product']?></td>
       <td style="text-align:center;"><?php echo $row['review']?></td>
    <td style="text-align:center;"><?php echo $row['review_date']?></td>
    
        <td style="text-align:center;">
            <?php
          if($row['status']=='allow'){
            ?>    
            <span class="label-success label label-default"><?php echo "Allowed";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']=='pending'){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending";?></span>
            <?php    
            } 
                                        
             elseif($row['status']=='reject'){
            ?>    
            <span class="label-danger label label-default"><?php echo "Rejected";?></span>
            <?php    
            }                             
            ?>
        </td>   
        
        
        <td style="text-align:center;">
            <?php
          if($row['status']=='allow'){
            ?>    
           
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)"  disabled>
        
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectrReview(<?php echo $row['review_id']?>)" disabled>
            
            
            <?php    
            }  
                                                                                 
            elseif($row['status']=='pending'){
            ?>    
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)" >
            
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectReview(<?php echo $row['review_id']?>)" >
            
            <?php    
            }  
                                        
             elseif($row['status']=='reject'){
            ?>    
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)" disabled>
            
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectReview(<?php echo $row['review_id']?>)" disabled>
            
            <?php    
            }                              
            ?>
        </td>  
               <input type="hidden" id="review_id<?php echo $row['review_id']?>" value="<?php echo $row['review_id']?>">
          
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
else{
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Review has not been rejected successfully!...
                </div>';    
?>
  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">User ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Product</th>
        <th style="text-align:center;">Reviews</th>
        <th style="text-align:center;">Review Date</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
        
    </tr>
    </thead>
    <tbody>
        
    <?php
     
$result= $dal_Product->getProductReviewsByStatus(); 
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"><?php echo $row['product']?></td>
       <td style="text-align:center;"><?php echo $row['review']?></td>
    <td style="text-align:center;"><?php echo $row['review_date']?></td>
    
        <td style="text-align:center;">
            <?php
          if($row['status']=='allow'){
            ?>    
            <span class="label-success label label-default"><?php echo "Allowed";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']=='pending'){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending";?></span>
            <?php    
            } 
                                        
             elseif($row['status']=='reject'){
            ?>    
            <span class="label-danger label label-default"><?php echo "Rejected";?></span>
            <?php    
            }                             
            ?>
        </td>   
        
        
        <td style="text-align:center;">
            <?php
          if($row['status']=='allow'){
            ?>    
           
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)"  disabled>
        
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectrReview(<?php echo $row['review_id']?>)" disabled>
            
            
            <?php    
            }  
                                                                                 
            elseif($row['status']=='pending'){
            ?>    
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)" >
            
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectReview(<?php echo $row['review_id']?>)" >
            
            <?php    
            }  
                                        
             elseif($row['status']=='reject'){
            ?>    
            <input  type="button" class="btn btn-success btn-sm"  value="Allow" onclick="AllowReview(<?php echo $row['review_id']?>)" disabled>
            
            <input  type="button" class="btn btn-danger btn-sm"  value="Reject" onclick="RejectReview(<?php echo $row['review_id']?>)" disabled>
            
            <?php    
            }                              
            ?>
        </td>  
               <input type="hidden" id="review_id<?php echo $row['review_id']?>" value="<?php echo $row['review_id']?>">
          
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
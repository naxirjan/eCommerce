<!DOCTYPE html>
<html lang="en">
<head>
   
    
    
    
    
    
    <title>-Online Purchasing-Home</title>
 

    
<?php
    
    
   
require_once("require/libs_header.php");        
?> 
    
    
    <script>
function searchProduct(){
var product = document.getElementById("search-product").value;
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("search_product_result").innerHTML= ajax.responseText;
}
}

ajax.open("GET","ajax_product.php?flag=1&product="+product);
ajax.send();    
}
    </script>
    
    
    
</head>

<body>
<?php
require_once("require/headerbar.php");  
require_once("require/small_cart.php");    
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
if(isset($_REQUEST['nomatch'])){
      echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Sorry, </strong>Records Not Found!...
                </div>';  }  
    
require_once("require/navbar.php"); 
require_once("require/slider.php"); 
//require_once("require/newsbar.php");
   
$database = new Database();     
 $dal_Product = new ProductDAL($database->hostname, $database->username, $database->password, $database->database); 
 ?> 
        </div>    

    
        
        <div id="content" class="col-md-12">
    
<div class="col-md-4 center" >
            
   
        
     <ul class="breadcrumb" >
        <li>
          <div class="input-group ">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone red"></i>
              </span>
                
              <input type="text" id="search-product" class="form-control" placeholder="Search your phone easily!..." />
            
            </div>
            <br />
            <span>
         <button class="btn btn-primary btn-round btn-lg" onclick="searchProduct()"><i class="glyphicon glyphicon-search"></i> Search The Product
                    </button>
                </span>  
                 
       
               
            
        </li>
     
    </ul>
        </div>      

            
            
    
    <div id="search_product_result"></div>        
    <div id="search_result"></div>        
            
<!--Features Devices-->             
<?php    
$result=$dal_Product ->getAllFeaturedProducts();    
if($result->num_rows){
    
   
    
?>    
<div class="row">
<hr />        
<div class="col-md-2 center ">
                        <h3><label class="label label-primary">.:: Phones With Extra Features ::.<i class="glyphicon glyphicon-phone"></i>&nbsp;</label>  </h3>
              </div>     

    
<?php    
while($row=mysqli_fetch_assoc($result)){

    
$dal_Product ->setProductId($row['product_id']);    
$result2=$dal_Product ->getProductOneImage();    

if($result2){
$row2=mysqli_fetch_assoc($result2);    
}    
    ?>    
                      
     <div class="box col-md-3">
    <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-phone"></i> Featured Smartphone</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
    
                        <div class="box-content">
                         <ul class="dashboard-list">
                             
                             
                        <?php
                    if(isset($row['featured']) && $row['featured']=="Yes"){
                    ?>    
                    <li><label class="btn btn-sm btn-success btn-round"><i class="glyphicon glyphicon-star"> Featured</i></label></li>
                    
                    <?php
                    }
                    ?>     
                             
                   <li><label  class="label label-primary"><?php echo $row['category_title']?></label></li>
                        <h4> <?php echo $row['product'];?></h4>
                        <li>
                            <a href="preview.php?id=<?php echo $row['product_id'];?>">    
                       <img src="images/<?php echo $row2['image'];?>" alt="" width="200" height="200"></a>   
                       </li>
                        <li>
                        <p> <?php echo $row['description'];?></p>                                  
                        </li>
                       
                        <li><h4>Price: Rs. <?php echo $row['price'];?></h4></li>
                   
                             
                             <li><span><?php $result_rate= $dal_Product->getProductTotalRating();
                    
                    if($result_rate->num_rows)
                    {    
                    $row_rate=mysqli_fetch_assoc($result_rate);
                    $rating=ceil(implode($row_rate));
                    $dal_Product->setRatingImages($rating);
                    }
                    
                  ?></span></li>
                                       
                        
   </ul>
                    </div>
            
        </div>
    </div>
    <!--/span-->                         
                        

       
       <?php    
}    
?>  
    
   
</div>
<?php
}
?>
<!--Features Devices-->             
       
            
            
      
            
<!--Discount Devices--> 
<?php  
$discount_date=date("Y-m-d");            
$price="";            
$result=$dal_Product ->getAllProducts();    
if($result->num_rows){
?>            
            
<div class="row">
    
    <hr />      

<div class="col-md-2 center ">
                        <h3><label class="label label-primary">.:: Other Phones::. <i class="glyphicon glyphicon-phone"></i>&nbsp;</label>  </h3>
              </div> 
    
    
   
<?php    
while($row=mysqli_fetch_assoc($result)){
//$total_records++;
    
$dal_Product ->setProductId($row['product_id']);    
$result2=$dal_Product->getProductOneImage();    

if($result2){
$row2=mysqli_fetch_assoc($result2);    
}    
    
    
$result3=$dal_Product->getProductDiscount($discount_date);    
if($result3->num_rows){
$row3=mysqli_fetch_assoc($result3); 
    
if($row3['product_discount']>0) {       
$price=$row['price']-($row['price']*($row3['product_discount']/100)); 
}else{
$price=$row['price'];    
}
}
?>    
                      
     <div class="box col-md-3">
    <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-phone"></i> Smartphone</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
    
                        <div class="box-content">
                         <ul class="dashboard-list"> 
                            <?php
    
                            if(isset($row3['product_discount']) && $row3['product_discount']>0){
                            ?>                             
                            <li> <span class="btn btn-round btn-warning" >Discount : <?php echo $row3['product_discount']."%";?></span></li> 
                            <?php
                            }
                            ?>
                             
                        <li><label  class="label label-primary"><?php echo $row['category_title']?></label></li>
                        <h4> <?php echo $row['product'];?></h4>
                        <li>
                            <a href="preview.php?id=<?php echo $row['product_id'];?>">    
                       <img src="images/<?php echo $row2['image'];?>" alt="" width="200" height="200"></a>   
                       </li>
                        <li>
                        <p> <?php echo $row['description'];?></p>                                  
                        </li>
                       
                     
                        <?php
    
                            if(isset($row3['product_discount']) && $row3['product_discount']>0){
                            ?>
                        <li><small style="text-decoration: line-through;">Price: Rs. <?php echo $row['price'];?></small>
                        <h4 >Price Rs. <?php echo $price;?></h4>   </li>
                        <?php
                            }
                            else{
                            ?>
                             <li><h4 >Price Rs. <?php echo $price;?></h4></li>
                            <?php
                                
                            }
                            ?>
                                
                    
                             <li><span>Reviews(5) : </span><a href="preview.php"><img src="images/rating.png" width="100" height="17"/></a></li>
                                       
                        
   </ul>
                    </div>
            
        </div>
    </div>
    <!--/span-->                         
                        

       
       <?php    
}    
?>  
    
   
</div>
<?php
}
?>
    
<!--Discount Devices-->                 
        
  
            
            
            
            
<!--Searc-->             
<?php 
            
if($session->isSessionUserId()){            
            
            
$dal_Product->setUserId($_SESSION['user']['user_id']);                
$result=$dal_Product ->getAllMostSearchedProducts();    
if($result->num_rows){
?>    
<div class="row">
<hr />         
<div class="col-md-2 center ">
                        <h3><label class="label label-primary">.:: Most Searched ::.<i class="glyphicon glyphicon-phone"></i>&nbsp;</label>  </h3>
              </div>     

    
<?php    
while($row=mysqli_fetch_assoc($result)){
$dal_Product ->setProductId($row['product_id']);    
$result2=$dal_Product ->getProductOneImage();    

if($result2){
$row2=mysqli_fetch_assoc($result2);    
}    
    ?>    
                      
     <div class="box col-md-2">
    <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-phone"></i> Most Searched</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
    
                        <div class="box-content">
                         <ul class="dashboard-list"> 
                             <li><label  class="label label-primary"><?php echo $row['category_title']?></label></li>
                        <small><?php echo $row['product'];?></small> 
                        <li>
                            <a href="preview.php?id=<?php echo $row['product_id'];?>">    
                       <img src="images/<?php echo $row2['image'];?>" alt="" width="100" height="100"></a>   
                       </li>
                        <li><p>Price: Rs. <?php echo $row['price'];?></p></li>
                     <li><span>Reviews(5) : </span><a href="preview.php"><img src="images/rating.png" width="100" height="17"/></a></li>
                                       
                        
   </ul>
                    </div>
            
        </div>
    </div>
    <!--/span-->                         
                        

       
       <?php    
}    
?>  
    
   
</div>
<?php
}
}
            ?>
<!--Features Devices-->             
              
            
            
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

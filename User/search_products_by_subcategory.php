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
    
$database = new Database();     
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
require_once("require/navbar.php"); 
require_once("require/slider.php"); 
//require_once("require/newsbar.php");
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
    
            
            
            
            
            
            
<div id="content">
    
    
 <?php 
if(isset($_REQUEST['id'])){
$sub_category_id=$_REQUEST['id'];    
$dal_Product ->setSubCategoryId($sub_category_id);   
$result=$dal_Product ->getAllProductsBySearch();    
if($result->num_rows){
  
?>    
    
    
<div class="row">
<hr />         
<div class="col-md-2 center ">
                        <h3><label class="label label-primary">.::  Smartphones you need!.... ::.<i class="glyphicon glyphicon-phone"></i>&nbsp;</label>  </h3>
              </div>     

    
<?php
    
while($row=mysqli_fetch_assoc($result)){

    
$dal_Product ->setProductId($row['product_id']);    
$result2=$dal_Product ->getProductOneImage();    

if($result2){
$row2=mysqli_fetch_assoc($result2);    
}
else{
?>    
  <script language="javascript" type="text/javascript">
window.location="index.php?nomatch=Image Not Found";
</script>   
<?php    
}    
    
    ?>    
                      
     <div class="box col-md-3">
    <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-phone"></i> Searched Smartphone</h2>
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
                        <?php
                        $d=date("Y-m-d");    
                        if($row['featured']=="Yes"){
                        ?>   
                             <li><label  class="label label-success"><?php echo "Featured";?></label>&nbsp;&nbsp;</li>
                        <?php    
                        }
                        if($row['product_discount']!="0" && $row['start_date']>=$d){
                        ?>   
                        <li><label  class="btn btn-warning btn-round btn-sm"><?php echo "Discount : ".$row['product_discount']."%"?></label>&nbsp;&nbsp;
                        <?php    
                        }    
                        ?> 
    
    
    
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
                    </span></li>
                                       
                        
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
      
else{
?> 
 <script language="javascript" type="text/javascript">
window.location="index.php?nomatch=Sorry Record Not Found";
</script>    
<?php    
}    
    
} 
    
else{
?>    

<script language="javascript" type="text/javascript">
window.location="index.php";
</script>     
    
<?php    
}    
?>    
    

     
    
    

    
    
    
    


     
    
   </div><!--/row-->
    </div>
    </div><!--/fluid-row-->



    
    
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

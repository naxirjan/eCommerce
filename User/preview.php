<!DOCTYPE html>
<html lang="en">
<head>
   
    
    
    
    
    
<script language="javascript" type="text/javascript">
    
    
function AddCart(){
var product_id = document.getElementById("product_id").value;
        
var product_name = document.getElementById("product_name").value;
var price = document.getElementById("price").value;
var quantity = document.getElementById("quantity").value;
var stock = document.getElementById("stock").value;    
    
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

ajax.open("GET","ajax_cart_action.php?product_id="+product_id+"&product_name="+product_name+"&price="+price+"&quantity="+quantity+"&stock="+stock);
ajax.send();    
}

    
function AddReview(){
var user_review = document.getElementById("user_review").value;    
var product_id = document.getElementById("product_id").value; 
var rating = document.getElementsByName("score")[0].value;    
    
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("review_result").innerHTML= ajax.responseText;
}
}

ajax.open("GET","ajax_review_rating.php?flag=1&user_review="+user_review+"&product_id="+product_id+"&rating="+rating);
ajax.send();    
}    
    
    
    
    
</script>    
    <title>-Online Purchasing-Checkout</title>
 
<?php
   
require_once("require/libs_header.php");        
?> 
   

    

    
  </head>

<body>
<?php
    
    $row3="";
    
    require_once("require/headerbar.php"); 
require_once("require/small_cart.php");     

    
$session =new Session();    
$database = new Database();     
$dal_SubCategory = new SubCategoryDAL($database->hostname, $database->username, $database->password, $database->database);  
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
        
<?php 
        
if(isset($_REQUEST['id']) && $_REQUEST['id']!="0"){
$id=$_REQUEST['id']; 
    
    
        
    $dal_Product->setProductId($id);                    
    $result= $dal_Product->getProductDetailById();                     
    
    if($result->num_rows){    
    while($row = mysqli_fetch_assoc($result)){           
$product_id=$row['product_id'];
$category_title=$row['category_title'];
$sub_category_id=$row['sub_category_id'];        
$product=$row['product'];
$description=$row['description'] ;        
$price=$row['price'];
$stock=$row['stock'];        
$featured=$row['featured'];
        
$weight=$row['weight'];
$operating_system=$row['operating_system'] ;
$display_size=$row['display_size'] ;
$internal_memory=$row['internal_memory'] ;
$external_memory=$row['external_memory'] ;
$processor=$row['processor'] ;
$front_camera=$row['front_camera'] ;
$back_camera=$row['back_camera'] ;
$battery=$row['battery'] ;
$sim_type=$row['sim_type'] ;
        
}
$discount_date=date("Y-m-d");        
$dal_Product->setProductId($_REQUEST['id']);        
 $result3=$dal_Product->getProductDiscount($discount_date);    
if($result3->num_rows){
$row3=mysqli_fetch_assoc($result3); 
    
if($row3['product_discount']>0) {       
$new_price=$price-$price*($row3['product_discount']/100); 
}else{
$new_price=$price;    
}
    
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
    <br />    
    <div class="col-md-12">
        
        
</div>    
    <div class="box col-sm-3">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-picture"></i> Pictures</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            
            
           
            <div class="box-content  ">
            <ul class="thumbnails gallery"> 
                <?php
    $i=0;
    $main_image='';
    $dal_Product->setProductId($product_id);
     $result=$dal_Product->getProductImages();         
    if($result->num_rows){    
    while($row = mysqli_fetch_assoc($result)){
    $main_image=$row['image'];
        $i++;
                                       ?>
   
                   <p>
                        <li id="image-1" class="thumbnail">
    <a style="background:url(images/<?php echo $row['image'];?>)" title="Sample Image <?php echo $i; ?>" href="images/<?php echo $row['image'];?>">
<img class="grayscale" src="images/<?php echo $row['image'];?>" alt="Sample Image <?php echo $i; ?>"></a> 
                        </li>
                 </p>
                 
             
<?php    
}
    }
?>     
                             
</ul>  
       
            
            
            </div>

            </div>
        </div>
    <div class="box col-md-4">
       
      
            
            <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-phone"></i> Smartphone</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            
            
            <div class="box-content">
                <ul class="dashboard-list">
                   <?php
                    if(isset($featured) && $featured=="Yes"){
                    ?>    
                    <li><label class="btn btn-sm btn-success btn-round"><i class="glyphicon glyphicon-star"> Featured</i></label></li>
                    
                    <?php
                    }
                   
                    
                     if(isset($row3['product_discount']) && $row3['product_discount']>0){
                            ?>                             
                            <li> <span class="btn btn-round btn-warning" >Discount : <?php echo $row3['product_discount']."%";?></span></li> 
                            <?php
                            }
                            ?>
                    
                    <li><h1 class="label label-primary"><?php echo $category_title; ?></h1></li>
                    <h4><?php echo $product;?></h4>
                    <li><span><img src="images/<?php echo $main_image;?>" alt="" width="300" height="300"></span></li>
                    
                    
                    <?php
    
                            if(isset($row3['product_discount']) && $row3['product_discount']>0){
                            ?>
                        <li><small style="text-decoration: line-through;">Price: Rs. <?php echo $price;?></small>
                        <h4 >Price Rs. <?php echo $new_price;?></h4>   </li>
                        <?php
                            }
                            else{
                            ?>
                              
                             <li><h4 >Price Rs. <?php echo $price;?></h4></li>
                            <?php
                                
                            }
                            ?>
                    
                    
                    <li><span><?php $result_rate= $dal_Product->getProductTotalRating();
                $row_rate=mysqli_fetch_assoc($result_rate);
                    
                    if($row_rate){                    
    
                    $rating=ceil(implode($row_rate));
                    $dal_Product->setRatingImages($rating);
                    }
                  ?></span></li>  
                    
                  
                <li><?php echo $description;?></li>    
    
                    
                    
                    <li>   
                    <div class="input-group input-group-sm col-md-6">
                        <span class="input-group-addon">Quantity:</span>
                       <input  type=number class="form-control"  value="1" name="quantity" id="quantity" min="1" max="20" > 
                     
                    </div> 
                    
                    </li>
                 <li><input  type="button" onclick="AddCart()" class="btn btn-primary"  value="Add Cart" name="add-cart" >
                    </li>
                
                    <input type="hidden" id="product_name" name="product_name" value="<?php echo $product;?>" />
                    
                    <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id;?>" />
                    
                    <input type="hidden" id="price" name="price" value="<?php $new_price;?>" />    

                    <input type="hidden" id="stock" name="stock" value="<?php echo $stock;?>" />    

                    
                </ul>
          
            </div>
            
            </div>
            
        <div id="active_result"></div>     
        </div>
    <div class="box col-md-5">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> More About The Device</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                
                </div>
            </div>
            <div class="box-content">
              
            <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#info">Key Features</a></li>
                    <li><a href="#user_review_rating">Your Reviews</a></li>
                    <li><a href="#review">Reviews</a></li>
                    <li><a href="#rating">Ratings</a></li>
                    <li><a href="#policy">Return Policy</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="info">
                        <p><b>RAM : </b> <?php echo $internal_memory;?></p>
                        <p><b>ROM : </b><?php echo $internal_memory;?></p>
                        <p><b>Weight : </b> <?php echo $weight."g";?></p>
                         <p><b>Display Size : </b><?php echo $display_size;?>
                        <p><b>Battery : </b><?php echo $battery;?></p>
                        <p><b>SIM Type : </b><?php echo $sim_type;?></p>
                        <p><b>Processor : </b><?php echo $processor."Ghrz";?></p>
                        <p><b>Front Camera : </b><?php echo $front_camera;?></p>
                        <p><b>Back Camera : </b> <?php echo $back_camera;?></p>
                        <p><b>Operating System : </b><?php echo $operating_system;?>
                        
                    </div>
                    
                    
                    <div class="tab-pane" id="user_review_rating">
                        
                     <div class="box-content" >
                        
                    <h2>Your Rating Please!...</h2>    
               
                    <div class="form-group">
                        
                       
                    <label>Rating:</label>   
                   <div class="raty" style="cursor: pointer; width: 100px;"><img src="img/star-on.png" alt="1" title="bad">&nbsp;<img src="img/star-off.png" alt="2" title="poor">&nbsp;<img src="img/star-off.png" alt="3" title="regular">&nbsp;<img src="img/star-off.png" title="good">&nbsp;<img src="img/star-off.png" alt="5" title="gorgeous">
		          <input type="hidden" name="score"  id="rating" ></div>  
                              </div>
                   
                  

            </div>
                        
                        
                        
                     <div class="box-content" id="review_result">
                        
                    <h2>Enter Your Review</h2>    
                
                    <div class="form-group">
                    <input type="hidden" id="product_id" value="<?php echo $product_id;?>">   
                        <label for="exampleInputEmail1">Review</label>
                        <input type="text" class="form-control" id="user_review" placeholder="Enter your review">
                    </div>
                   
                    <?php
    
    
                        if($session->isSessionUserId()){
                        ?>    
                         <button type="submit" class="btn btn-primary" onclick="AddReview()">Submit</button>
                        <?php 
                        }
                       elseif(!$session->isSessionUserId()){
                        ?>
                         <a href="signin.php?message=Please signin your account first" class="btn btn-primary">Submit</a>
                     
                         <?php
                       }
                         ?>
                         
                         
                         
                         
                   

            </div>
            
                        
                        
                    </div>
                    
                    
                    
                    <div class="tab-pane" id="review">
                        
                       <ul class="dashboard-list">
                        <?php
                        $dal_Product->setProductId($id);   
                        $result2= $dal_Product->getProductReviews();   
                        if($result2->num_rows)
                        {
                            
                        while($row2=mysqli_fetch_assoc($result2)){
                        ?>    
                           <li>
                               
                               <span class="label label-default"><strong>Name: </strong></span>&nbsp;
                               <span class="label-success label label-default"><?php echo $row2['first_name']." ".$row2['last_name'];?></span><br>
                               
                               <span class="label label-default"><strong>Since: </strong></span>&nbsp;
                               <span class="label-primary label label-default"><?php echo $row2['review_date'];?></span><br>
                           
                               <span class="label label-default"><strong>Review: </strong></span>&nbsp;<span class="label-info label label-default"><?php echo $row2['review'];?></span>
                        </li>    
                            
                        <?php    
                        }    
                        }else{
                            ?>
                           <br />
                           <span class="btn btn-primary btn-round"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;No Reviews Have Been Added On This Product!...</span>
                        <?php   
                        }   
                 
                           ?>
                    
                        
                        
                        
                        
                        </ul>
                        
           </div>
                    
                    <div class="tab-pane" id="rating">
                       <ul class="dashboard-list">
                        <?php
                        $dal_Product->setProductId($id);   
                        $result3= $dal_Product->getProductRatings();   
                        if($result3->num_rows)
                        {
                            
                        while($row3=mysqli_fetch_assoc($result3)){
                        ?>    
                           <li>
                               
                               <span class="label label-default"><strong>Name: </strong></span>&nbsp;
                               <span class="label-success label label-default"><?php echo $row3['first_name']." ".$row2['last_name'];?></span><br>
                               
                               <span class="label label-default"><strong>Since: </strong></span>&nbsp;
                               <span class="label-primary label label-default"><?php echo $row3['rating_date'];?></span><br>
                           
                               <span class="label label-default"><strong>Review: </strong></span>&nbsp;<span class=""><?php
                                $dal_Product->setRatingImages($row3['rating']);
                                ?></span>
                               
                        </li>    
                            
                        <?php    
                        }    
                        } else{
                            ?>
                           <br />
                           <span class="btn btn-primary btn-round"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;No Rating Has Been Added On This Product!...</span>
                        <?php   
                        }  
                 
                           ?>
                    
                        
                        
                        
                        
                        </ul>
                        
                    </div>
                    
                    
                    
                    <div class="tab-pane" id="policy">
                        <h3><span class="label-primary label label-default">7 Days Replacement Only</span></h3>
<span>                            
If your product is defective / damaged or incorrect / incomplete at the time of delivery, then call <i class="glyphicon glyphicon-earphone "></i> our customer service on +92 313 3006640 to log a replacement request within 7 days of delivery. 
<br /><br />    
For device-related issues after usage please contact the service center listed on the warranty card included with your product or alternatively check our Brand Contact List for more details.
<br /><br />
                            
This product is not eligible for a replacement if the product is "no longer needed". <br>
"No longer needed" means that you no longer have a use for the product / you have changed your mind about the purchase / the size of a fashion product does not fit / you do not like the product after opening the package.
  </span>                          

                        <h3><span class="label-primary label label-default">Conditions for Returns</span></h3>                            
<span>The product must be unused, unworn, unwashed and without any flaws.
The return will not be processed if the freebies (Mobile network voucher, Voucher, Accessories or any other bundled product) is used or tempered.
The product must include the original tags, user manual, warranty cards, freebies and accessories.<br /><br />
The product must be returned in the original and undamaged manufacturer packaging / box. 
If the product was delivered in a second layer of Daraz packaging, it must be returned in the same condition with return shipping label attached. 
<br /><br />Do not put tape or stickers on the manufacturer box.
Before returning a mobile / tablet, the device should be formatted and screen lock should be disabled. The iCloud account should be unlocked for Apple devices.
If a product is returned to us in an inadequate condition, we reserve the right to send it back to you.
</span>                                                   
                        
                    
                        
                    </div>
                </div>    
          
                
                           
      
                
            </div>

            </div>
        </div>       
<?php    
}
        
else{
?>    

<script language="javascript" type="text/javascript">
        
    
    window.location="index.php";
    
        </script>        
        
        
<?php    
}
        
?>        
        
        
<div class="clearfix"></div><br />        
<div id="content">
    
    
 <?php 
if(isset($_REQUEST['id'])){   
   
    $dal_Product ->setSubCategoryId($sub_category_id); 
   
$result=$dal_Product ->getAllRelatedProducts();    
if($result->num_rows){
  
?>    
    
    
<div>
         
<div class="col-md-2 center ">
                        <h3><label class="label label-primary">.::  Related Smartphones!.... ::.<i class="glyphicon glyphicon-phone"></i>&nbsp;</label>  </h3>
              </div>     

    
<?php
    
while($row=mysqli_fetch_assoc($result)){
    
   if($row['product_id']!=$id){
    
    
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
                      
     <div class="box col-md-2">
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
    
    
    
                             <li><p> <?php echo $row['product'];?></p></li>
                        <li>
                            <a href="preview.php?id=<?php echo $row['product_id'];?>">    
                       <img src="images/<?php echo $row2['image'];?>" alt="" width="100" height="100"></a>   
                       </li>
                      
                       
                        <li>Price: Rs. <?php echo $row['price'];?></li>
                     <li><span><?php 
                    $dal_Product->setProductId($row['product_id']);
                $result_rate= $dal_Product->getProductTotalRating();
                $row_rate=mysqli_fetch_assoc($result_rate);
                    
                    if($row_rate){                    
    
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
} }  
?>  
  </div>     
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
        
        
    
   
    </div><!--/#content.col-md-0-->
  
  <hr />  
    
    
  
<?php
require_once("require/footer.php");        
?>  
 
</div>

    
<!-- external javascript -->  
<?php
require_once("require/libs_footer.php");        
?> 
<!-- external javascript -->


</body>
</html>

<?php

 require_once("../library/session.php");
	require_once("../library/database.php");
	require_once("../data_access_layer/dal_product.php");
   


$session  = new Session();
$database = new Database();     
 
$dal_Product = new ProductDAL($database->hostname, $database->username, $database->password, $database->database);  





//Search Product
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==1) {
       

$result=$dal_Product ->getProductByUserSearch($_REQUEST['product']);     
if($result->num_rows){
    
   
    
?>    
<div class="row">
<hr />        
<div class="col-md-2 center ">
                        <h3><label class="label label-primary">.:: Search Results ::.<i class="glyphicon glyphicon-phone"></i>&nbsp;</label>  </h3>
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
else{
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert")>×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Fail</u> </strong> Record Not Found!...
                </div>';
    
}    
    
} 
    
?>
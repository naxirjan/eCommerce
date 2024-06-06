<?php
require_once("../library/session.php");
require_once("../library/database.php");
require_once("../data_access_layer/dal_user.php");
require_once("../data_access_layer/dal_product.php");

$session  = new Session();
$database = new Database();
$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);
$dal_Product = new ProductDAL($database->hostname, $database->username, $database->password, $database->database); 

$error=false;


if(isset($_REQUEST['flag']) && $_REQUEST['flag']==1){
$dal_Product->setProductId($_REQUEST['product_id']);
 $dal_Product->setUserId($_SESSION['user']['user_id']);
    
if(isset($_REQUEST['user_review']))  {  
$result_review = $dal_user->addReview($_SESSION['user']['user_id'],$_REQUEST['product_id'],$_REQUEST['user_review'],date('Y-m-d'));    

if($result_review){
    $error=false;
}
else{
$error=true;    
}    
}
    
 
    
if(isset($_REQUEST['rating']))  {  
 $result= $dal_Product->getUserRating();
 
    
    if($result->num_rows){
 $rating= $_REQUEST['rating'];    
$result_update_rate=$dal_Product->updateUserRating($rating);     
if($result_update_rate){
    $error=false;
}
 else{
     $error=true;
 }
 
 }
else{
$result_rating = $dal_user->addRating($_SESSION['user']['user_id'],$_REQUEST['product_id'],$_REQUEST['rating'],date('Y-m-d'));    
if($result_rating){
$error=false;
}
else{
$error=true;    
}    
}
    
    
                        


}
  

    
    
if($error==false){
    echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert")>×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Your Review has Been Added, Thanks!...
                </div>';
?>    
      
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

    
<?php    
    }
elseif($error==true){
      echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert")>×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Fail</u> </strong> Sorry, Something Went Wrong, Please Try Again, Thanks!...
                </div>';    
        
    ?>

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
    <?php
    }
    
    
    
}

?>
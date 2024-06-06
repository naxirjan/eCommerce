<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- View Rating</title>

  <?php
include_once("require/libs_header.php");
?>
    
</head>

<body>
   
    <?php
include_once("require/header.php");
$session  = new Session();
$session->isAdmin();    
$database = new Database();
$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);
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
            <a href="#">View User Ratings</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-eye-open"></i> View User Ratings</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            
            
            <div class="box-content" id="product_result">
                
            
            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">User ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Product</th>
        <th style="text-align:center;">Rating</th>
        <th style="text-align:center;">Rating Date</th>        
    </tr>
    </thead>
    <tbody>
        
    <?php
     
$result= $dal_Product->getProductRatingByStatus(); 
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
      

        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name'];?></td>
       <td style="text-align:center;"><?php echo $row['last_name'];?></td>
        <td style="text-align:center;"><?php echo $row['product']?></td>
       <td style="text-align:center;"><?php  $dal_Product->setRatingImages($row['rating']);?></td>
    <td style="text-align:center;"><?php echo $row['rating_date']?></td>
    
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

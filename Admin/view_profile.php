<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- View Profile</title>

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
            <a href="#">View Profile</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-eye-open"></i> View Profile</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
             
                </div>
            </div>
            <div class="box-content"> 
                       <?php
      if(isset($_REQUEST['success'])){
?>        
<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Account has been updated successfully!...</div>   
  <?php
            }
          
/*if(isset($_REQUEST['fail'])){
?>
<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                   <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Account has not been update successfully!...
                </div> 
<?php    
}
  */              
                
                if(isset($_REQUEST['message'])){
?>
<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                   <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong> Failed , Validation Problems</strong><ul><?php echo $_REQUEST['message'];?></ul>
                </div> 
<?php    
} 
            


//Get Profile Info            
    $user_id = $_SESSION['admin']['user_id'];
    $dal_user->setId($user_id);        
    $result= $dal_user->getUserById(); 

                
       
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){

$id=$row['user_id'];
$first_name=$row['first_name'];
$last_name=$row['last_name'];
$cell=$row['cell'];
$gender=$row['gender'];
$address=$row['address'];
$email=$row['email'];
$password=$row['password'];
$role=$row['role_id']; 
$status=$row['status'];    
}

    }
                
else{
  echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed</u> </strong> , Record Not Found Due To Invlid Input / Action!...
                </div>';   
    
    
}                

                
             

?>                
  
    
     
             <form action="update_profile_process.php" method="POST"  enctype="multipart/form-data">            
 
             
                 
                 
                 
                 
                 
                <fieldset>
				<center><legend>Your Profile Information Details</legend></center>
                    
				
                    
                	<div class="row"> 
                    <div class="col-md-4 ">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">ID:&nbsp;<i class="glyphicon glyphicon-info-sign red"></i></span>
                        <input type="text" class="form-control" name="user_id"  value="<?php if(isset($id)){ echo $id;}?>" disabled><input type="hidden" class="form-control" name="tmp_id"  value="<?php if(isset($id)){ echo $id;}?>">
                        
                        
                        
                    </div>
					</div>
                        
                     
                     <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Status:&nbsp;<i class="glyphicon glyphicon-stats red"></i></span>
                        <input type="text" class="form-control" name="status"  value="<?php 
                        if(isset($status)) {
                        if($status==0){
                        echo "Pending";    
                        }elseif($status==1){
                        echo "Active";    
                        }elseif($status==2){
                        echo "Deactive";    
                        }
                       }                                              
                        ?>"  disabled>
                        
                        
                    <input type="hidden" class="form-control" name="tmp_status"  value="<?php 
                        if(isset($status)) {
                        if($status==0){
                        echo "Pending";    
                        }elseif($status==1){
                        echo "Active";    
                        }elseif($status==2){
                        echo "Deactive";    
                        }
                       }                                              
                        ?>">    
                        
                    </div>
					</div>    
                        
                        
                     <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Role:&nbsp;<i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" name="role"  value="<?php
                    if(isset($role)) {              
                    if($role==1){
                    echo "Admin";    
                    }elseif($role==2){
                    echo "User";}}?>" 
                    disabled>
                        
                       <input type="hidden" class="form-control" name="tmp_role"  value="<?php
                    if(isset($role)) {              
                    if($role==1){
                    echo "Admin";    
                    }elseif($role==2){
                    echo "User";}}?>" 
                    >    
                    </div>
					</div>    
                        
                        
                    </div>    
                    <div class="clearfix"></div><br>
		
                    <div class="row"> 
                    <div class="col-md-6">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">First Name:&nbsp;<i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" name="first_name"  placeholder="enter first name" value="<?php if(isset($first_name)){ echo $first_name;}?>">
                    </div>
					</div>
					<div class="col-md-6"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Last Name:&nbsp;<i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" name="last_name"  placeholder="enter last name" value="<?php if(isset($last_name)) { echo $last_name;}?>">
						
                    </div>
					</div>
                    </div>
                    <div class="clearfix"></div><br>
					
			         		
					<div class="row">
                        
                    	<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Cell No:&nbsp;<i class="glyphicon glyphicon-phone red"></i></span>
                        <input type="number" class="form-control" name="cell"  placeholder="enter cell no" value="<?php if(isset($cell)) { echo $cell;}?>">
                    </div>
					</div>    
                        
                        
					<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Email:&nbsp;<i class="glyphicon glyphicon-envelope red"></i></span>
                        <input type="email" class="form-control" name="email"  placeholder="enter email" value="<?php if(isset($email)) { echo $email;}?>">
                    </div>
					</div>
					
					<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Password:&nbsp;<i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="text" class="form-control" name="password"  placeholder="enter password" value="<?php if(isset($password)) { echo $password;}?>" id="password" name="password">
				  </div>
					</div>
					</div>
					<div class="clearfix"></div><br>
					
                
		
					     		
					<div class="row"> 
                    <div class="col-md-3 center">
                    <div class="input-group input-group-md">
                    <label>Gender:</label> &nbsp;  
                 <?php
                           
                    if(isset($gender)) {       
                      if($gender=="Male"){                          
                    ?>      
                    <span>
                        <input type="radio" name="gender" id="gender1" value="Male" checked="true">
                        Male 
                    </span>&nbsp;               
                    <span>
                        <input type="radio" name="gender" id="gender2" value="Female" >
                         Female
                    </span> 
                     <?php
                      }elseif($gender=="Female"){
                      ?>      
                    <span>
                        <input type="radio" name="gender" id="gender1" value="Male" >
                        Male 
                    </span>&nbsp;               
                    <span>
                        <input type="radio" name="gender" id="gender2" value="Female" checked="true">
                         Female
                    </span>            
                    <?php      
                      }}
                     ?>   
                    
                        
                        
                        
                        </div>    
					</div>
					</div>
					<div class="clearfix"></div><br>
					
                
                    		<div class="row"> 
                    <div class="col-md-12">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Address:&nbsp;<i class="glyphicon glyphicon-map-marker red"></i></span>
                        <textarea rows="4" cols="50" class="form-control" name="address"  placeholder="enter your complete permanent address"><?php if(isset($address)) { echo $address;}?></textarea>
                        </div>
					</div>
                    </div>
                    <div class="clearfix"></div><br>
					
   

                    <p class="center col-md-5">
                        <input type="submit" value="Update Account" name="btn-update" class="btn btn-primary">
                    </p>
                </fieldset>
            </form>            
            
            
            
            
            
            
            
            
            
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

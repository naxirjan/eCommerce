<?php
	require_once("../library/session.php");
	require_once("../library/database.php");
	require_once("../data_access_layer/dal_user.php");
    require_once("../lib_email/PHPMailerAutoload.php");








$session  = new Session();
$session->isAdmin();
$database = new Database();
$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);

$error=false;
$message="";

//Update User Account
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==2) {
    
if(empty($_REQUEST['firstname'])){
$error=true;    
 $message.="<li class='label label-default'>First Name Should Not Be Empty</li><br />";   
}
if(empty($_REQUEST['lastname'])){
$error=true;    
 $message.="<li class='label label-default'>Last Name Should Not Be Empty</li> <br />";     
}
if(empty($_REQUEST['cell'])){
    $error=true;
    $message.="<li class='label label-default'>Cell No Should Not Be Empty</li> <br />";  
}
if(empty($_REQUEST['gender'])){
    $error=true;
    $message.="<li class='label label-default'>Gender Should Not Be Empty</li> <br />";  
}
if(empty($_REQUEST['address'])){
    $error=true;
    $message.="<li class='label label-default'>Address Should Not Be Empty</li> <br />";  
}
if(empty($_REQUEST['email'])){
    $error=true;
    $message.="<li class='label label-default'>Email Should Not Be Empty</li><br />";  
}
if(empty($_REQUEST['password'])){
    $error=true;
    $message.="<li class='label label-default'>Password Should Not Be Empty</li><br />";  
}  


if($error==false){
$status= '';
if($_REQUEST['status']=="Pending"){
$status=0;    
}
elseif($_REQUEST['status']=="Active"){
 $status=1;   
}
elseif($_REQUEST['status']=="Deactive"){
 $status=2;   
}
elseif($_REQUEST['status']=="Approved"){
 $status=3;   
}elseif($_REQUEST['status']=="Disapproved"){
 $status=4;   
}    
    
    
    
        $dal_user->setId($_REQUEST['id']);
        $dal_user->setFirstName($_REQUEST['firstname']);
        $dal_user->setLastName($_REQUEST['lastname']);
        $dal_user->setPhoneNumber($_REQUEST['cell']);
        $dal_user->setGender($_REQUEST['gender']);
        $dal_user->setAddress($_REQUEST['address']);
        $dal_user->setEmail($_REQUEST['email']);
        $dal_user->setPassword($_REQUEST['password']);
        $dal_user->setStatus($status);
        $dal_user->setUserRoleId($_REQUEST['role']);
    
        $result = $dal_user->updateUser();

if ($result) {
	echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Account has been updated successfully!...
                </div>';
}else{
	echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Account has not been updated successfully!...
                </div>';
}    
    
    
    
}
elseif($error==true){
?>       
 <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong> Failed ,  Validation Problems</strong> <ul><?php echo $message ;?></ul>
                </div>   
<?php        
}    
    

}



//Approve User Account Requests
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==3) {
       
        $dal_user->setEmail($_REQUEST['email']);
        $dal_user->setStatus(1);
        $dal_user->setId($_REQUEST['userid']);
        $result = $dal_user->approveUserAccount();
         $dal_user->setEmailMessage("<h2>Your account has been approved successfully.<br>Now you can signin your account.</h2>");
       
       

if ($result) {
$dal_user->sendEmail("Account Status Information");    
	echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Account has been approved successfully!...
                </div>';
?>    
            
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Cell</th>
        <th style="text-align:center;">Gender</th>
        <th style="text-align:center;">Address</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Password</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
        
    </tr>
    </thead>
    <tbody>
        
    <?php
    $dal_user->setStatus(0);    
$result= $dal_user->getAllAccountRequests();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"> <?php echo $row['cell']?></td>
        <td style="text-align:center;"><?php echo $row['gender']?></td>
        <td style="text-align:center;"><?php echo $row['address']?></td>
        <td style="text-align:center;"><?php echo $row['email']?></td>
        <td style="text-align:center;"><?php echo $row['password']?></td>
        <td style="text-align:center;">
            <?php if($row['role_id']==1){
            ?>
            <span class="label-primary label label-default"><?php echo "Admin"; ?></span>
           <?php
            } 
            else{ echo "User"; }                                        
                                        
            ?>

        
        <td style="text-align:center;">
            <?php
            if($row['status']==0){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending"; ?></span>
            <?php    
            } 
                                         
            ?>
        </td>
        
        <td style="text-align:center;">
            
            <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Approve" onclick="ApproveUser(<?php echo $row['user_id']?>)">
      
            
           <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Dispprove" onclick="DisapproveUser(<?php echo $row['user_id']?>)">
        
        </td>
    <input type="hidden" id="email<?php echo $row['user_id'];?>" value="<?php echo $row['email']?>" />    
        
    </tr>
        
        
<?php        
}           
}
else{
echo '<div class="alert alert-info center">
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
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Account has not been approved successfully!...
                </div>';
    
?>
         
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Cell</th>
        <th style="text-align:center;">Gender</th>
        <th style="text-align:center;">Address</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Password</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
        
    </tr>
    </thead>
    <tbody>
        
    <?php
    $dal_user->setStatus(0);    
$result= $dal_user->getAllAccountRequests();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"> <?php echo $row['cell']?></td>
        <td style="text-align:center;"><?php echo $row['gender']?></td>
        <td style="text-align:center;"><?php echo $row['address']?></td>
        <td style="text-align:center;"><?php echo $row['email']?></td>
        <td style="text-align:center;"><?php echo $row['password']?></td>
        <td style="text-align:center;">
            <?php if($row['role_id']==1){
            ?>
            <span class="label-primary label label-default"><?php echo "Admin"; ?></span>
           <?php
            } 
            else{ echo "User"; }                                        
                                        
            ?>

        
        <td style="text-align:center;">
            <?php
            if($row['status']==0){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending"; ?></span>
            <?php    
            } 
                                         
            ?>
        </td>
        
        <td style="text-align:center;">
            
            <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Approve" onclick="ApproveUser(<?php echo $row['user_id']?>)">
      
            
           <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Dispprove" onclick="DisapproveUser(<?php echo $row['user_id']?>)">
        
        </td>
    <input type="hidden" id="email<?php echo $row['user_id'];?>" value="<?php echo $row['email']?>" />    
        
    </tr>
        
        
<?php        
}           
}
else{
echo '<div class="alert alert-info center">
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


//Disapprove User Account Requests
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==4) {
    
    
        $dal_user->setEmail($_REQUEST['email']);
        $dal_user->setStatus(2);
        $dal_user->setId($_REQUEST['userid']);
     $dal_user->setEmailMessage("<h2>Your account has been disapproved successfully.<br> You can not signin your account now!...</h2>");
 
        $result = $dal_user->approveUserAccount();

if ($result) {
 $dal_user->sendEmail("Account Status Information");    
	echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Account has been disapproved!...
                </div>';
?>    
   
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Cell</th>
        <th style="text-align:center;">Gender</th>
        <th style="text-align:center;">Address</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Password</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
        
    </tr>
    </thead>
    <tbody>
        
    <?php
    $dal_user->setStatus(0);    
$result= $dal_user->getAllAccountRequests();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"> <?php echo $row['cell']?></td>
        <td style="text-align:center;"><?php echo $row['gender']?></td>
        <td style="text-align:center;"><?php echo $row['address']?></td>
        <td style="text-align:center;"><?php echo $row['email']?></td>
        <td style="text-align:center;"><?php echo $row['password']?></td>
        <td style="text-align:center;">
            <?php if($row['role_id']==1){
            ?>
            <span class="label-primary label label-default"><?php echo "Admin"; ?></span>
           <?php
            } 
            else{ echo "User"; }                                        
                                        
            ?>

        
        <td style="text-align:center;">
            <?php
            if($row['status']==0){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending"; ?></span>
            <?php    
            } 
                                         
            ?>
        </td>
        
        <td style="text-align:center;">
            
            <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Approve" onclick="ApproveUser(<?php echo $row['user_id']?>)">
      
            
           <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Dispprove" onclick="DisapproveUser(<?php echo $row['user_id']?>)">
        
        </td>
    <input type="hidden" id="email<?php echo $row['user_id'];?>" value="<?php echo $row['email']?>" />    
    </tr>
        
        
<?php        
}           
}
else{
echo '<div class="alert alert-info center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Sorry, </strong>No other account requests were found!...
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
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Account has not been Disapproved successfully!...
                </div>';
    ?>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Cell</th>
        <th style="text-align:center;">Gender</th>
        <th style="text-align:center;">Address</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Password</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
        
    </tr>
    </thead>
    <tbody>
        
    <?php
    $dal_user->setStatus(0);    
$result= $dal_user->getAllAccountRequests();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"> <?php echo $row['cell']?></td>
        <td style="text-align:center;"><?php echo $row['gender']?></td>
        <td style="text-align:center;"><?php echo $row['address']?></td>
        <td style="text-align:center;"><?php echo $row['email']?></td>
        <td style="text-align:center;"><?php echo $row['password']?></td>
        <td style="text-align:center;">
            <?php if($row['role_id']==1){
            ?>
            <span class="label-primary label label-default"><?php echo "Admin"; ?></span>
           <?php
            } 
            else{ echo "User"; }                                        
                                        
            ?>

        
        <td style="text-align:center;">
            <?php
            if($row['status']==0){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending"; ?></span>
            <?php    
            } 
                                         
            ?>
        </td>
        
        <td style="text-align:center;">
            
            <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Approve" onclick="ApproveUser(<?php echo $row['user_id']?>)">
      
            
           <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Dispprove" onclick="DisapproveUser(<?php echo $row['user_id']?>)">
        
        </td>
    <input type="hidden" id="email<?php echo $row['user_id'];?>" value="<?php echo $row['email']?>" />    
    </tr>
        
        
<?php        
}           
}
else{
echo '<div class="alert alert-info center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Sorry, </strong>No other account requests were found!...
                </div>';   
}        
        
        
?>
        
        </tbody>
    </table> 


<?php
}    

}



//Acitve User Account
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==11){
    
    
      $dal_user->setEmail($_REQUEST['email']);
     $dal_user->setPassword($_REQUEST['password']);    
    $dal_user->setStatus(1);
        $dal_user->setId($_REQUEST['userid']);
         $dal_user->setEmailMessage("Your account has been activated.<br>Your account login information is given below<br>"."Email:<br>  ".$_REQUEST['email']."<br>Password:<br />".$_REQUEST['password']);
       
        $result = $dal_user->approveUserAccount();

if ($result) {
 $dal_user->sendEmail("Account Status Information");    
	echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Account has been acctivated successfully!...
                </div>';
?> 

     <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Gender</th>
        <th style="text-align:center;">Email Address</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
    $dal_user->setStatus(0);    
$result= $dal_user->getAllUsers();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"><?php echo $row['gender']?></td>
        <td style="text-align:center;"><?php echo $row['email']?></td>
        <td style="text-align:center;">
            <?php if($row['role_id']==1){
            ?>
            <span class="label-primary label label-default"><?php echo "Admin"; ?></span>
           <?php
            } 
            else{ echo "User"; }                                        
                                        
            ?>

        </td>
        <td style="text-align:center;">
            <?php
          if($row['status']==1){
            ?>    
            <span class="label-success label label-default"><?php echo "Active";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']==2){
            ?>    
            <span class="label-danger label label-default"><?php echo "Deactive";?></span>
            <?php    
            }                                 
            ?>
        </td>   
        <td style="text-align:center;">
            <a class="btn btn-info" href="update_user.php?id=<?php echo $row['user_id'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <?php
            if($row['status']==1){
            ?>
            
              
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" disabled>
             
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" >
                
            
            <?php
            }
                                        
             
             elseif($row['status']==2){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" >
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
           
        
            <?php
            }                            
                                        
            
              elseif($row['status']==3){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)">
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
           
            
                  
            <?php
            }                             
              
                                        
                 elseif($row['status']==4){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" disabled>
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
                   
            <?php
            }                            
                                        
                                        
            ?>      
        </td>
        <input type="hidden" id="email<?php echo $row['user_id']?>" value="<?php echo $row['email']?>">
         <input type="hidden" id="password<?php echo $row['user_id']?>" value="<?php echo $row['password']?>">
        </tr>
        
        
<?php        
}           
}
else{
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Alert, </strong>Records Not Found!...
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
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Account has not been acctivated successfully!...
                </div>';
    
?>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Gender</th>
        <th style="text-align:center;">Email Address</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
    $dal_user->setStatus(0);    
$result= $dal_user->getAllUsers();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"><?php echo $row['gender']?></td>
        <td style="text-align:center;"><?php echo $row['email']?></td>
        <td style="text-align:center;">
            <?php if($row['role_id']==1){
            ?>
            <span class="label-primary label label-default"><?php echo "Admin"; ?></span>
           <?php
            } 
            else{ echo "User"; }                                        
                                        
            ?>

        </td>
        <td style="text-align:center;">
            <?php
          if($row['status']==1){
            ?>    
            <span class="label-success label label-default"><?php echo "Active";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']==2){
            ?>    
            <span class="label-danger label label-default"><?php echo "Deactive";?></span>
            <?php    
            }                                 
            ?>
        </td>   
        <td style="text-align:center;">
            <a class="btn btn-info" href="update_user.php?id=<?php echo $row['user_id'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <?php
            if($row['status']==1){
            ?>
            
              
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" disabled>
             
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" >
                
            
            <?php
            }
                                        
             
             elseif($row['status']==2){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" >
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
           
        
            <?php
            }                            
                                        
            
              elseif($row['status']==3){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)">
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
           
            
                  
            <?php
            }                             
              
                                        
                 elseif($row['status']==4){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" disabled>
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
                   
            <?php
            }                            
                                        
                                        
            ?>      
        </td>
        <input type="hidden" id="email<?php echo $row['user_id']?>" value="<?php echo $row['email']?>">
         <input type="hidden" id="password<?php echo $row['user_id']?>" value="<?php echo $row['password']?>">
        </tr>
        
        
<?php        
}           
}
else{
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Alert, </strong>Records Not Found!...
                </div>';   
}        
        
        
?>
        
        </tbody>
    </table>   


<?php
}    
    

}


//Deactive User Account
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==22) {
$dal_user->setEmail($_REQUEST['email']);  
    $dal_user->setStatus(2);
        $dal_user->setId($_REQUEST['userid']);
         $dal_user->setEmailMessage("<h2>Your account has been deactivated.<br>You can not signin your account now!...</h2>");
        $result = $dal_user->approveUserAccount();

if ($result) {
 $dal_user->sendEmail("Account Status Information");    
	echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success</u> </strong> Account has been deactivated successfully!...
                </div>';
?> 

     <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Gender</th>
        <th style="text-align:center;">Email Address</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
    $dal_user->setStatus(0);    
$result= $dal_user->getAllUsers();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"><?php echo $row['gender']?></td>
        <td style="text-align:center;"><?php echo $row['email']?></td>
        <td style="text-align:center;">
            <?php if($row['role_id']==1){
            ?>
            <span class="label-primary label label-default"><?php echo "Admin"; ?></span>
           <?php
            } 
            else{ echo "User"; }                                        
                                        
            ?>

        </td>
        <td style="text-align:center;">
            <?php
          if($row['status']==1){
            ?>    
            <span class="label-success label label-default"><?php echo "Active";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']==2){
            ?>    
            <span class="label-danger label label-default"><?php echo "Deactive";?></span>
            <?php    
            }                                 
            ?>
        </td>   
        <td style="text-align:center;">
            <a class="btn btn-info" href="update_user.php?id=<?php echo $row['user_id'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <?php
            if($row['status']==1){
            ?>
            
              
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" disabled>
             
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" >
                
            
            <?php
            }
                                        
             
             elseif($row['status']==2){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" >
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
           
        
            <?php
            }                            
                                        
            
              elseif($row['status']==3){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)">
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
           
            
                  
            <?php
            }                             
              
                                        
                 elseif($row['status']==4){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" disabled>
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
                   
            <?php
            }                            
                                        
                                        
            ?>      
        </td>
        <input type="hidden" id="email<?php echo $row['user_id']?>" value="<?php echo $row['email']?>">
         <input type="hidden" id="password<?php echo $row['user_id']?>" value="<?php echo $row['password']?>">
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
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Account has not been deactivated successfully!...
                </div>';
    
    ?>
  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Gender</th>
        <th style="text-align:center;">Email Address</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
    $dal_user->setStatus(0);    
$result= $dal_user->getAllUsers();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"><?php echo $row['gender']?></td>
        <td style="text-align:center;"><?php echo $row['email']?></td>
        <td style="text-align:center;">
            <?php if($row['role_id']==1){
            ?>
            <span class="label-primary label label-default"><?php echo "Admin"; ?></span>
           <?php
            } 
            else{ echo "User"; }                                        
                                        
            ?>

        </td>
        <td style="text-align:center;">
            <?php
          if($row['status']==1){
            ?>    
            <span class="label-success label label-default"><?php echo "Active";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']==2){
            ?>    
            <span class="label-danger label label-default"><?php echo "Deactive";?></span>
            <?php    
            }                                 
            ?>
        </td>   
        <td style="text-align:center;">
            <a class="btn btn-info" href="update_user.php?id=<?php echo $row['user_id'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <?php
            if($row['status']==1){
            ?>
            
              
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" disabled>
             
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" >
                
            
            <?php
            }
                                        
             
             elseif($row['status']==2){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" >
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
           
        
            <?php
            }                            
                                        
            
              elseif($row['status']==3){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)">
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
           
            
                  
            <?php
            }                             
              
                                        
                 elseif($row['status']==4){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" disabled>
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
                   
            <?php
            }                            
                                        
                                        
            ?>      
        </td>
        <input type="hidden" id="email<?php echo $row['user_id']?>" value="<?php echo $row['email']?>">
         <input type="hidden" id="password<?php echo $row['user_id']?>" value="<?php echo $row['password']?>">
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


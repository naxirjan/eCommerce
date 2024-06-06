<?php


require_once("../library/session.php");
	require_once("../library/database.php");
    require_once("../data_access_layer/dal_user.php");
    

$session = new Session();
    $session->isAdmin();
    $database = new Database();
	$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);





$error=false;
$message="";

  if(isset($_POST['btn-update'])){ 
     

$userid=$_POST['tmp_id'];
$userrole=$_POST['tmp_role'];
$userstatus=$_POST['tmp_status'];                
      
      
if(empty($_REQUEST['first_name'])){
$error=true;    
 $message.="<li class='label label-default'>First Name Should Not Be Empty</li><br />";   
}
if(empty($_REQUEST['last_name'])){
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
    

      if($userrole=="Admin"){
          $userrole=1;
      }
        elseif($userrole=="User"){
      $userrole=2;}
      
      
      if( $userstatus=="Active"){
          $userstatus=1;
      }
        elseif( $userstatus=="Deactive"){
          $userstatus=2;
      }
      
        $dal_user->setId($userid);
        $dal_user->setFirstName($_POST['first_name']);
        $dal_user->setLastName($_POST['last_name']);
        $dal_user->setPhoneNumber($_POST['cell']);
        $dal_user->setGender($_POST['gender']);
        $dal_user->setAddress($_POST['address']);
        $dal_user->setEmail($_POST['email']);
        $dal_user->setPassword($_POST['password']);
        $dal_user->setUserRoleId($userrole);
        $dal_user->setStatus($userstatus);  
    
        $result = $dal_user->updateUser();

if ($result) {
header("location:view_profile.php?success=true"); 
}
else{
$message.="<li class='label label-default'>Enter Your Password</li><br />";  
}     
}
      
elseif($error==true){
    
header("location:view_profile.php?message=$message"); 
        
}
      
      
  }
 
?>
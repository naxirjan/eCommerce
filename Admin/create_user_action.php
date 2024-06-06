<?php
	require_once("../library/session.php");
	require_once("../library/database.php");
	require_once("../data_access_layer/dal_user.php");
    //require_once("lib_email/PHPMailerAutoload.php");





$session  = new Session();
$session->isAdmin();
$database = new Database();
	$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);

$message="";
$error=false;

//Create New User Account
if(isset($_REQUEST['btn-create-user'])) {    

if(empty($_REQUEST['first_name'])){
$error=true;    
 $message.="<li class='label label-default'>Enter Your First Name</li><br />";   
}
if(empty($_REQUEST['last_name'])){
$error=true;    
 $message.="<li class='label label-default'>Enter your Last Name</li> <br />";     
}
if(empty($_REQUEST['cell'])){
    $error=true;
    $message.="<li class='label label-default'>Enter Your Cell No</li> <br />";  
}
if(empty($_REQUEST['gender'])){
    $error=true;
    $message.="<li class='label label-default'>Choose Your Gender</li> <br />";  
}
if(empty($_REQUEST['address'])){
    $error=true;
    $message.="<li class='label label-default'>Enter Your Address</li> <br />";  
}
if(empty($_REQUEST['email'])){
    $error=true;
    $message.="<li class='label label-default'>Enter Your Email</li><br />";  
}
if(empty($_REQUEST['password'])){
    $error=true;
    $message.="<li class='label label-default'>Enter Your Password</li><br />";  
}    
else{
    
    $dal_user->setFirstName($_REQUEST['first_name']);
        $dal_user->setLastName($_REQUEST['last_name']);
        $dal_user->setPhoneNumber($_REQUEST['cell']);
        $dal_user->setGender($_REQUEST['gender']);
        $dal_user->setAddress($_REQUEST['address']);
        $dal_user->setEmail($_REQUEST['email']);
        $dal_user->setPassword($_REQUEST['password']);
        $dal_user->setEmailMessage("Your account login information is given below<br />"."Email:<br />  ".$_REQUEST['email']."<br />Password:<br />".$_REQUEST['password']);
        $result = $dal_user->createUserAccount();

if ($result) {
$error=false;
}
else{    
$error=true;    
}    
        
}    
    
if($error==true){
header("location:create_user.php?message=$message");    }
if($error==false){    
$dal_user->sendEmail();    
header("location:create_user.php?success=true");
}
    
    
    
}
?>
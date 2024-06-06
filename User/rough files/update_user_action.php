<?php
	require_once("library/session.php");
	require_once("library/database.php");
	require_once("data_access_layer/dal_user.php");
    require_once("lib_email/PHPMailerAutoload.php");





$session  = new Session();
$session->isAdmin();
$database = new Database();
	$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);



//Update User Account
if (isset($_REQUEST['btn-update-user'])) {
       $id=$_REQUEST['id'];
        $dal_user->setId($_REQUEST['id']);
        $dal_user->setFirstName($_REQUEST['first_name']);
        $dal_user->setLastName($_REQUEST['last_name']);
        $dal_user->setPhoneNumber($_REQUEST['cell']);
        $dal_user->setGender($_REQUEST['gender']);
        $dal_user->setAddress($_REQUEST['address']);
        $dal_user->setEmail($_REQUEST['email']);
        $dal_user->setPassword($_REQUEST['password']);
        $dal_user->setStatus($_REQUEST['status']);
        $dal_user->setUserRoleId($_REQUEST['role']);
    
        $result = $dal_user->updateUser();

if ($result) {
header("location:update_user.php?id='$id'&success=true");
}else{
header("location:update_user.php?id='$id'&fail=true");	
}
}





?>
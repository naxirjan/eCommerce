<?php
	require_once("../library/session.php");
	require_once("../library/database.php");
	require_once("../data_access_layer/dal_user.php");
    




$session  = new Session();
$session->isUser();
$database = new Database();
	$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);


//Create New User Account
if (isset($_REQUEST['btn-signup'])) {
    
    
        $dal_user->setFirstName($_REQUEST['first_name']);
        $dal_user->setLastName($_REQUEST['last_name']);
        $dal_user->setPhoneNumber($_REQUEST['cell']);
        $dal_user->setGender($_REQUEST['gender']);
        $dal_user->setAddress($_REQUEST['address']);
        $dal_user->setEmail($_REQUEST['email']);
        $dal_user->setPassword($_REQUEST['password']);
        $result = $dal_user->createUserAccount();

    
if ($result) {
header("location:signup.php?success=true");
}else{
header("location:signup.php?fail=true");
}
}

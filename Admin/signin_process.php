<?php
	require_once("../library/session.php");
	require_once("../library/database.php");
	require_once("../data_access_layer/dal_user.php");


 



$session  = new Session();


$database = new Database();
	$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);


$error=true;
$error_message="";

$email=$_POST["email"];
$password =$_POST["password"];	
    
    
$email_pattern="/^[a-zA-Z_.]{5,12}@{1}[a-z]{5,8}.{1}[a-z]{2,3}$/i";	



/*Condition Email*/
if(!preg_match($email_pattern,$email) && $email!="") {
$error=false;	
$error_message.="Email : Email format must be correct<br />";
}
else if($email=="") {
$error=false;	
$error_message.="Email : Please Enter Your Email<br />";	
}
else {
$error_message.="";	
}
/*Condition Email*/


/*Condition Password*/
if($password=="") {	
$error=false;	
$error_message.="Password : Please Enter Your Password<br />";	
}
else {	
$error_message.="";	
}
/*Condition Password*/


if($error==true){
	$dal_user->setEmail($_POST["email"]);
	$dal_user->setPassword($_POST["password"]);
    $dal_user->setStatus(1);
    $dal_user->setUserRoleId(1);
	
    $result = $dal_user->signin();

	if($result->num_rows)
	{
		$admin = mysqli_fetch_assoc($result);
		$session->setAdminSession($admin);
			header("location:dashboard.php");
	}
	else
	{
		header("location: index.php?message=Authentication failed, email or password wrong.");
	}
}

else{
$error=false;
header("location:index.php?message=$error_message");        
}


?>
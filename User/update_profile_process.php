<?php


require_once("../library/session.php");
	require_once("../library/database.php");
    require_once("../data_access_layer/dal_user.php");
    

$session = new Session();
    $session->isUser();
    $database = new Database();
	$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);







  if(isset($_POST['btn-update'])){ 
     
       $userid=$_POST['tmp_id'];
       $userrole=$_POST['tmp_role'];
      $userstatus=$_POST['tmp_status'];                
       
     
      
      if(empty($_POST['first_name']) || empty($_POST['last_name'])|| empty($_POST['cell'])|| empty($_POST['gender'])|| empty($_POST['address'])|| empty($_POST['password'])){
      
     header("location:update_profile.php?empty=true"); 
      }
      
      else{
      
      if($userrole=="Admin"){
          $userrole=1;
      }
      elseif($userrole=="User"){
      $userrole=2;}
      
      
      if( $userstatus=="Active"){
          $userstatus=1;
      }elseif( $userstatus=="Deactive"){
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
	header("location:update_profile.php?success=true");
}else{
	header("location:update_profile.php?fail=true");
}
          
}

  }
 
?>
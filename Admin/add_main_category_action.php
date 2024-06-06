<?php
	require_once("../library/session.php");
	require_once("../library/database.php");
	require_once("../data_access_layer/dal_category.php");

$session  = new Session();
$session->isAdmin();
$database = new Database();
$dal_Category = new CategoryDAL($database->hostname, $database->username, $database->password, $database->database);




if(isset($_REQUEST['btn-add-main-category'])){

if(empty($_REQUEST['main_category'])){   
header("location:add_main_category.php?message=empty");        
}

else{
    
        $dal_Category->setMainCategory($_REQUEST['main_category']);
        $result = $dal_Category->addMainCategory();
    
    
if ($result) {
header("location:add_main_category.php?message=success");            

}
    
    else{
    header("location:add_main_category.php?message=fail");            
    
    }       
}
    
}
?>
<?php


  	require_once("../library/session.php");
	require_once("../library/database.php");
	require_once("../data_access_layer/dal_sub_category.php");

$session  = new Session();
$session->isAdmin();
$database = new Database();
$dal_Sub_Category = new SubCategoryDAL($database->hostname, $database->username, $database->password, $database->database);

if(isset($_REQUEST['btn-update-sub-category'])){
        
if(empty($_REQUEST['sub_category'])){
header("location:view_sub_category.php?message=empty");        
}    
    
else{
        
$dal_Sub_Category->setSubCategoryId($_REQUEST['id']);
$dal_Sub_Category->setSubCategory($_REQUEST['sub_category']);    
$result = $dal_Sub_Category->updateSubCategory();    
if($result){    
header("location:view_sub_category.php?message=success");        
}
else{
header("location:view_sub_category.php?message=fail");        
    
}    

}
        
}




?>
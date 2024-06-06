<?php


    require_once("../library/session.php");
	require_once("../library/database.php");
	require_once("../data_access_layer/dal_product.php");
   
$session  = new Session();


$session->isAdmin();
$database = new Database();     
 
$dal_Product = new ProductDAL($database->hostname, $database->username, $database->password, $database->database);  



if(isset($_POST['btn-add-product'])){  
    
$file = $_FILES['images'];    
    
$dal_Product->setSubCategoryId(htmlspecialchars( $_POST['sub_category_id']));
$dal_Product->setProduct(htmlspecialchars($_POST['product_name']));
$dal_Product->setDesctiption(htmlspecialchars($_POST['description']));    
$dal_Product->setPrice(htmlspecialchars($_POST['price']));
$dal_Product->setStock(htmlspecialchars($_POST['stock']));
$dal_Product->setShipAmount(htmlspecialchars($_POST['free_shipping_price']));
$dal_Product->setIsFeatured(htmlspecialchars($_POST['is_featured']));     

$dal_Product->setWeight(htmlspecialchars($_POST['weight']));    
$dal_Product->setOperatingSystem(htmlspecialchars($_POST['operating_system']));
$dal_Product->setDisplaySize(htmlspecialchars($_POST['display_size']));
$dal_Product->setRam(htmlspecialchars($_POST['ram']));
$dal_Product->setRom(htmlspecialchars($_POST['rom']));
$dal_Product->setProcessor(htmlspecialchars($_POST['processor']));
$dal_Product->setFrontCamera(htmlspecialchars($_POST['front_camera']));
$dal_Product->setBackCamera(htmlspecialchars($_POST['back_camera']));
$dal_Product->setBattery(htmlspecialchars($_POST['battery']));
$dal_Product->setSimType(htmlspecialchars($_POST['sim_type']));    
    
$dal_Product->setStartDate(htmlspecialchars($_POST['start_date']));
$dal_Product->setCloseDate(htmlspecialchars($_POST['close_date']));
$dal_Product->setDiscount(htmlspecialchars($_POST['discount']));

    

$result = $dal_Product->addProduct();
    
if($result){
    
$types = array('image/jpeg', 'image/png','image/jpg');
    
$res=false; 
    
$file = $_FILES['images'];

    
       
    
foreach($file['name'] as $id=> $value){
$file_name = $file['name'][$id];
$tmp_name = $file['tmp_name'][$id];

$dal_Product->setProductId($result);
$dal_Product->setImage($file_name);
$dal_Product->addImage();     
    
if (move_uploaded_file($tmp_name,"../images/".$file_name)){
 $res=true;           
}
else{
$res=false;    
}    
}    
    
    
    
if($res==true){
header("location:add_product.php?success=true");        
}
else{    
header("location:add_product.php?fail=true");        
}    
    
}
else{    
header("location:add_product.php?fail=true");        
}    
        
}



?>
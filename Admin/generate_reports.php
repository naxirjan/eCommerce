<?php
require_once("../library/session.php");
require_once("require/excelwriter.inc.php");
require_once("../library/database.php");






require_once("../data_access_layer/dal_cart.php");
require_once("../data_access_layer/dal_cart_product.php");
require_once("../data_access_layer/dal_order.php");


$session = new Session();
$session->isAdmin();
$database = new Database();
$dal_order = new  OrderDAL($database->hostname, $database->username, $database->password, $database->database);
  
$dal_cartproducts = new  Cart_Product_DAL($database->hostname, $database->username, $database->password, $database->database);








//Columns Names From Database

$excel = new ExcelWriter("order_report.xls");
$query = "SELECT * FROM user_order";
$result = mysqli_query($connection, $query);
if ($result) {
$excel->writeRow();


while ($cols = mysqli_fetch_field($result)) {
	$excel->writeCol(strtoupper($cols->name), array("color"=>"purple", "text-align"=>"center", "font-weight"=>"bolder"));
}
}


$result= $dal_order->getAllUserOrders(); 
if(is_object($result) && $result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){ 
    
         $excel->writeRow();
			$excel->writeCol($row['order_id'], array("color"=>"black"));
			$excel->writeCol($row['order_date'], array("color"=>"black"));
			$excel->writeCol($row['delivery_date'], array("color"=>"black"));
			$excel->writeCol($row['shipping_address'], array("color"=>"black"));
			$excel->writeCol($row['billing_address'], array("color"=>"black"));
			$excel->writeCol($row['status'], array("color"=>"black"));
									
		}	
	

	$excel->close();
		header("location:view_orders.php?message=Order Report Has Been Generated Successfully!...");
}

else{
header("location:view_orders?message=No Record Found!...");	
}
?>
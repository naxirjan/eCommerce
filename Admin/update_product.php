<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- Update roduct</title>

  <?php
include_once("require/libs_header.php");
?>
    
    
    
    
   
    <script type="text/javascript">
function updateProduct(){
var product_id = document.getElementById("product_id").value; 
var sub_category_id  = document.getElementById("sub_category_id").value; 
var product_name = document.getElementById("product_name").value; 
var description = document.getElementById("description").value;     
var price = document.getElementById("price").value; 
var stock = document.getElementById("stock").value; 
var free_shipping_price = document.getElementById("free_shipping_price").value;     
    var weight = document.getElementById("weight").value; 
    var operating_system = document.getElementById("operating_system").value; 
    var display_size = document.getElementById("display_size").value; 
    var processor = document.getElementById("processor").value; 
    var front_camera = document.getElementById("front_camera").value; 
    var back_camera = document.getElementById("back_camera").value; 
    var sim_type = document.getElementById("sim_type").value; 
    var ram = document.getElementById("ram").value; 
    var rom = document.getElementById("rom").value; 
    var battery = document.getElementById("battery").value; 
    var discount= document.getElementById("discount").value; 
    var start_date = document.getElementById("start_date").value; 
    var close_date = document.getElementById("close_date").value; 
    var is_featured = document.getElementById("is_featured").value; 
    var images = document.getElementById("images[]").value; 


    var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("msg").innerHTML= ajax.responseText;
       
}
}    
ajax.open("GET","ajax_product.php?flag=3&id="+product_id+          "&product_name="+product_name+"&description="+description+"&price="+price+"&stock="+stock+"&free_shipping_price="+free_shipping_price+"&is_featured="+is_featured+"&weight="+weight+"&operating_system="+operating_system+"&display_size="+display_size+"&processor="+processor+"&front_camera="+front_camera+"&back_camera="+back_camera+"&sim_type="+sim_type+"&ram="+ram+"&rom="+rom+"&battery="+battery);


ajax.send();
}   
    </script>      
    
    
  
</head>

<body>
   
    <?php
include_once("require/header.php");
    
$session  = new Session();
$session->isAdmin();
$database = new Database();     
$dal_SubCategory = new SubCategoryDAL($database->hostname, $database->username, $database->password, $database->database);  
$dal_Product = new ProductDAL($database->hostname, $database->username, $database->password, $database->database);  
    
?>
    
    
<div class="ch-container">
    <div class="row">
        
      
    <?php
include_once("require/nav_bar.php");
?>
      <noscript>
     
            <div class="col-md-offset-3 col-md-5">
            <input type="button" value="Javascript Is Disabled Or Your Browser Does Not Support Javascript" class="btn btn-danger btn-lg ">    
</div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Update Product</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Update Product</h2>

                <div class="box-icon">
                 
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            
            
           
            
         <div class="box-content" >
                
    <?php 
    if(isset($_REQUEST['id'])){                     
    $dal_Product->setProductId($_REQUEST['id']);                     
    $result= $dal_Product->getProductById();                     
    
    if($result){    
    while($row = mysqli_fetch_assoc($result)){    
       
$product_id=$row['product_id'];
$category_title=$row['category_title'];
$sub_category=$row['sub_category'] ;
$sub_category_id=$row['sub_category_id'] ;        
$product=$row['product'] ;
$description=$row['description'] ;        
$featured=$row['featured'] ;
$free_shipping=$row['free_shipping'] ;
$price=$row['price'];
$stock=$row['stock'];
$least_quantity=$row['least_quantity'] ;
$status=$row['status'];
$product_extra_info_id=$row['product_extra_info_id'] ;
$weight=$row['weight'];
$operating_system=$row['operating_system'] ;
$display_size=$row['display_size'] ;
$internal_memory=$row['internal_memory'] ;
$external_memory=$row['external_memory'] ;
$processor=$row['processor'] ;
$front_camera=$row['front_camera'] ;
$back_camera=$row['back_camera'] ;
$battery=$row['battery'] ;
$sim_type=$row['sim_type'] ;
$product_discount_id=$row['product_discount_id'] ;
$start_date=$row['start_date'] ;
$close_date=$row['close_date'] ;
$product_discount=$row['product_discount'] ;
        
}
}                     
     
   /* $result=$dal_Product->getProductImages();         
    if($result->num_rows){    
    echo "<pre>";
    while($row = mysqli_fetch_assoc($result)){
echo $row['image']."<br>";         
    }
    }*/          
    
        
        
        
   // echo $category_title;    
        
    }
    ?>       
        
                
                    <div class="row">
                   <div class="col-md-8 center">
                    <ul class="thumbnails "> 
                        <p>
                        <?php
                    $result=$dal_Product->getProductImages();         
    if($result->num_rows){    
    while($row = mysqli_fetch_assoc($result)){
?>
      <li id="image-1" class="thumbnail">
            <a style="background:url(../User/images/<?php echo $row['image'];?>)"
            title="Sample Image " href="../User/images/<?php echo $row['image'];?>">
            <img class="grayscale" src="../User/images/<?php echo $row['image'];?>"
            alt="Sample Image 2"></a> 
            <input type="checkbox" name="img[]" id="img[]" value="<?php echo $row['product_image_id'];?>">
            </li>
               
            <?php
            }}     
            ?>    
                            
                          </p>   
                        </ul>
                        
                    </div>
                        
                        
                    </div>
                         
                   
                     
             
             
             
        <div class=" col-md-12 center" >
    <?php
      if(isset($_REQUEST['success'])){
?>        
<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Product has been added successfully!...</div>   
  <?php
            }
          
if(isset($_REQUEST['fail'])){
?>
<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                   <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Product has not been created successfully!...
                </div> 
<?php    
}            
?>
            
        
            
           
    
               
     <div class="row"> 
                    <div class="col-md-3 center"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign red"></i>&nbsp; Product ID</span>
                        <input type="text" class="form-control" name="product_id" id="product_id" value="<?php echo $product_id;?>" placeholder="enter product id" disabled>
						
                    </div>
					</div>
                    </div>
                    <div class="clearfix"></div><br>
					            
                    <div class="row">
                        
                 
                       <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt red"></i>&nbsp; Sub Category</span>
                        
                        <select class="form-control center" name="sub_category_id" id="sub_category_id">
                        <option value="<?php echo $sub_category_id;?>"><?php echo $sub_category;?></option>    
                        <?php
                        $dal_SubCategory->setStatus("active");
                       $result=$dal_SubCategory->getSubCategoryByStatus();    
                        if($result->num_rows){
                        
                    while($row=mysqli_fetch_assoc($result)) {
                    ?>
                     <option value="<?php echo $row['sub_category_id'];?>"><?php echo $row['sub_category'];?></option>       
                    <?php        
                    }       
                        }    
                        ?>       
                        </select>
                        
                    </div>
					</div>
				    
                        
                        <div class="col-md-4"> 
                            
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone red"></i>&nbsp; Product</span>
                        <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo $product;?>" placeholder="enter product name">
						
                    </div>
					</div>
                   
                        
                    <div class="col-md-4"> 

					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd red"></i>&nbsp; Price</span>
                        <input type="text"  id="price" class="form-control" name="price"  value="<?php echo $price;?>" placeholder="enter product price">
						
                    </div>
					</div>
                        
               
                    </div>
                    <div class="clearfix"></div><br>
					
			         		
					<div class="row">
                        
                       
                          
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-shopping-cart red"></i>&nbsp; Stock</span>
                        <input type="text" class="form-control" id="stock" name="stock"  value="<?php echo $stock;?>" placeholder="enter product stock">
                    </div>
					</div>
                            
                        
                        
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd red"></i>&nbsp; Shipping</span>
                         <input type="text" class="form-control" name="free_shipping_price" id="free_shipping_price" value="<?php echo $free_shipping;?>"  placeholder="enter free shipping amount">
                        
                    </div>
					</div>    
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-sound-5-1 red"></i>&nbsp; Weight</span>
                        <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $weight;?>"  placeholder="enter the weight">
                       
                    </div>
					</div>
                            
                    </div>
					<div class="clearfix"></div><br>
					
                
      
                    <div class="row">    
                      <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-question-sign red"></i>&nbsp; OS Type</span>
                        <input type="text" class="form-control"  name="operating_system" id="operating_system" value="<?php echo $operating_system;?>"  placeholder="enter operating system">
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-unchecked red"></i>&nbsp; Display</span>
                        <input type="text" class="form-control"  name="display_size" id="display_size" value="<?php echo $display_size;?>"  placeholder="enter display size">
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-cog red"></i> Processor</span>
                        <input type="text" class="form-control"  name="processor" id="processor" value="<?php echo $processor;?>"  placeholder="enter processor">
                    </div>
					</div>
    
                    </div>
                    <div class="clearfix"></div><br>
					
                
                
                 <div class="row">    
                  
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-camera red"></i>&nbsp; Front Camera</span>
                    <select name="front_camera" id="front_camera" class="form-control">
                        
                    <option value="<?php echo $front_camera;?>"><?php echo $front_camera;?></option>
                    <?php
                    for($i=5;$i<=15;$i++)
                    {
                    ?>   
                    <option value="<?php echo $i;?> Mega Pixels"><?php echo $i;?> Mega Pixels</option>
                    <?php    
                    }    
                    ?>    
                    </select>    
                        
                        
                             
                             </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-camera red"></i>&nbsp; Back Camera</span>
                     
                         <select name="back_camera" id="back_camera" class="form-control">
                        
                    <option value="<?php echo $back_camera;?>"><?php echo $back_camera;?></option>
                    <?php
                    for($i=5;$i<=15;$i++)
                    {
                    ?>   
                    <option value="<?php echo $i;?> Mega Pixels"><?php echo $i;?> Mega Pixels</option>
                    <?php    
                    }    
                    ?>
                     </select>    
                     
                     
                          
                          </div>
					</div>
                     <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-question-sign red"></i>&nbsp; SIM  Type</span>
                        
                        <select class="form-control center" id="sim_type" name="sim_type" >
                        <option value="<?php echo $sim_type;?>"><?php echo $sim_type;?></option>   
                        <option value="Signle SIM">Signle SIM</option>   
                        <option value="Duel SIM">Duel SIM</option>    
                        </select>    
                          
                          </div>
					</div>
                    </div>
                    <div class="clearfix"></div><br>
					
                
                  <div class="row">    
                      <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card red"></i>&nbsp; RAM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="text" class="form-control" id="ram"  name="ram"  value="<?php echo $internal_memory;?>" placeholder="enter the RAM">
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card red"></i>&nbsp; ROM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="text" id="rom" class="form-control"  name="rom"  value="<?php echo $external_memory;?>" placeholder="enter the ROM">
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-trash red"></i>&nbsp; Battery&nbsp;&nbsp;&nbsp;</span>
                        <input type="text" class="form-control" id="battery"  name="battery" value="<?php echo $battery;?>"  placeholder="enter the battery capacity">
                    </div>
					</div>
    
                    </div>
                    <div class="clearfix"></div><br>
					
                    
                     <div class="row">    
                      <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd red"></i>&nbsp; Discount</span>
                        <input type="number" class="form-control"  name="discount" id="discount"  value="<?php echo $product_discount;?>" placeholder="enter the discount value">
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar red"></i>&nbsp;Start Date:</span>
                        <input type="date" class="form-control"  name="start_date" id="start_date" value="<?php echo $start_date;?>" >
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar red"></i>&nbsp;End Date:</span>
                        <input type="date" class="form-control"  name="close_date" id="close_date" value="<?php echo $close_date;?>" >
                    </div>
					</div>
    
                    </div>
                    <div class="clearfix"></div><br>
					
                    
                    <div class="row">
                     <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-question-sign red"></i>&nbsp; Is Featured</span>
                        
                        <select class="form-control center" id="is_featured" name="is_featured" >
                        <option value="<?php echo $featured;?>"><?php echo $featured;?></option>
                         <option value="Yes">Yes</option> 
                         <option value="No">No</option>     
                             
                        </select>
                        
                    </div>
					</div>
				   
                   
                      <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-stats red"></i>&nbsp; Status&nbsp;&nbsp;&nbsp;</span>
                        <input type="text" class="form-control" id="status"  name="status" value="<?php echo $status;?> " disabled >
                    </div>
					</div>    
                        
                        
                    <div class="col-md-4 ">
                    <div class="input-group input-group-md">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-picture red"></i>&nbsp; Image(s)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>    
                    <input type="file" class="form-control" name="images[]" id="images[]" multiple/>
                    </div>    
					</div>
                   
                    </div>
                     <div class="clearfix"></div><br>
                   
                    
            
                          <div class="col-md-6 center"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Description</span>
                        
                        <textarea name="description" id="description" class="form-control center" rows="3" placeholder="enter description of the product"><?php echo $description;?></textarea>
                
                        </div>
					</div>
              <div class="clearfix"></div><br>
            
            
            
            
                 <p class="center col-md-3">
                        <input type="button" value="Update Product" name="btn-add-product" class="btn btn-primary" onclick="updateProduct()">
                    </p>
                
                  <div class="clearfix"></div><br>    
    <div id="msg"></div>             
                

                    
                   
               
      
        </div>
        <!--/span-->
           </div>
          
               
        
        
        
        </div>
            </div>
        </div><!--/row-->
        <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->



<?php
    include_once("require/footer.php");
?>


</div><!--/.fluid-container-->


<!-- external javascript -->

      <?php
include_once("require/libs_footer.php");
?>

<!-- external javascript -->


</body>
</html>

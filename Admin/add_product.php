<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- Add Product</title>

  <?php
include_once("require/libs_header.php");
?>
  
</head>

<body>
   
    <?php
include_once("require/header.php");
$session  = new Session();
$session->isAdmin();
$database = new Database();     
$dal_SubCategory = new SubCategoryDAL($database->hostname, $database->username, $database->password, $database->database);  
    ?>
    
    
<div class="ch-container">
    <div class="row">
        
      
    <?php
include_once("require/nav_bar.php");
?>
             <noscript>
     
            <div class="col-md-offset-2 col-md-5">
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
            <a href="#">Add Product</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-pencil"></i> Add Product</h2>

                <div class="box-icon">
                   
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                  
                </div>
            </div>
        
            
           <div class="box-content">
                
        
        <div class=" col-md-12 center login-box">
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
            
        
            
           
            <form method="POST" action="add_product_action.php" enctype="multipart/form-data">
               
                    <div class="row"> 
                 
                       <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt red"></i>&nbsp; Sub Category</span>
                        
                        <select class="form-control center" name="sub_category_id" >
                        <option>select sub category</option>    
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
                        <input type="text" class="form-control" name="product_name"  placeholder="enter product name">
						
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd red"></i>&nbsp; Price</span>
                        <input type="text" class="form-control" name="price"  placeholder="enter product price">
						
                    </div>
					</div>
                        
               
                    </div>
                    <div class="clearfix"></div><br>
					
			         		
					<div class="row">
                        
                       
                          
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-shopping-cart red"></i>&nbsp; Stock</span>
                        <input type="text" class="form-control"  name="stock"  placeholder="enter product stock">
                    </div>
					</div>
                            
                        
                        
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd red"></i>&nbsp; Shipping</span>
                         <input type="text" class="form-control" name="free_shipping_price"  placeholder="enter free shipping amount">
                        
                    </div>
					</div>    
                   
                    
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-sound-5-1 red"></i>&nbsp; Weight</span>
                        <input type="text" class="form-control"  name="weight"  placeholder="enter the weight">
                       
                    </div>
					</div>
                            
                    </div>
					<div class="clearfix"></div><br>
					
                
      
                    <div class="row">    
                      <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-question-sign red"></i>&nbsp; OS Type</span>
                        <input type="text" class="form-control"  name="operating_system"  placeholder="enter operating system">
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-unchecked red"></i>&nbsp; Display</span>
                        <input type="text" class="form-control"  name="display_size"  placeholder="enter display size">
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-cog red"></i> Processor</span>
                        <input type="text" class="form-control"  name="processor"  placeholder="enter processor">
                    </div>
					</div>
    
                    </div>
                    <div class="clearfix"></div><br>
					
                
                
                 <div class="row">    
                  
                         <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-camera red"></i>&nbsp; Front Camera</span>
                    <select name="front_camera" class="form-control">
                        
                    <option value="">select specification</option>
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
                     
                         <select name="back_camera" class="form-control">
                        
                    <option value="">select specification</option>
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
                        
                        <select class="form-control center" name="sim_type" >
                        <option value="">select sim type</option>   
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
                        <input type="text" class="form-control"  name="ram"  placeholder="enter the RAM">
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card red"></i>&nbsp; ROM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="text" class="form-control"  name="rom"  placeholder="enter the ROM">
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-trash red"></i>&nbsp; Battery&nbsp;&nbsp;&nbsp;</span>
                        <input type="text" class="form-control"  name="battery"  placeholder="enter the battery capacity">
                    </div>
					</div>
    
                    </div>
                    <div class="clearfix"></div><br>
					
                    
                     <div class="row">    
                      <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd red"></i>&nbsp; Discount</span>
                        <input type="number" class="form-control"  name="discount"  placeholder="enter the discount value">
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar red"></i>&nbsp;Start Date</span>
                        <input type="date" class="form-control"  name="start_date" >
                    </div>
					</div>
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar red"></i>&nbsp;End Date</span>
                        <input type="date" class="form-control"  name="close_date" >
                    </div>
					</div>
    
                    </div>
                    <div class="clearfix"></div><br>
					
                    
                    
                    
                    <div class="row">
                   
                     <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-question-sign red"></i>&nbsp; Is Featured</span>
                        
                        <select class="form-control center" name="is_featured" >
                        <option>select feature</option>
                         <option value="Yes">Yes</option> 
                         <option value="No">No</option>     
                             
                        </select>
                        
                    </div>
					</div>
				   
                   
                    <div class="col-md-4 ">
                    <div class="input-group input-group-md">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-picture red"></i>&nbsp; Image(s)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>    
                    <input type="file" class="form-control" name="images[]" id="images" multiple/>
                        
                    </div>    
					</div>
                   
                        
                    
                    </div>
                     <div class="clearfix"></div><br>
                   
                    
                    
                    	<div class="row">
                        
                       
                          
                    <div class="col-md-6 center"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon">Description</span>
                        
                        <textarea name="description "  class="form-control center" rows="3" placeholder="enter description of the product"></textarea>
                
                        </div>
					</div>
                            
                        
                        
                            
                    </div>
					<div class="clearfix"></div><br>
					
                    
                
                    <p class="center col-md-3">
                        <input type="submit" value="Add Product" name="btn-add-product" class="btn btn-primary">
                    </p>
               
           </form>
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

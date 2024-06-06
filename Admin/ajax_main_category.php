<?php
	

    require_once("../library/session.php");
	require_once("../library/database.php");
	require_once("../data_access_layer/dal_category.php");


$session  = new Session();
$session->isAdmin();
$database = new Database();
$dal_Category = new CategoryDAL($database->hostname, $database->username, $database->password, $database->database);  


//Enable Main Category
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==1) {
      
    $dal_Category->setMainCategoryId($_REQUEST['categoryid']);
    $dal_Category->setStatus(1);
    $result = $dal_Category->enableMainCategory();

if ($result){
echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success </u> </strong> , Main Category has been enabled successfully!...
                </div>';    
    
?>
    
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" "serverSide": true>
                
    <thead>
    <tr>
    
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">Category Title</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
    
$result= $dal_Category->getMainCategories();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['category_id']?></td>
        <td style="text-align:center;"><?php echo $row['category_title']?></td>
        <td style="text-align:center;">
            
            <?php if($row['status']==0){
            ?>
            <span class="label-warning label label-default"><?php echo "Disabled"; ?></span>
           <?php
            } 
            else{ 
            ?>    
             <span class="label-success label label-default"><?php echo "Enabled"; ?></span>    
            <?php  
            }                                                                    
            ?>
        </td>
      
        
        <td >
            <a class="btn btn-info" href="view_main_category.php?id=<?php echo $row['category_id'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <?php
            if($row['status']==0){
            ?>
            
              
                 <input  type="button" class="btn btn-success" name="<?php echo $row['category_id']?>" value="Enable" onclick="enableMainCategory(<?php echo $row['category_id']?>)">
             
                    <input  type="button" class="btn btn-danger" name="<?php echo $row['category_id']?>" value="Disable" onclick="DisableMainCategory(<?php echo $row['category_id']?>)" disabled>
        
            
            <?php
            }
                                        
             
             elseif($row['status']==1){
            ?>
              <input  type="button" class="btn btn-success" name="<?php echo $row['category_id']?>" value="Enable" onclick="enableMainCategory(<?php echo $row['category_id']?>)" disabled>
             
            
                    <input  type="button" class="btn btn-danger" name="<?php echo $row['category_id']?>" value="Disable" onclick="DisableMainCategory(<?php echo $row['category_id']?>)" >    
            <?php
            }                                                                                            
            ?>      
        </td>
 </tr>
        
<?php        
}           
}
else{
    
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Sorry, </strong>Records Not Found!...
                </div>';   
}        
          
?>
        
        </tbody>
    </table>     
<?php  
}else{
	echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                   <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed</u> </strong> , Account has not been enabled successfully!...
                </div>';
?>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" "serverSide": true>
                
    <thead>
    <tr>
    
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">Category Title</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
    
$result= $dal_Category->getMainCategories();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['category_id']?></td>
        <td style="text-align:center;"><?php echo $row['category_title']?></td>
        <td style="text-align:center;">
            
            <?php if($row['status']==0){
            ?>
            <span class="label-warning label label-default"><?php echo "Disabled"; ?></span>
           <?php
            } 
            else{ 
            ?>    
             <span class="label-success label label-default"><?php echo "Enabled"; ?></span>    
            <?php  
            }                                                                    
            ?>
        </td>
      
        
        <td >
            <a class="btn btn-info" href="view_main_category.php?id=<?php echo $row['category_id'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <?php
            if($row['status']==0){
            ?>
            
              
                 <input  type="button" class="btn btn-success" name="<?php echo $row['category_id']?>" value="Enable" onclick="enableMainCategory(<?php echo $row['category_id']?>)">
             
                    <input  type="button" class="btn btn-danger" name="<?php echo $row['category_id']?>" value="Disable" onclick="DisableMainCategory(<?php echo $row['category_id']?>)" disabled>
        
            
            <?php
            }
                                        
             
             elseif($row['status']==1){
            ?>
              <input  type="button" class="btn btn-success" name="<?php echo $row['category_id']?>" value="Enable" onclick="enableMainCategory(<?php echo $row['category_id']?>)" disabled>
             
            
                    <input  type="button" class="btn btn-danger" name="<?php echo $row['category_id']?>" value="Disable" onclick="DisableMainCategory(<?php echo $row['category_id']?>)" >    
            <?php
            }                                                                                            
            ?>      
        </td>
 </tr>
        
<?php        
}           
}
else{
    
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Sorry, </strong>Records Not Found!...
                </div>';   
}        
          
?>
        
        </tbody>
    </table>  

<?php

}
    
}



//Disable Main Category
if (isset($_REQUEST['flag']) && $_REQUEST['flag']==2) {
      
    $dal_Category->setMainCategoryId($_REQUEST['categoryid']);
    $dal_Category->setStatus(0);
    $result = $dal_Category->enableMainCategory();

if ($result){
echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success </u> </strong> , Main Category has been disabled successfully!...
                </div>';    
    
?>
    
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
                
    <thead>
    <tr>
    
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">Category Title</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
    
$result= $dal_Category->getMainCategories();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['category_id']?></td>
        <td style="text-align:center;"><?php echo $row['category_title']?></td>
        <td style="text-align:center;">
            
            <?php if($row['status']==0){
            ?>
            <span class="label-warning label label-default"><?php echo "Disabled"; ?></span>
           <?php
            } 
            else{ 
            ?>    
             <span class="label-success label label-default"><?php echo "Enabled"; ?></span>    
            <?php  
            }                                                                    
            ?>
        </td>
      
        
        <td >
            <a class="btn btn-info" href="view_main_category.php?id=<?php echo $row['category_id'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <?php
            if($row['status']==0){
            ?>
            
              
                 <input  type="button" class="btn btn-success" name="<?php echo $row['category_id']?>" value="Enable" onclick="enableMainCategory(<?php echo $row['category_id']?>)">
             
                    <input  type="button" class="btn btn-danger" name="<?php echo $row['category_id']?>" value="Disable" onclick="DisableMainCategory(<?php echo $row['category_id']?>)" disabled>
        
            
            <?php
            }
                                        
             
             elseif($row['status']==1){
            ?>
              <input  type="button" class="btn btn-success" name="<?php echo $row['category_id']?>" value="Enable" onclick="enableMainCategory(<?php echo $row['category_id']?>)" disabled>
             
            
                    <input  type="button" class="btn btn-danger" name="<?php echo $row['category_id']?>" value="Disable" onclick="DisableMainCategory(<?php echo $row['category_id']?>)" >    
            <?php
            }                                                                                            
            ?>      
        </td>
 </tr>
        
<?php        
}           
}
else{
    
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Sorry, </strong>Records Not Found!...
                </div>';   
}        
          
?>
        
        </tbody>
    </table>     
<?php  
}else{
	echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                   <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed</u> </strong> , Account has not been disabled successfully!...
                </div>';
?>
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
                
    <thead>
    <tr>
    
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">Category Title</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
    
$result= $dal_Category->getMainCategories();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['category_id']?></td>
        <td style="text-align:center;"><?php echo $row['category_title']?></td>
        <td style="text-align:center;">
            
            <?php if($row['status']==0){
            ?>
            <span class="label-warning label label-default"><?php echo "Disabled"; ?></span>
           <?php
            } 
            else{ 
            ?>    
             <span class="label-success label label-default"><?php echo "Enabled"; ?></span>    
            <?php  
            }                                                                    
            ?>
        </td>
      
        
        <td >
            <a class="btn btn-info" href="view_main_category.php?id=<?php echo $row['category_id'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <?php
            if($row['status']==0){
            ?>
            
              
                 <input  type="button" class="btn btn-success" name="<?php echo $row['category_id']?>" value="Enable" onclick="enableMainCategory(<?php echo $row['category_id']?>)">
             
                    <input  type="button" class="btn btn-danger" name="<?php echo $row['category_id']?>" value="Disable" onclick="DisableMainCategory(<?php echo $row['category_id']?>)" disabled>
        
            
            <?php
            }
                                        
             
             elseif($row['status']==1){
            ?>
              <input  type="button" class="btn btn-success" name="<?php echo $row['category_id']?>" value="Enable" onclick="enableMainCategory(<?php echo $row['category_id']?>)" disabled>
             
            
                    <input  type="button" class="btn btn-danger" name="<?php echo $row['category_id']?>" value="Disable" onclick="DisableMainCategory(<?php echo $row['category_id']?>)" >    
            <?php
            }                                                                                            
            ?>      
        </td>
 </tr>
        
<?php        
}           
}
else{
    
echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Sorry, </strong>Records Not Found!...
                </div>';   
}        
          
?>
        
        </tbody>
    </table>     

<?php
}
    
}




?>
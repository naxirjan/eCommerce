<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- View Main Categories</title>

  <?php
include_once("require/libs_header.php");
?>
  

    <script>
    
    function enableMainCategory(id){
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("cat_result").innerHTML= ajax.responseText;        
window.location="view_main_category.php";
}
}
ajax.open("GET","ajax_main_category.php?flag=1&categoryid="+id);
ajax.send();    
}

        
function disableMainCategory(id){
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("cat_result").innerHTML= ajax.responseText;
window.location="view_main_category.php";
}
}
ajax.open("GET","ajax_main_category.php?flag=2&categoryid="+id);
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
$dal_Category = new CategoryDAL($database->hostname, $database->username, $database->password, $database->database);  
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
            <a href="#">View Main Categories</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
       
        <div class="box-inner">
            
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-eye-open"></i> View Main Categories</h2>

            </div>
            
    <div class="center">        
     <?php   
        if(isset($_REQUEST['message'])){
        if($_REQUEST['message']=="empty"){
        echo '<div class="alert alert-warning center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-info-sign"></i>
                    <strong><u>Alert</u></strong> , Main Category name should not be empty!...
                </div>';   
        }
        elseif($_REQUEST['message']=="success"){
    	echo '<div class="alert alert-success" center>
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success </u> </strong> , Main Category has been updated successfully!...
                </div>';    
        }    
        elseif($_REQUEST['message']=="fail"){
        echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Fail </u> </strong> ,Main Category has not been updated successfully!...
                </div>';      
            
        }     
        }
        ?>
                   
    <?php
    if(isset($_REQUEST['id'])){
       
       $dal_Category->setMainCategoryId($_REQUEST['id']);
          $result= $dal_Category->getMainCategoryById();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
$category_title= $row['category_title'];
$id=$row['category_id'];
}}
                ?>    
                     
    <div class="row">
    <div class="well col-md-6 center login-box">
            
            
            <form  action="update_main_category_action.php" method="POST">
                <fieldset>
                    <div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt red"></i></span>
                        <input type="text" class="form-control" id="main_category" name="main_category" placeholder="enter category name here" value="<?php if(isset($category_title)){
    echo $category_title;
} ?>">
      <input type="hidden" name="id"  value="<?php if(isset($id)){
    echo $id;
} ?>">                  
                        
                    </div>
                    <div class="clearfix"></div>


                    <p class="center col-md-5">
                        <input type="submit" class="btn btn-primary" value="Update" name="btn-update-main-category"/>
                        
                    </p>
                    
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->    
    <?php
        
    }
    ?>        
</div>            
            
       <div class="box-content col-md-8 center" id="cat_result">
                       
<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="mytable">
                
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
      
        
        <td style="text-align:center;">
            <a class="btn btn-info btn-sm" href="view_main_category.php?id=<?php echo $row['category_id'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <?php
            if($row['status']==0){
            ?>
            
              
                 <input  type="button" class="btn btn-success btn-sm" name="<?php echo $row['category_id']?>" value="Enable" onclick="enableMainCategory(<?php echo $row['category_id']?>)">
             
                    <input  type="button" class="btn btn-danger btn-sm" name="<?php echo $row['category_id']?>" value="Disable" onclick="disableMainCategory(<?php echo $row['category_id']?>)" disabled>
        
            
            <?php
            }
                                        
             
             elseif($row['status']==1){
            ?>
              <input  type="button" class="btn btn-success btn-sm" name="<?php echo $row['category_id']?>" value="Enable" onclick="enableMainCategory(<?php echo $row['category_id']?>)" disabled>
             
            
                    <input  type="button" class="btn btn-danger btn-sm" name="<?php echo $row['category_id']?>" value="Disable" onclick="disableMainCategory(<?php echo $row['category_id']?>)" >    
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

            
            </div>
            
    
    
            
        </div>
        </div>
            
        </div><!--/row-->
       
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

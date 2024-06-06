<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Users</title>
        <?php
            include_once("require/libs_header.php");
        ?>
    
    
<script>
function ActiveUser(id){
var email = document.getElementById("email"+id).value;
var password = document.getElementById("password"+id).value;    
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("active_result").innerHTML= ajax.responseText;
//window.location="view_users.php";
}
}

ajax.open("GET","ajax_user.php?flag=11&userid="+id+"&email="+email+"&password="+password);
ajax.send();    
}
         
function DectiveUser(id){
    
var email = document.getElementById("email"+id).value;
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("active_result").innerHTML= ajax.responseText;
//window.location="view_users.php";
}
}

ajax.open("GET","ajax_user.php?flag=22&userid="+id+"&email="+email);
ajax.send();
    
}
    </script>     
    
    
    
    
    
</head>
<body>
    <?php
        include_once("require/header.php");
    
    $session = new Session();
    $session->isAdmin();
    $database = new Database();
	$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);
    
    
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
                    <a href="#">View Users</a>
                </li>
        </ul>
        </div>
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-eye-open"></i> View Users</h2>
                        <div class="box-icon">
                           
                                 <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>
                    </div>
                
                
    <div class="box-content" id="active_result">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr >
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Gender</th>
        <th style="text-align:center;">Email Address</th>
        <th style="text-align:center;">Registration Date</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
    </tr>
    </thead>
    <tbody>
        
    <?php
    $dal_user->setStatus(0);    
$result= $dal_user->getAllUsers();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"><?php echo $row['gender']?></td>
        <td style="text-align:center;"><?php echo $row['email']?></td>
       <td style="text-align:center;"><?php echo $row['date_time']?></td>
       
        <td style="text-align:center;">
            <?php if($row['role_id']==1){
            ?>
            <span class="label-primary label label-default"><?php echo "Admin"; ?></span>
           <?php
            } 
            else{ echo "User"; }                                        
                                        
            ?>

        </td>
        <td style="text-align:center;">
            <?php
          if($row['status']==1){
            ?>    
            <span class="label-success label label-default"><?php echo "Active";?></span>
            <?php    
            }  
                                        
                                         
            elseif($row['status']==2){
            ?>    
            <span class="label-danger label label-default"><?php echo "Deactive";?></span>
            <?php    
            }                                 
            ?>
        </td>   
        <td style="text-align:center;">
            <a class="btn btn-info btn-sm" href="update_user.php?id=<?php echo $row['user_id'];?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <?php
            if($row['status']==1){
            ?>
            
              
                 <input  type="button" class="btn btn-success btn-sm" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" disabled>
             
            
                   <input  type="button" class="btn btn-danger btn-sm" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" >
                
            
            <?php
            }
                                        
             
             elseif($row['status']==2){
            ?>
            
           
                 <input  type="button" class="btn btn-success btn-sm" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" >
             
           
            
                   <input  type="button" class="btn btn-danger btn-sm" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
           
        
            <?php
            }                            
                                        
            
              elseif($row['status']==3){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)">
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
           
            
                  
            <?php
            }                             
              
                                        
                 elseif($row['status']==4){
            ?>
            
           
                 <input  type="button" class="btn btn-success" name="<?php echo $row['user_id']?>" value="Active" onclick="ActiveUser(<?php echo $row['user_id']?>)" disabled>
             
           
            
                   <input  type="button" class="btn btn-danger" name="<?php echo $row['user_id']?>" value="Deactive" onclick="DectiveUser(<?php echo $row['user_id']?>)" disabled>
                   
            <?php
            }                            
                                        
                                        
            ?>      
        </td>
        <input type="hidden" id="email<?php echo $row['user_id']?>" value="<?php echo $row['email']?>">
         <input type="hidden" id="password<?php echo $row['user_id']?>" value="<?php echo $row['password']?>">
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

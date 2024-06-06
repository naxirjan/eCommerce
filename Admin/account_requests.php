<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- Account Requests</title>

  <?php
include_once("require/libs_header.php");
?>
  
    
<script>
    


function ApproveUser(id){
var email= document.getElementById("email"+id).value;
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("result").innerHTML= ajax.responseText;
}
}

ajax.open("GET","ajax_user.php?flag=3&userid="+id+"&email="+email);
ajax.send();
}
    
function DisapproveUser(id){
    
var email= document.getElementById("email"+id).value;
var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("result").innerHTML= ajax.responseText;
}
}

ajax.open("GET","ajax_user.php?flag=4&userid="+id+"&email="+email);
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
            <a href="#">User Account Requests</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Account Requests</h2>

                <div class="box-icon">
                   
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                   
                </div>
            </div>
          
            
            
                          
    <div class="box-content" id="result">
        
              
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">First Name</th>
        <th style="text-align:center;">Last Name</th>
        <th style="text-align:center;">Cell</th>
        <th style="text-align:center;">Gender</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;">Password</th>
         <th style="text-align:center;">Date</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Action</th>
        
    </tr>
    </thead>
    <tbody>
        
    <?php
    $dal_user->setStatus(0);    
$result= $dal_user->getAllAccountRequests();    
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){
?>    
    <tr>
        <td style="text-align:center;"><?php echo $row['user_id']?></td>
        <td style="text-align:center;"><?php echo $row['first_name']?></td>
        <td style="text-align:center;"><?php echo $row['last_name']?></td>
        <td style="text-align:center;"> <?php echo $row['cell']?></td>
        <td style="text-align:center;"><?php echo $row['gender']?></td>
        <td style="text-align:center;"><?php echo $row['email']?></td>
        <td style="text-align:center;"><?php echo $row['password']?></td>
         <td style="text-align:center;"><?php echo $row['date_time']?></td>
        <td style="text-align:center;">
            <?php if($row['role_id']==1){            
            ?>
            <span class="label-primary label label-default"><?php echo "Admin"; ?></span>
           <?php
            } 
            else{ echo "User"; }                                                                     
            ?>
        <td style="text-align:center;">
            <?php
            if($row['status']==0){
            ?>    
            <span class="label-warning label label-default"><?php echo "Pending"; ?></span>
            <?php    
            } 
                                         
            ?>
        </td>
        
        <td style="text-align:center;">
            
            <input  type="button" class="btn btn-success btn-sm" name="<?php echo $row['user_id']?>" value="Approve" onclick="ApproveUser(<?php echo $row['user_id']?>)">
      
            
           <input  type="button" class="btn btn-danger btn-sm" name="<?php echo $row['user_id']?>" value="Dispprove" onclick="DisapproveUser(<?php echo $row['user_id']?>)">
        
        </td>
        <input type="hidden" id="email<?php echo $row['user_id'];?>" value="<?php echo $row['email']?>" />
        </tr>
        
        
<?php        
}           
}
else{
echo '<div class="alert alert-info center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Alert , </strong>No new account requests were found!...
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

<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- Update User</title>

  <?php
include_once("require/libs_header.php");
?>
  
    
    <script type="text/javascript">
   
   
   
        
function UpdateUserAccount(){

var id = document.getElementById("id").value;    
var first_name = document.getElementById("first_name").value;
var last_name = document.getElementById("last_name").value;
var cell = document.getElementById("cell").value;
var gender ='';

if(document.getElementById('gender1').checked) {
  gender = document.getElementById('gender1').value
}else if(document.getElementById('gender2').checked) {
  gender = document.getElementById('gender2').value
}
    
    
    
var address = document.getElementById("address").value;
var email = document.getElementById("email").value;
var password = document.getElementById("password").value;
var role = document.getElementById("role").value;
var status = document.getElementById("status").value;

    
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
 
ajax.open("GET","ajax_user.php?flag=2&id="+id+"&firstname="+first_name+"&lastname="+last_name+"&cell="+cell+"&gender="+gender+"&address="+address+"&email="+email+"&password="+password+"&role="+role+"&status="+status);
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
            <a href="#">Update User</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-glyphicon glyphicon-edit"></i> Update User Account</h2>

                <div class="box-icon">
                  
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
 
      
                
    <?php
    if(isset($_REQUEST['id'])) {            
    $user_id = $_REQUEST['id']; 
    $dal_user->setId($user_id);        
    $result= $dal_user->getUserById(); 

                
       
if($result->num_rows)        {
while($row=mysqli_fetch_assoc($result)){

$id=$row['user_id'];
$first_name=$row['first_name'];
$last_name=$row['last_name'];
$cell=$row['cell'];
$gender=$row['gender'];
$address=$row['address'];
$email=$row['email'];
$password=$row['password'];
$role=$row['role_id']; 
$status=$row['status'];    
}
}
    }
                
else{
  echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed</u> </strong> , Record Not Found Due To Invlid Input / Action!...
                </div>';   
    
    
}                
                
?>             
              
                
                
        
        <div class="well col-md-12 center login-box">
        
             <div id="msg"> </div> 
            
                <fieldset>
				<legend>Update User Account</legend>
                    
					<div class="row"> 
                    
                    <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i> ID: </span>
                        <input type="text" class="form-control" value="<?php if(isset($id)){ echo $id;}?>" id="id" name="id" required placeholder="enter id" disabled>
                    </div>
					</div>
                    
                        
                    <div class="col-md-4">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i> First Name: </span>
                        <input type="text" class="form-control" value="<?php if(isset($first_name)){ echo $first_name;}?>" id="first_name" name="first_name" required placeholder="enter first name">
                    </div>
					</div>
                     
                        
					<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i> Last Name: </span>
                        <input type="text" class="form-control" value="<?php if(isset($last_name)) { echo $last_name;}?>" id="last_name" name="last_name" required placeholder="enter last name">
						
                    </div>
					</div>
                        
                        
                    </div>
                    <div class="clearfix"></div><br>
					
			         		
					<div class="row">
                        
                    	<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone red"></i> Cell No: </span>
                        <input type="text" class="form-control" value="<?php if(isset($cell)) { echo $cell;}?>" id="cell" name="cell" required placeholder="enter cell no">
                    </div>
					</div>    
                        
                        
					<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope red"></i> Email: </span>
                        <input type="email" class="form-control" value="<?php if(isset($email)) { echo $email;}?>" id="email" name="email" required placeholder="enter email">
                    </div>
					</div>
					
					<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i> Password:</span>
                        <input type="text" class="form-control" value="<?php if(isset($password)) { echo $password;}?>" id="password" name="password" required placeholder="enter password">
				  </div>
					</div>
					</div>
					<div class="clearfix"></div><br>
					
                
		
                    
					     		
					<div class="row "> 
                   
                 
                        <div class="col-md-4 ">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker red"></i> Address: </span>
                        <textarea rows="1" cols="50" class="form-control"  id="address" name="address" required placeholder="enter your complete address"><?php if(isset($address)) { echo $address;}?></textarea>
                        </div>
					</div>    
                        
                        
                        
					
                    
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-stats red"></i> Status: </span>
                        <input type="text" id="status" name="status" class="form-control" value="<?php 
                        if(isset($status)) {
                        if($status==0){
                        echo "Pending";    
                        }elseif($status==1){
                        echo "Active";    
                        }elseif($status==2){
                        echo "Deactive";    
                        }elseif($status==3){
                        echo "Approved";    
                        }elseif($status==4){
                        echo "Disapproved";    
                        }
                            
                            
                        }                                              
                        ?>"  disabled >
				  </div>
					</div>    
                    
                        
                    
                    
                    <div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-question-sign red"></i> Role: </span>
                       <select class="form-control" name="role" id="role" class="label label-success label-default">
                           
                    <?php
                    if(isset($role)) {              
                    if($role==1){       
                    ?>
                    <option value="1">Admin</option>        
                    <option value="2">User</option>                 
                    <?php
                    }
                    elseif($role==2){
                    ?>
                    <option value="2">User</option> 
                    <option value="1">Admin</option>         
                    <?php       
                    }         
                    }
                    ?>       
                           
                    </select>
				  </div>
					</div>    
                        
                        
                        
                        
                        
                    </div>
					<div class="clearfix"></div><br>
					
                
                    		<div class="row"> 
                       <div class="col-md-3 center">
                       <div class="input-group input-group-md">
                    <label>Gender:</label> &nbsp;  
                  
                    <?php
                           
                    if(isset($gender)) {       
                      if($gender=="Male"){                          
                    ?>      
                    <span>
                        <input type="radio" name="gender" id="gender1" value="Male" checked="true">
                        Male 
                    </span>&nbsp;               
                    <span>
                        <input type="radio" name="gender" id="gender2" value="Female" >
                         Female
                    </span> 
                     <?php
                      }elseif($gender=="Female"){
                      ?>      
                    <span>
                        <input type="radio" name="gender" id="gender1" value="Male" >
                        Male 
                    </span>&nbsp;               
                    <span>
                        <input type="radio" name="gender" id="gender2" value="Female" checked="true">
                         Female
                    </span>            
                    <?php      
                      }}
                     ?>   
                          
                    </div>    
					</div>                            
                    </div>
                    <div class="clearfix"></div>
					
   

                    <p class="center col-md-3"><br>
                        <input type="button" value="Update Account" name="btn-crupdateeate" class="btn btn-primary" onclick="UpdateUserAccount()">
                    </p>
                    
                   
                </fieldset>
           
        </div>
        <!--/span-->
        
         
                </div>
            </div>
        </div><!--/row-->
        <!-- content ends -->
 
            
           
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

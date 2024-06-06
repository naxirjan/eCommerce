<!DOCTYPE html>
<html lang="en">
<head>
   
    
    
    
    
    
    <title>-Online Purchasing-Chat</title>
 
<?php
   
require_once("require/libs_header.php");        
?>
    
    
    
    <style>
    
        #scroll{
              max-height: 400px;
    overflow-y: scroll;
        }
    
    </style>
    
    
<script>
function viewChatBox(id){
var userid = document.getElementById("userid"+id).value;
var username = document.getElementById("username"+id).value;    
    

var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("chat_result").innerHTML= ajax.responseText;

}
}

ajax.open("GET","ajax_chat.php?flag=1&id="+userid+"&username="+username);
ajax.send();    
}

    
    
function sendMessage(){
var to_id = document.getElementById("to_id").value;
var message = document.getElementById("message").value;
    

var ajax;

if (window.XMLHttpRequest){
ajax = new XMLHttpRequest();
}else{
ajax = new ActiveXObject("Microsoft.XMLHTTP");
}

ajax.onreadystatechange= function(){
if (ajax.readyState==4 && ajax.status==200){
document.getElementById("message_result").innerHTML= ajax.responseText;
var message = document.getElementById("message").value="";
}
}

ajax.open("GET","ajax_chat.php?flag=2&to_id="+to_id+"&message="+message);
ajax.send();    
}
    
    </script>    
    
    
    
  </head>

<body>
<?php
require_once("require/headerbar.php");
     $session = new Session();
    $session->isUser();
    $database = new Database();
	$dal_user = new UserDAL($database->hostname, $database->username, $database->password, $database->database);
    $dal_chat = new ChatDAL($database->hostname, $database->username, $database->password, $database->database);
   
?> 
  
<div class="ch-container" id="got-to-top">
    <div class="row">
        
       <noscript>
     
            <div class="col-md-offset-3 col-md-5">
            <input type="button" value="Javascript Is Disabled Or Your Browser Does Not Support Javascript" class="btn btn-danger btn-lg ">    
</div>
        </noscript>

          
<div id="content" class="col-md-12">  
<?php
require_once("require/navbar.php"); 
require_once("require/slider.php"); 
//require_once("require/newsbar.php");
?> 
        </div>    
        
   
    
      
        
        
    </div><!--/#content.col-md-0-->
  
    
    
      
       <div class="box-content">
 
    <div class="box col-md-12">
<div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Admin Chat</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                     </div>
            </div>

      <div class="box-content" id="scroll">
                    <ul class="dashboard-list">
                    <?php
                    $row="";    
                    $dal_user->setStatus(1);    
                 $result=$dal_user->getAllAccountRequests();       
                if($result->num_rows){
                    
                    while($row=mysqli_fetch_assoc($result)){
                        
                    if($row['role_id']==1){
                    ?>    
                    <li>
                        <?php
                        if($row['gender']=="Male"){
                        ?>
                        <img class="dashboard-avatar"  src="images/male.png" >
                       <?php
                        }
                        elseif($row['gender']=="Female"){
                        ?>
                        <img class="dashboard-avatar" src="images/female.png">
                       <?php
                        }
                        ?>
                        <strong>Name: </strong><span><?php echo $row['first_name']." ".$row['last_name'];?></span><br>
                        <strong>Cell: </strong><?php echo $row['cell'];?><br>
                        <strong>Gender: </strong><?php echo $row['gender'];?>
                        <input type="button" class="btn btn-sm btn-success"  value="Click To Chat" onclick="viewChatBox(<?php echo $row['user_id'];?>)">
                        
                        <input type="hidden" id="userid<?php echo $row['user_id'];?>" value="<?php echo $row['user_id'];?>" />
                         <input type="hidden" id="username<?php echo $row['user_id'];?>" value="<?php echo $row['first_name']." ".$row['last_name'];?>" />
                        
                        </li>
                            
                        
                    <?php    
                    }    
                    }
                }        
                    ?>    
                        
                        
                        
                        
                        
                                           </ul>
                </div>
            
        </div>
    </div>     
        
        
<div class="col-md-6" id="message_result"></div>
        
<div id="chat_result">
 
        
        
        
        
</div>
        
        
        
        
        
            </div>
     
      
    </div><!--/#content.col-md-0-->
               
			

    
   

    
    
    
<?php
require_once("require/footer.php");        
?>  

</div><!--/.fluid-container-->

    
<!-- external javascript -->  
<?php
require_once("require/libs_footer.php");        
?> 
<!-- external javascript -->


</body>
</html>

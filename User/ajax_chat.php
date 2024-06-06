<?php
require_once("../library/session.php");
require_once("../library/database.php");
require_once("../data_access_layer/dal_chat.php");

?>



<?php
$database = new Database();     
$dal_chat = new ChatDAL($database->hostname, $database->username, $database->password, $database->database);
    
if(isset($_REQUEST['flag']) && $_REQUEST['flag']==1 ){
?>    
    


 <div class="box col-md-6" >
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-envelope red"></i> Inbox</h2>
 </div>

                <div class="box-content" id="scrollbar" >
     <?php
 
            $dal_chat->setFromId($_SESSION['user']['user_id']);
            $dal_chat->setToId($_REQUEST['id']);
            $result_msg=$dal_chat->getMessages();
 if($result_msg->num_rows){
 ?>
 <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th style="text-align:center"><h4 class="btn btn-sm btn-round btn-primary">MESSAGES</h4></th>
    </tr>
    </thead>
    <tbody>
    <?php    
    while($row=mysqli_fetch_assoc($result_msg)){
    ?>    
    <tr>
        <td><?php
        
        if($row['from_id']==$_SESSION['user']['user_id']){
      ?> <label  class="label label-success"><?php   echo $_SESSION['user']['first_name'];?></label> : 
        <label  class="label label-info"><?php   echo $row['message'];?></label>
        <?php    
            }
        else{
          ?>  
            <label  class="label label-warning"><?php  echo $_REQUEST['username'];?></label> : 
            <label  class="label label-info"><?php  echo $row['message'];?></label>    
         <?php  
        }
        ?></td>   
    </tr>
   
        
<?php 
}
 }
 ?>
     
     </tbody>
    </table>
    
                    
                    
                    
                    <h3>To:</h3>
                        <div class="input-group col-md-4">
                   
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                    <input type="button" class="form-control btn btn-primary"  value="<?php echo $_REQUEST['username'];?>">
                    <input type="hidden" id="to_id"  value="<?php echo $_REQUEST['id'];?>">        
                
                            
                </div> 
                    
                    <br >
                    <h3>Message:</h3>
                        <div class="input-group col-md-12">
                   
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                    <input type="text" class="form-control" id="message" placeholder="Enter Your Message" required>
                </div>
                    
                    <br>
                    
                     <div class="input-group col-md-4 col-md-offset-4">
                   
                    
                    <input type="button" class="form-control btn btn-success"  value="Send Message" onclick="sendMessage()">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-circle-arrow-right green" ></i></span>     
                </div> 
                    
                    
                    
                
    
            
      
    </div>     
     </div>
</div>

<?php    
}





if(isset($_REQUEST['flag']) && $_REQUEST['flag']==2 )
{

    if(isset($_REQUEST['message']) && $_REQUEST['message']!=""){
    
    
    
    
    $dal_chat->setFromId($_SESSION['user']['user_id']);
    $dal_chat->setToId($_REQUEST['to_id']);
    $dal_chat->setMessage($_REQUEST['message']);
    $dal_chat->setDate(date('Y-m-d'));    
   $result=$dal_chat->sendMessage();
    
    
    if($result){
    echo '<div class="alert alert-success center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Success, </u> </strong>    , Message Has Been Sent Successfully!...
                </div>';     
        
        
    }
    else{
        echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Fail, </u> </strong>    , Message Has Not Been Sent Successfully!...
                </div>';     
        
    }

}
elseif(!isset($_REQUEST['message'])){
 
     echo '<div class="alert alert-danger center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Fail, </u> </strong>    , Please Insert Your Message!...
                </div>';   
}



}

?>



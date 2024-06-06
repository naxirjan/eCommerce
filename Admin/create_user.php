<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- Create User Account</title>

  <?php
include_once("require/libs_header.php");
?>
</head>

<body>
   
    <?php
include_once("require/header.php");?>
    
    
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
            <a href="#">Create User Account</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-pencil"></i> Create User Account</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                   
                </div>
            </div>
            <div class="box-content">
                
        
        <div class="well col-md-12 center login-box">
    <?php
      if(isset($_REQUEST['success'])){
?>        
<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Account has been created and email sent successfully!...</div>   
  <?php
            }
          
if(isset($_REQUEST['message'])){
?>
<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                   <i class="glyphicon glyphicon-glyphicon gl cenetryphicon-remove-sign"></i><strong> Failed, Validation Problems  </strong><ul style=""><?php echo $_REQUEST['message'] ;?></ul> 
                </div> 
<?php    
}            
?>
            
        
            
           
            <form method="POST" action="create_user_action.php">
                <fieldset>
				<legend>User Account Requirements</legend>
                    
					<div class="row"> 
                    <div class="col-md-6">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" id="first_name" name="first_name"  placeholder="enter first name">
                    </div>
					</div>
					<div class="col-md-6"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="enter last name">
						
                    </div>
					</div>
                    </div>
                    <div class="clearfix"></div><br>
					
			         		
					<div class="row">
                        
                    	<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone red"></i></span>
                        <input type="text" class="form-control" id="cell" name="cell"  placeholder="enter cell no">
                    </div>
					</div>    
                        
                        
					<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope red"></i></span>
                        <input type="email" class="form-control" id="email" name="email"  placeholder="enter email">
                    </div>
					</div>
					
					<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" id="password" name="password"  placeholder="enter password">
				  </div>
					</div>
					</div>
					<div class="clearfix"></div><br>
					
                
		
					     		
					<div class="row "> 
                    <div class="col-md-4 center">
                    <div class="input-group input-group-md">
                    <label>Gender:</label> &nbsp;  
                   <span>
                        <input type="radio" name="gender" id="gender" value="Male">
                        Male 
                    </span>&nbsp;
                        
                    <span>
                        <input type="radio" name="gender" id="gender" value="Female" >
                         Female
                    </span> 
                        </div>    
					</div>
					</div>
					<div class="clearfix"></div><br>
					
                
                    		<div class="row"> 
                    <div class="col-md-12">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker red"></i></span>
                        <textarea rows="4" cols="50" class="form-control" id="address" name="address"  placeholder="enter your complete permanent address"></textarea>
                        </div>
					</div>
                    </div>
                    <div class="clearfix"></div><br>
					
   

                    <p class="center col-md-5"><br>
                        <input type="submit" value="Create Account" name="btn-create-user" class="btn btn-primary">
                    </p>
                    
                   
                </fieldset>
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

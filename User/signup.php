<!DOCTYPE html>
<html lang="en">
<head>
   
    
    
    
    
    
    <title>-Online Purchasing-Checkout</title>
 
<?php
   
require_once("require/libs_header.php");        
?> 
  </head>

<body>
<?php
require_once("require/headerbar.php");        
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
			 <div class="row">
        <div class="col-md-12 center ">
            <hr />
            <h2 class="animated rubberBand"><img src="images/user.png" width="30" height="30"> Account Registration</h2><br />
        </div>
        <!--/span-->
    </div><!--/row-->
                
                
                
                
      <div class="row">
        <div class="well col-md-6 center login-box">
            <?php
      if(isset($_REQUEST['success'])){
?>        
<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success, </u> </strong> Account has been created successfully!...</div>   
  <?php
            }
          
if(isset($_REQUEST['fail'])){
?>
<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                   <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Failed, </u> </strong> Account has not been created successfully!...
                </div> 
<?php    
}            
?>    
            
            <div class="alert alert-info">
                Please enter your log information correctly.
            </div>
              
             <form action="signup_process.php" method="POST"  enctype="multipart/form-data">            
 
            
                <fieldset>
				<legend>User Account Requirements</legend>
                    
					<div class="row"> 
                    <div class="col-md-6">			
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" name="first_name"  placeholder="enter first name">
                    </div>
					</div>
					<div class="col-md-6"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" name="last_name"  placeholder="enter last name">
						
                    </div>
					</div>
                    </div>
                    <div class="clearfix"></div><br>
					
			         		
					<div class="row">
                        
                    	<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone red"></i></span>
                        <input type="number" class="form-control" name="cell"  placeholder="enter cell no">
                    </div>
					</div>    
                        
                        
					<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope red"></i></span>
                        <input type="email" class="form-control" name="email"  placeholder="enter email">
                    </div>
					</div>
					
					<div class="col-md-4"> 
					<div class="input-group input-group-md">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" name="password"  placeholder="enter password">
				  </div>
					</div>
					</div>
					<div class="clearfix"></div><br>
					
                
		
					     		
					<div class="row"> 
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
                        <textarea rows="4" cols="50" class="form-control" name="address"  placeholder="enter your complete permanent address"></textarea>
                        </div>
					</div>
                    </div>
                    <div class="clearfix"></div><br>
					
   

                    <p class="center col-md-5"><br>
                        <input type="submit" value="Create Account" name="btn-signup" class="btn btn-primary">
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
               
			
      

			   
			
            </div>
    
   

    
    
    
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

<!DOCTYPE html>
<html lang="en">
<head>
   
    
    
    
    
    
    <title>N-Online Purchasing-Checkout</title>

    
   
    
<?php    
require_once("require/libs_header.php");
?> 

    
</head>

<body>
<?php
require_once("require/headerbar.php");        
require_once("require/small_cart.php");     

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
  
    
    
      
      
<div class="ch-container">
    <div class="row">
         <hr />
        <div class="col-md-10 center login-header">
           
            <h2>Welcome to N-Online Purchasing</h2>
        </div>
        
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                
            <img src="images/signin_header.png" width="450" height="100"/>
                <br />
                Please login with your email and Password.
            </div>
            <form  action="signin_action.php" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope red"></i></span>
                        <input type="text" class="form-control" placeholder="enter your email" id="email"  name="email">
                    </div>
                    <p class="label label-danger pull-right"  id="email_message"></p>

                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" placeholder="enetr your password" id="password" name="password" />
                          </div>
                     <p class="label label-danger pull-right"  id="pass_message"></p>
                    
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                    <input type="submit" class="btn btn-primary" value="Signin" name="btn-sign-in"/>    
                    </p>
					
				    <p class="center col-md-5">
                        <a href="signup.php"  class="btn btn-primary" >Signup</a>    
                    </p>
					
                    
                     <?php if(isset($_REQUEST['message'])){
                   ?>
                    <ul id="listerror">
                    <button class="btn btn-danger btn-xs"><?php echo $_REQUEST['message']; ?></button>
                     </ul>    
                    <?php
                    }
                    ?>
                   	
					
                </fieldset>
            </form>
                  
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->


    
    
    
    
    
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

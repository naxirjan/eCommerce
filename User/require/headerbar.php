<?php







require_once("../library/session.php");
require_once("../library/database.php");
require_once("../data_access_layer/dal_user.php");
require_once("../data_access_layer/dal_sub_category.php");
require_once("../data_access_layer/dal_product.php");
require_once("../data_access_layer/dal_cart.php");
require_once("../data_access_layer/dal_cart_product.php");
require_once("../data_access_layer/dal_order.php");
require_once("../data_access_layer/dal_chat.php");
$session  = new Session();
 
    ?>


<!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation" id="top">

        <div class="navbar-inner">
           
            
        <ul class="collapse navbar-collapse nav navbar-nav top-menu">
            
        <li><a href="index.php"> <img title="click to go to homepage" data-placement="bottom" data-toggle="tooltip" alt="E-Commerce Logo" src="img/logoicon.png" width="170" height="45" class="hidden-xs"/></a>
           </li>  
            <li><span class="navbar-brand" >N-Online Purchasing </span> </li>       
			
             <li><a title="call us for helpline" data-placement="bottom" data-toggle="tooltip"><i class="glyphicon glyphicon-earphone "></i> Call us: +92 313 3006640</a></li>
			 <li><a title="send us email for helpline" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-envelope"></i> Email: nazir.ahmed13626@gmail.com</a></li>
            
            </ul>
     
      
         
            
            
    <?php
    
            if(! $session->isSessionUserId()){
            ?>
            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> Your Account</span>
                    <span class="caret"></span>
                </button>
                
                <ul class="dropdown-menu">
                    <li><a href="signin.php"><i class="glyphicon glyphicon-lock btn-setting"></i>&nbsp;&nbsp;Signin</a></li>
                    <li class="divider"></li>
                    <li><a href="signup.php"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Signup</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->
        <?php  
            }
            else{
                ?>
                
            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> Welcome,  <?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name'];?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    
                    <li><a href="update_profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;My Profile</a></li>
                    <li class="divider"></li>
                    
                    <li><a href="my_orders.php"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;&nbsp;My Orders</a></li>
                    <li class="divider"></li>
                    
                    
                    <li><a href="view_review_rating.php"><i class="glyphicon glyphicon-star"></i>&nbsp;&nbsp;My Reviews </a></li>
                    <li class="divider"></li>
                    
                    
                    <li><a href="chat.php"><i class="glyphicon glyphicon-comment"></i>&nbsp;&nbsp;Chat </a></li>
                    <li class="divider"></li>
                    
                   
                    
                     <li class="divider"></li>
                    
                     <li><a href="user_signout.php"><i class="glyphicon glyphicon-lock"></i>&nbsp;&nbsp;Signout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->
             
            
            
            
            
                
            <?php    
            }
            ?>
            
            
            
            <!-- theme selector starts -->
            <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
                    <i class="glyphicon glyphicon-tint"></i><span
                        class="hidden-sm hidden-xs"> Change Theme / Skin</span>
                    <span class="caret"></span>
                </button>
                        <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
                </ul>
        
               
            </div>
            <!-- theme selector ends -->
            
        
            
            
            
            
            
        </div>
    </div>
    <!-- topbar ends -->



      
     
            







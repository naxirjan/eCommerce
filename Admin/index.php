<!DOCTYPE html>
<html lang="en">
<head>

    <title>N-Online Purchasing- Login</title>


<?php
include_once("require/libs_header.php");
?>


</head>

<body>
<div class="ch-container">
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Welcome To N-Online Purchasing</h2>
        </div>
       <noscript>
     
            <div class="col-md-offset-3 col-md-5">
            <input type="button" value="Javascript Is Disabled Or Your Browser Does Not Support Javascript" class="btn btn-danger btn-lg ">    
</div>
        </noscript>
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                
            <img src="img/admin_login.png" width="500" height="100" /> <br />    
                Please login with your Username and Password.
            </div>
            <form class="form-horizontal" action="signin_process.php" method="POST">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" name="email" placeholder="enter the email">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="enter the password">
                    </div>
                    <div class="clearfix"></div>


                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </p><ul id="listerror">
                     <?php if(isset($_REQUEST['message'])){
                   ?>
                    <button class="btn btn-danger btn-xs"><?php echo $_REQUEST['message']; ?></button>
                    <?php
                    }
                    ?>
                    </ul>
                    
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->

</div><!--/.fluid-container-->



    
    
    
    
<!-- external javascript -->
<?php
include_once("require/libs_footer.php");
?>
<!-- external javascript -->


</body>
</html>

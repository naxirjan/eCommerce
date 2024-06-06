



<?php
    require_once("../library/session.php");
	require_once("../library/database.php");
    require_once("../data_access_layer/dal_user.php");
    require_once("../data_access_layer/dal_category.php");
    require_once("../data_access_layer/dal_sub_category.php");

    require_once("../data_access_layer/dal_product.php");            
require_once("../data_access_layer/dal_cart.php");
require_once("../data_access_layer/dal_cart_product.php");
require_once("../data_access_layer/dal_order.php");
require_once("../data_access_layer/dal_chat.php");
require_once("require/excelwriter.inc.php");


    $session = new Session();
    $session->isAdmin();
?>


<!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation" id="top">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.php">N-Online Purchasing</a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> Welcome, <?php echo $_SESSION['admin']['first_name']." ".$_SESSION['admin']['last_name'];?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="view_profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="signout.php"><i class="glyphicon glyphicon-lock"></i>&nbsp;Signout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
			<li> <a class="navbar-brand" href="dashboard.php"><img alt="E-Commerce Logo" src="img/mainlogo.png"  class="hidden-xs"/></a></li>
			<li><a href="../User/"><i class="glyphicon glyphicon-globe"></i> Visit The Website</a></li>
			 </ul>

        </div>
    </div>
    <!-- topbar ends -->
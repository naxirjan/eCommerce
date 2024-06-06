<!DOCTYPE html>
<html lang="en">
<head>
  


    <title>N-Online Purchasing- Add Main Categories</title>

  <?php
include_once("require/libs_header.php");
?>
  
</head>

<body>
   
    <?php
include_once("require/header.php");
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
            <a href="#">Add Main Category</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-pencil"></i> Add Main Category</h2>

                <div class="box-icon">
                   
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                   
                </div>
            </div>
            <div class="box-content center"> 
                
              <?php if(isset($_REQUEST['message'])){
    
                    if($_REQUEST['message']=="empty"){    
    
                echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Error </u> </strong> , Please enter the name of main category!...
                </div>';
                    }
                elseif($_REQUEST['message']=="success"){    
    
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-ok-sign"></i><strong><u> Success </u> </strong> , Main Category has been added successfully!...
                </div>';
                    }
    
                
                elseif($_REQUEST['message']=="fail"){    
    
                echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="glyphicon glyphicon-glyphicon glyphicon-remove-sign"></i><strong><u> Error, </u> </strong>    , Main Category has not been added successfully!...
                </div>';
                    }
    
}
                ?>      
                
            
    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
               Enter The Name Of Main Category Here !...
            </div>
            <form class="form-horizontal" action="add_main_category_action.php" method="POST">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt red"></i>&nbsp;Enter Name</span>
                        <input type="text" class="form-control" id="main_category" name="main_category" placeholder="enter category name here">
                    </div>
                    <div class="clearfix"></div><br>


                    <p class="center col-md-5">
                        <input type="submit" class="btn btn-primary" value="Add" name="btn-add-main-category"/>
                    </p>
                    
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
    
                
               
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

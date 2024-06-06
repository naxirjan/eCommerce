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
require_once("require/newsbar.php");
?> 
        </div>    
        
         <div class="box col-sm-3">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-picture"></i> Pictures</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content  ">
                
                
                
             <ul class="thumbnails gallery"> 
                <?php
                    $images = array("nokia1.jpg","nokia2.jpg","nokia3.jpg","nokia4.jpg","nokia5.jpg");    
                    for($i=0;$i<=4;$i++){
                    ?>    
                   <p>
                        <li id="image-1" class="thumbnail">
                        <a style="background:url(images/<?php echo $images[$i]; ?>)"
                        title="Sample Image <?php echo $i+1; ?>" href="images/<?php echo $images[$i]; ?>"><img
                        class="grayscale" src="images/<?php echo $images[$i]; ?>"
                        alt="Sample Image <?php echo $i+1; ?>"></a> 
                        </li>
                 </p>
                 
             
<?php    
}?>     
                             
</ul>  
       
            
            
            </div>

            </div>
        </div>
   
        
        <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-phone"></i> Smartphone</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="dashboard-list">
                <h3>Nokia</h3>
                <li><span><img src="images/nokia2.jpg" alt="" width="300" height="300"></span></li>
                    <li><h4>Price: Rs:12000</h4></li>
                    <li><span>Reviews (10): </span><img src="images/rating.png" width="100" height="17"/></li>    
                <li>Details: Here is the device Description. Here is the device Description. Here is the device Description. Here is the device Description. Here is the device Description. Here is the device Description. Here is the device Description. Here is the device Description. Here is the device Description. </li>    
    
                    <!--<li>
                <input type="hidden" class="rating" value="3"/>
                    </li>-->
                <li> <button class="btn btn-primary" title="click to add in your cart" data-placement="right" data-toggle="tooltip">Add To Cart</button></li>
                </ul>
          
            </div>

            </div>
        </div>
   
        
         <div class="box col-md-5">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-info-sign"></i> More About The Device</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                
                </div>
            </div>
            <div class="box-content">
              
            <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#info">Key Features</a></li>
                    <li><a href="#custom">Reviews</a></li>
                    <li><a href="#messages">Return Policy</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="info">
                        <p><b>Ram:</b> 2GB</p>
                        <p><b>Cam Front:</b> 5Mp</p>
                        <p><b>Cam Back:</b> 8Mp</p>
                        <p><b>Color:</b> Silver</p>
                        <p><b>Processor:</b> 1.5 Ghz</p>
                        <p><b>External Storage:</b> 16Gb upto 32Gb Supported</p>
                        <p><b>Internal Storage:</b> 8Gb</p>
                    </div>
                    <div class="tab-pane" id="custom">
                       <ul class="dashboard-list">
                        <?php
                           
                           
                           for($i=0;$i<=5;$i++){
                           ?>
                           <li>
                               
                               <span class="label label-default"><strong>Name: </strong></span>&nbsp;
                               <span class="label-success label label-default"> Nazir Ahmed</span><br>
                               
                               <span class="label label-default"><strong>Since: </strong></span>&nbsp;
                               <span class="label-primary label label-default">  <?php echo date("d-m-Y");?></span><br>
                           
                                <span class="label label-default"><strong>Rating: </strong></span>&nbsp;
                               <span class="label-primary label label-default"> <span class="raty" ></span> </span> 
                             <br>
                               
                               <span class="label label-default"><strong>Review: </strong></span>&nbsp;<span class="label-info label label-default"> This is nice device forever</span>
                        </li>
                        
                           <?php  
                           }
                           ?>
                    </ul>
                        
                       
                  
                          <div class="box-content">
                        
                    <h2>Your Rating Please!...</h2>    
               
                    <div class="form-group">
                        
                        <h4>Rating: </h4><div class="raty" ></div>  
                              </div>
                   
                    

            </div>
                        
                        
                        
                        <div class="box-content">
                        
                    <h2>Enter Your Review</h2>    
                <form role="form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Review</label>
                        <input type="email" class="form-control" id="userreview" placeholder="Enter your review">
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
            
                        
                        
                    </div>
                    <div class="tab-pane" id="messages">
                        <h3><span class="label-primary label label-default">7 Days Replacement Only</span></h3>
<span>                            
If your product is defective / damaged or incorrect / incomplete at the time of delivery, then call <i class="glyphicon glyphicon-earphone "></i> our customer service on +92 313 3006640 to log a replacement request within 7 days of delivery. 
<br /><br />    
For device-related issues after usage please contact the service center listed on the warranty card included with your product or alternatively check our Brand Contact List for more details.
<br /><br />
                            
This product is not eligible for a replacement if the product is "no longer needed". <br>
"No longer needed" means that you no longer have a use for the product / you have changed your mind about the purchase / the size of a fashion product does not fit / you do not like the product after opening the package.
  </span>                          

                        <h3><span class="label-primary label label-default">Conditions for Returns</span></h3>                            
<span>The product must be unused, unworn, unwashed and without any flaws.
The return will not be processed if the freebies (Mobile network voucher, Voucher, Accessories or any other bundled product) is used or tempered.
The product must include the original tags, user manual, warranty cards, freebies and accessories.<br /><br />
The product must be returned in the original and undamaged manufacturer packaging / box. 
If the product was delivered in a second layer of Daraz packaging, it must be returned in the same condition with return shipping label attached. 
<br /><br />Do not put tape or stickers on the manufacturer box.
Before returning a mobile / tablet, the device should be formatted and screen lock should be disabled. The iCloud account should be unlocked for Apple devices.
If a product is returned to us in an inadequate condition, we reserve the right to send it back to you.
</span>                                                   
                        
                    
                        
                    </div>
                </div>    
          
            </div>

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

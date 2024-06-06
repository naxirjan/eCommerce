<?php
require_once("../data_access_layer/dal_category.php");
require_once("../library/database.php");
$database = new Database();
$dal_Category = new CategoryDAL($database->hostname, $database->username, $database->password, $database->database);
$dal_Sub_Category = new SubCategoryDAL($database->hostname, $database->username, $database->password, $database->database);

?>  




<div class="col-sm-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="index.php"  title="click to go to homepage" data-placement="right" data-toggle="tooltip"><i class="glyphicon glyphicon-home"></i><span> Home</span></a>
                        </li>
                      

                        <?php
                        
$dal_Category->setStatus(1);                            
$result= $dal_Category->getMainCategoryByStatus();                        
if($result->num_rows){
while($row=mysqli_fetch_assoc($result)){ 
    
?>
                             
         
                            <li class="accordion">
                              
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> <?php echo $row['category_title'];?></span>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-phone"></i></a>
                            <ul class="nav nav-pills nav-stacked">
                            <?php
                            $dal_Sub_Category->setMainCategoryId($row['category_id']);                            
                            $result2= $dal_Sub_Category->getSubCategoryByMainCategoryId();                          
                           if($result2->num_rows){
                           while($row2=mysqli_fetch_assoc($result2)){    
                           $tot =count($row2);
                                ?>            
                                
                <li><a href="search_products_by_subcategory.php?id=<?php echo $row2['sub_category_id'];?>"  title="click to view the <?php echo $row2['sub_category'];?>" data-placement="bottom" data-toggle="tooltip"> <?php echo $row2['sub_category'];?></a></li>
                  <?php
                           }
                           }
                            ?>   
                                
                            </ul>
                        </li>                    
                                          
                        <?php
                                       }}
                        ?>
                     
                    </ul>
                   
                </div>
            </div>
        </div> 

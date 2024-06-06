<?php
class ProductBLL

{
    
    
    
    
    
protected $product_id; 
protected $user_id;       
protected $sub_category_id;        
protected $extra_info_id;        
protected $image_id;
protected $product;
protected $description;    
protected $price;
protected $stock;
protected $ship_amount;
protected $weight;
protected $is_featured;       
protected $operating_system;    
protected $display_size;   
protected $processor;   
protected $ram;
protected $rom;
protected $battery;
protected $discount;
protected $start_date;
protected $close_date;
protected $is_featued;
protected $sim_type;
protected $front_camera;
protected $back_camera;        
protected $image;
protected $status;        
        
        


        
public function setProductId($product_id){
$this->product_id=$product_id;    
}
public function getProductId(){
 return $this->product_id;    
}    
        
 
public function setUserId($user_id){
$this->user_id=$user_id;    
}
public function getUserId(){
 return $this->user_id;    
}    
 


public function setSubCategoryId($sub_category_id){
$this->sub_category_id=$sub_category_id;    
}
public function getSubCategoryId(){
 return $this->sub_category_id;    
}         
      
        

public function setExtraInfoId($extra_info_id){
$this->extra_info_id=$extra_info_id;    
}
public function getExtraInfoId(){
 return $this->extra_info_id;    
}        
 
    
public function setProduct($product){
$this->product=$product;    
}
public function getProduct(){
 return $this->product;    
}        
  	
    
public function setDescription($description){
$this->description=$description;    
}
public function getDescription(){
 return $this->description;    
}        
    
    
    
    
    
public function setPrice($price){
$this->price=$price;    
}               
public function getPrice(){
 return $this->price;    
}     
        
public function setStock($stock){
$this->stock=$stock;    
}               
public function getStock(){
 return $this->stock;    
}     
        
public function setShipAmount($ship_amount){
$this->ship_amount=$ship_amount;    
}                
public function getShipAmount(){
 return $this->ship_amount;    
}     

public function setWeight($weight){
$this->weight=$weight;    
}                
public function getWeight(){
 return $this->weight;    
} 
    
    
public function setIsFeatured($is_featured){
$this->is_featured=$is_featured;    
}                
public function getIsFeatured(){
 return $this->is_featured;    
}     

public function setOperatingSystem($operating_system){
$this->operating_system=$operating_system;    
}               
public function getOperatingSystem(){
 return $this->operating_system;    
}     

public function setDisplaySize($display_size){
$this->display_size=$display_size;    
}                
public function getDisplaySize(){
 return $this->display_size;    
}     

        
        
public function setProcessor($processor){
$this->processor=$processor;    
}                
public function getProcessor(){
 return $this->processor;    
}
    
    
public function setRam($ram){
$this->ram=$ram;    
}                
public function getRam(){
 return $this->ram;    
}     

public function setRom($rom){
$this->rom=$rom;    
}                
public function getRom(){
 return $this->rom;    
}     

public function setBattery($battery){
$this->battery=$battery;    
}               
public function getBattery(){
 return $this->battery;    
}     

public function setDiscount($discount){
$this->discount=$discount;    
}              
public function getDiscount(){
 return $this->discount;    
}     

public function setStartDate($start_date){
$this->start_date=$start_date;    
}
public function getStartDate(){
 return $this->start_date;    
}     

public function setCloseDate($close_date){
    $this->close_date=$close_date;
    
}
    public function getCloseDate(){        
    return $this->close_date ;   
    }
    

public function setIsFeatued($is_featued){
$this->is_featued=$is_featued;    
}           
public function getIsFeatued(){
 return $this->is_featued;    
}     

public function setSimType($sim_type){
$this->sim_type=$sim_type;    
}              
public function getSimType(){
 return $this->sim_type;    
}     

public function setCamera($camera){
$this->camera=$camera;    
}               
public function getCamera(){
 return $this->camera;    
}     


        
public function setFrontCamera($front_camera){
$this->front_camera=$front_camera;    
}        
public function getFrontCamera(){
 return $this->front_camera;    
}        
        
      
public function setBackCamera($back_camera){
$this->back_camera=$back_camera;    
}        
public function getBackCamera(){
 return $this->back_camera;    
}        
          
                

public function setImageId($image_id){
$this->image_id=$image_id;    
}        
public function getImageID(){
 return $this->image_id;    
}     
    
    
public function setImage($image){
$this->image=$image;    
}        
public function getImage(){
 return $this->image;    
}     

public function setStatus($status){
$this->status=$status;    
}        
public function getStatus(){
 return $this->status;    
}     

        
}
?>
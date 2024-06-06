<?php

	require_once("../business_logic_layer/bll_product.php");

	Class ProductDAL extends ProductBLL{

		private $connection;

		public function __construct($hostname, $username, $password, $database){
			$this->connection = mysqli_connect($hostname, $username, $password, $database);

			if(mysqli_connect_errno())
			{
				echo "Database Connection Problem ".mysqli_connect_error()."<br />";
			}
		}

		public function addProduct() {

			$query = "INSERT INTO product (sub_category_id, product, description,featured, free_shipping, price, stock) VALUES('".$this->getSubCategoryId()."','".$this->getProduct()."','".$this->getDescription()."' ,'".$this->getIsFeatured()."', '".$this->getShipAmount()."','".$this->getPrice()."' ,'".$this->getStock()."')";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
            $product_id=mysqli_insert_id($this->connection);

            $query2 = "INSERT INTO product_extra_info(product_id, weight, operating_system, display_size, internal_memory, external_memory, processor, front_camera, back_camera, battery,sim_type) VALUES(".$product_id.", ".$this->getWeight().", '".$this->getOperatingSystem()."','".$this->getDisplaySize()."' ,'".$this->getRam()."','".$this->getRom()."','".$this->getProcessor()."','".$this->getFrontCamera()."','".$this->getBackCamera()."','".$this->getBattery()."','".$this->getSimType()."')";


		      $result2 = mysqli_query($this->connection, $query2) or die(mysqli_error($this->connection));


            $query3="INSERT INTO product_discount (product_id,start_date, close_date, product_discount) VALUES (".$product_id.",'".$this->getStartDate()."','".$this->getCloseDate()."' ,'".$this->getDiscount()."')";


            $result3 = mysqli_query($this->connection, $query3) or die(mysqli_error($this->connection));

			if($result && $result2 && $result3)
			{
				return $product_id;
			}
			else
			{
				return false;
			}
		}

        public function addImage(){
       $query = "INSERT INTO product_image(product_id,image) VALUES(".$this->getProductId().",'".$this->getImage()."')";
        $result = mysqli_query($this->connection,
        $query) or die(mysqli_error($this->connection));
        if($result)
			{
				return true;
			}
			else
			{
				return false;
			}



        }



        public function getAllProducts(){
			$query = "SELECT  product.product_id,category.category_title,sub_category.sub_category,product.product,product.description, product.featured, product.free_shipping, product.price,
product.stock, product.status
FROM product,category,sub_category
WHERE category.category_id=sub_category.category_id AND product.sub_category_id=sub_category.sub_category_id";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}

        public function getAllFeaturedProducts(){
			$query = "SELECT  product.product_id,category.category_title,product.product,product.description, product.featured, product.price,product.stock,
            product.status,category.status,sub_category.status
FROM product,category,sub_category, product_discount
WHERE product.status='Enabled' AND category.status=1
AND sub_category.status='Active' AND product.featured='Yes' AND category.category_id=sub_category.category_id
AND product.sub_category_id=sub_category.sub_category_id
AND product_discount.product_id=product.product_id
AND product_discount.product_discount=0";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}

        public function getAllProductsBySearch(){
      $query = "SELECT  product.product_id,category.category_title,product.product,product.description, product.featured, product.price,product.stock,
            product.status,category.status,sub_category.status,product_discount.*
FROM product,category,sub_category, product_discount
WHERE product.status='Enabled' AND category.status=1
AND sub_category.status='Active' AND category.category_id=sub_category.category_id
AND product.sub_category_id=sub_category.sub_category_id
AND product.product_id =product_discount.product_id
AND sub_category.sub_category_id=".$this->getSubCategoryId()." ";
      $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
      return $result;
    }

        public function getAllRelatedProducts(){
    $query = "SELECT  product.product_id,product.stock,category.category_title,product.product,product.description, product.featured, product.price,
            product.status,category.status,sub_category.status,product_discount.product_discount,product_discount.start_date
FROM product,category,sub_category,product_discount
WHERE product.status='Enabled' AND category.status=1 AND sub_category.status='Active' AND category.category_id=sub_category.category_id AND product.sub_category_id=sub_category.sub_category_id
AND product.product_id=product_discount.product_id
AND sub_category.sub_category_id=".$this->getSubCategoryId()." ";


             $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
      return $result;



    }

        public function getProductDiscount($start_date){
			$query = "SELECT product_discount.* FROM product_discount,product 
            WHERE product_discount.product_id=product.product_id AND product.product_id=".$this->getProductId()." AND product_discount.start_date>".$start_date." ";


			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}
        
        public function getAllMostSearchedProducts(){
               $query = "SELECT  product.product_id,product.stock,category.category_title,product.product,product.description, product.featured, product.price,
            product.status,category.status,sub_category.status,search_history.total_count
FROM product,category,sub_category,search_history,USER
WHERE product.status='Enabled'
AND category.status=1
AND sub_category.status='Active'
AND category.category_id=sub_category.category_id
AND product.sub_category_id=sub_category.sub_category_id
AND sub_category.sub_category_id
AND search_history.user_id=user.user_id
AND product.product_id=search_history.product_id
AND user.user_id=10 ";
            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}

        public function getProductsBySubCategory(){

              $query = "SELECT  product.product_id,category.category_title,product.product,product.description, product.featured, product.price,product.stock,
            product.status,category.status,sub_category.status
FROM product,category,sub_category
WHERE product.status='Enabled' AND category.status=1 AND sub_category.status='Active' AND category.category_id=sub_category.category_id AND product.sub_category_id=sub_category.sub_category_id AND sub_category.sub_category_id=".$this->getSubCategoryId()." ";


             $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
      return $result;
		}

        public function getProductById(){
			$query = "SELECT product.product_id, product.stock,category.category_title,product.description ,sub_category.sub_category,sub_category.sub_category_id,  product.product, product.featured, product.free_shipping, product.price, product.stock, product.least_quantity, product.status,
       product_extra_info.product_extra_info_id, product_extra_info.product_id, product_extra_info.weight, product_extra_info.operating_system, product_extra_info.display_size,
       product_extra_info.internal_memory, product_extra_info.external_memory, product_extra_info.processor, product_extra_info.front_camera, product_extra_info.back_camera,
       product_extra_info.battery, product_extra_info.sim_type,
       product_discount.product_discount_id, product_discount.product_id, product_discount.start_date, product_discount.close_date, product_discount.product_discount
      FROM product,category,sub_category,product_extra_info,product_discount WHERE
            product.product_id=product_extra_info.product_id AND product.product_id=product_discount.product_id AND category.category_id=sub_category.category_id AND
            product.sub_category_id=sub_category.sub_category_id AND product.product_id= '".$this->getProductId()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}

        public function getProductDetailById(){
			$query = "SELECT product.product_id, category.category_title,
            sub_category.sub_category_id,
            product.description,
            product.product,
            product.stock,
            product.price,
            product.featured,
            product_extra_info.product_id, product_extra_info.weight, product_extra_info.operating_system, product_extra_info.display_size,
       product_extra_info.internal_memory, product_extra_info.external_memory,
       product_extra_info.processor,
       product_extra_info.front_camera,
       product_extra_info.back_camera,
       product_extra_info.battery,
       product_extra_info.sim_type
             FROM product,category,sub_category,product_extra_info WHERE
            product.product_id=product_extra_info.product_id AND category.category_id=sub_category.category_id AND
            product.sub_category_id=sub_category.sub_category_id AND product.product_id= '".$this->getProductId()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}
        
        public function getProductByUserSearch($tmp_text){
			$query = "SELECT p.*,c.category_title,sc.sub_category
FROM product p
INNER JOIN sub_category sc ON p.sub_category_id = sc.sub_category_id
INNER JOIN category c ON sc.category_id = c.category_id
WHERE (p.product LIKE '%$tmp_text%' OR sc.sub_category
LIKE '$tmp_text%' OR c.category_title LIKE '$tmp_text%')
AND p.status = 'Enabled' AND sc.status = 'active' AND c.status = 1 LIMIT 1,10";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}

        public function getProductImages(){

    $query = "SELECT product_image.image, product_image.product_image_id FROM product,product_image WHERE product.product_id=product_image.product_id AND product.product_id='".$this->getProductId()."'";

    $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
      }

        public function getProductOneImage(){

    $query = "SELECT product_image.image, product_image.product_image_id FROM product,product_image WHERE product.product_id=product_image.product_id AND product.product_id='".$this->getProductId()."' LIMIT 1";

    $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
      }

        public function getProductReviews(){

          $query = "SELECT user.first_name,user.last_name,review.review,review.review_date FROM user,review,product WHERE product.product_id=review.product_id AND user.user_id=review.user_id AND product.product_id=".$this->getProductId()." AND review.status='allow' ";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
          }

        public function getCommentsByStatus($status){

          $query = "SELECT COUNT(review_id) FROM review WHERE STATUS='".$status."' ";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
          }

        public function getProductReviewsByStatus(){

          $query = "SELECT user.first_name,user.last_name, product.product,review.* FROM USER,review,product WHERE product.product_id=review.product_id AND user.user_id=review.user_id ";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;



          }

        public function getProductRatingByStatus(){

          $query = "SELECT user.first_name,user.last_name, product.product,rating.* FROM USER,rating,product WHERE product.product_id=rating.product_id AND user.user_id=rating.user_id ";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;



          }

        public function getProductRatings(){

          $query = "SELECT  user.first_name,user.last_name,rating.rating,rating.rating_date FROM USER,rating,product
WHERE product.product_id=rating.product_id AND user.user_id=rating.user_id AND product.product_id=".$this->getProductId()." ";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;



          }

        public function getProductTotalRating(){
        $query = "SELECT AVG(rating) FROM rating GROUP BY product_id HAVING product_id=".$this->getProductId()." ";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
        }

        public function getUserRating(){
        $query = "SELECT rating.* FROM USER,rating,product WHERE rating.user_id=user.user_id AND rating.product_id=product.product_id AND product.product_id=".$this->getProductId()." AND user.user_id=".$this->getUserId()."  ";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
        }

        public function getUserRatingById(){
        $query = "SELECT rating.* FROM USER,rating,product WHERE rating.user_id=user.user_id AND rating.product_id=product.product_id AND product.product_id=".$this->getProductId()." AND user.user_id=".$this->getUserId()."  ";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
        }

        public function updateUserRating($rating){
        $query = "UPDATE rating SET rating=$rating WHERE product_id='".$this->getProductId()."' AND user_id='".$this->getUserId()."'  ";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
        }

        public function setAllowRejectReview($status,$review_id){

        $query = "UPDATE review SET STATUS='".$status."' WHERE review_id=".$review_id."  ";

            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
}

        public function updateProduct(){


            $query = "UPDATE product SET product='".$this->getProduct()."',description='".$this->getDescription()."', price='".$this->getPrice()."',stock='".$this->getStock()."',featured='".$this->getIsFeatured()."',free_shipping='".$this->getShipAmount()."' WHERE product_id=".$this->getProductId()." ";

            $result = mysqli_query($this->connection, $query) or
                die(mysqli_error($this->connection));

        $product_id=mysqli_insert_id($this->connection);

                    $query2 = "UPDATE product_extra_info set weight='".$this->getWeight()."', operating_system='".$this->getOperatingSystem()."', display_size='".$this->getDisplaySize()."', internal_memory='".$this->getRam()."', external_memory='".$this->getRom()."', processor='".$this->getProcessor()."', front_camera='".$this->getFrontCamera()."', back_camera='".$this->getBackCamera()."', battery='".$this->getBattery()."', sim_type='".$this->getSimType()."'
            WHERE product_id=".$this->getProductId()." ";

             $result2 = mysqli_query($this->connection, $query2) or die(mysqli_error($this->connection));

            if($result && $result2){
            return true;
            }
		  else{
        return false;
        }


        }

        public function getAllProductsIds(){
        $query = "SELECT product_id FROM product ";
        $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
        return $result;
        }

        public function countProductStock($category_id){

        $query="SELECT SUM(p.stock)
FROM category AS c
INNER JOIN sub_category AS sc ON sc.category_id = c.category_id
INNER JOIN product AS p ON p.sub_category_id = sc.sub_category_id
WHERE  c.status=1 AND sc.status='active' AND p.status='Enabled' AND c.category_id = ".$category_id." ";

        $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
        return $result;

        }

        public function getProductStockByProductId(){
        $query = "SELECT stock,product FROM product WHERE product_id=".$this->getProductId()." ";
        $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
        return $result;
        }

        public function increaseStock(){        
          $query =   "UPDATE product SET stock =(stock+".$this->getStock().")
                WHERE product_id = ".$this->getProductId();
    
               $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
              return $result;
        }

        public function decreaseStock(){        
          $query =   "UPDATE product SET stock =(stock-".$this->getStock().")
                WHERE product_id = ".$this->getProductId();
    
               $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
              return $result;
        }

        public function enable_disableProduct(){
			$query = "UPDATE product set status='".$this->getStatus()."'
            WHERE product_id='".$this->getProductId()."' ";
            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));

            return $result;

		}

        public function setRatingImages($rating){
        switch($rating){

            case 1:
            ?>
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
         <img src="img/star-off.png" alt="1" title="bad">&nbsp;
         <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <?php
            break;
         case 2:
            ?>
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
         <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <?php
            break;
         case 3:
            ?>
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
        <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <?php
            break;


         case 4:
            ?>
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
        <img src="img/star-on.png" alt="1" title="bad">&nbsp;
        <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <?php
            break;

     case 5:
            ?>
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
         <img src="img/star-on.png" alt="1" title="bad">&nbsp;
        <img src="img/star-on.png" alt="1" title="bad">&nbsp;
        <img src="img/star-on.png" alt="1" title="bad">&nbsp;
        <?php

            break;

      default:
            ?>
         <img src="img/star-off.png" alt="1" title="bad">&nbsp;
         <img src="img/star-off.png" alt="1" title="bad">&nbsp;
         <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <img src="img/star-off.png" alt="1" title="bad">&nbsp;
        <?php

            break;


        }
       }

        public function __destruct(){
			mysqli_close($this->connection);
		}




	}
?>

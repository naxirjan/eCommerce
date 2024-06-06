<?php

	require_once("../business_logic_layer/bll_user.php");

	Class UserDAL extends UserBLL{
		private $connection;

		public function __construct($hostname, $username, $password, $database){
			$this->connection = mysqli_connect($hostname, $username, $password, $database);

			if(mysqli_connect_errno())
			{
				echo "Database Connection Problem ".mysqli_connect_error()."<br />";
			}
		}

		public function createUserAccount() {
            
			$query = "INSERT INTO user (first_name, last_name, cell, gender,address,email,password,date_time) VALUES('".$this->getFirstName()."', '".$this->getLastName()."', '".$this->getPhoneNumber()."','".$this->getGender()."' ,'".$this->getAddress()."','".$this->getEmail()."', '".$this->getPassword()."','".date("d-m-Y h:m:s A")."')";

			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));

			if($result)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function signin(){
			$query = "SELECT * FROM user WHERE email='".$this->getEmail()."' AND password='".$this->getPassword()."' AND status=".$this->getStatus()." AND role_id=".$this->getUserRoleId()." ";

			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));

			return $result;
		}

        
        public function getAllUsers(){
			$query = "SELECT * FROM user WHERE NOT status=".$this->getStatus()." ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}
        
        public function getAllAccountRequests(){
			$query = "SELECT * FROM user WHERE status=".$this->getStatus()." ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}
       
        
        
        public function getUserById(){
			$query = "SELECT * FROM user WHERE user_id='".$this->getId()."' ";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}
        
        public function updateUser(){
			$query = "UPDATE user set first_name='".$this->getFirstName()."', last_name='".$this->getLastName()."',cell='".$this->getPhoneNumber()."',gender='".$this->getGender()."',address='".$this->getAddress()."',email='".$this->getEmail()."',password='".$this->getPassword()."',status='".$this->getStatus()."'
            ,role_id='".$this->getUserRoleId()."'
            WHERE user_id='".$this->getId()."' ";
            
            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}
        
        public function approveUserAccount(){
			$query = "UPDATE user set status='".$this->getStatus()."'
            WHERE user_id='".$this->getId()."' ";
            $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}
        
        
        
        public function getTotalRegisteredUsers(){
			$query = "SELECT COUNT(*) FROM user WHERE NOT status='".$this->getStatus()."'";

			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}
        public function getTotalPendingUsers(){
			$query = "SELECT COUNT(*) FROM user WHERE status='".$this->getStatus()."'";

			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}

		
        
        
   public function sendEmail($subject){

	date_default_timezone_set('Asia/Karachi');	
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "theorist97@gmail.com";
	$mail->Password = "theorist9712345";
	$mail->setFrom('theorist97@gmail.com', 'N-Online Purchasing');
	$mail->addReplyTo('theorist97@gmail.com', 'HIST');
	$mail->addAddress($this->getEmail());
	$mail->Subject =$subject;
	$mail->msgHTML("<h1>".$subject."</h1><br/>".$this->getEmailMessage());
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	}
}

        
        
        
public function getCities(){
  $query = "SELECT * FROM city";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;  
} 
        
        
        
        
public function addReview($userid,$productid,$review,$reviewdate){
  $query = "INSERT INTO review (user_id,product_id,review,review_date)VALUES('$userid','$productid','$review','$reviewdate');";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;  
}         

public function addRating($userid,$productid,$review,$reviewdate){
  $query = "INSERT INTO rating (user_id,product_id,rating,rating_date)VALUES('$userid','$productid','$review','$reviewdate');";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;  
}         
        
  
        
        
        
        
        public function __destruct()
		{
			mysqli_close($this->connection);
		}
	
    
    
    
    
    }
?>
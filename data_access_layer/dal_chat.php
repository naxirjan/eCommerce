<?php

	require_once("../business_logic_layer/bll_chat.php");
    
	Class ChatDAL extends Chat_BLL{

		private $connection;

		public function __construct($hostname, $username, $password, $database){
			$this->connection = mysqli_connect($hostname, $username, $password, $database);

			if(mysqli_connect_errno())
			{
				echo "Database Connection Problem ".mysqli_connect_error()."<br />";
			}
		}

		public function sendMessage() {
            
        $query = "INSERT INTO chat (from_id,to_id,message,sent_time) VALUES(".$this->getFromId().",".$this->getToId().",'".$this->getMessage()."','".$this->getDate()."')";
        $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
        return $result;
            
            
		}
        
        
        
        public function getMessages() {
            
        $query = "SELECT * FROM chat WHERE from_id=".$this->getFromId()." AND to_id=".$this->getToId()."  OR 
        to_id=".$this->getFromId()." AND from_id=".$this->getToId()." ORDER BY chat_id DESC
        ";
        $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
        return $result;
            
            
		}
        
    
        
        public function __destruct()
		{
			mysqli_close($this->connection);
		}
        
        
       
        
	}
?>
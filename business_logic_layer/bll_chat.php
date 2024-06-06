









<?php	
	class Chat_BLL
	{
		
        private $chatId;
        private $userId;
		private $fromId;
        private $toId;
		private $message;
        private $date;
        private $status;
		
		
        function getChatId()
		{
			return $this->chatId;
		}


		 function setChatId($chatId)
		{
			$this->chatId = $chatId;
		}


		function setUserId($userId)
		{
			$this->userId = $userId;
		}
		function getUserId()
		{
			return $this->userId ;
		}
		
        
        
        function setFromId($fromId)
		{
			$this->fromId = $fromId;
		}
		function getFromId()
		{
			return $this->fromId ;
		}
        
        
        
        function setToId($toId)
		{
			$this->toId = $toId;
		}
		function getToId()
		{
			return $this->toId ;
		}
        
        
        
        
          function setMessage($message)
		{
			$this->message = $message;
		}
		function getMessage()
		{
			return $this->message ;
		}
        
        
        
         
          function setDate($date)
		{
			$this->date = $date;
		}
		function getDate()
		{
			return $this->date;
		}
        
        
        
		function setStatus($status)
		{
			$this->status = $status;
		}

		function getStatus()
		{
			return $this->status;
		}		
	}
	
?>
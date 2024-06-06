




<?php	
	class Cart_BLL
	{
		
        private $cartId;
		private $userId;			
		private $status;
		
		function __construct( $cartId = 0, $userId = null, $status = null )
		{
			$this->userId = $userId;				
			$this->status = $status;			
		}

        function getCartId()
		{
			return $this->cartId;
		}


		 function setCartId($cartId)
		{
			$this->cartId = $cartId;
		}


		function setUserId($userId)
		{
			$this->userId = $userId;
		}
		function getUserId()
		{
			return $this->userId ;
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









<?php	
	class Order_BLL
	{
		
        private $orderId;
        private $cartId;
		private $email;
        private $paymentId;
        private $cityId;
        private $cell;
        private $orderDate;
        private $deliveryDate;
        private $shipAddress;
        private $billAddress;
        private $status;
        		
	

        function getOrderId()
		{
			return $this->orderId;
		}
		function setOrderId($orderId)
		{
			$this->orderId=$orderId ;
		}
        
        
		   function getCell()
		{
			return $this->cell;
		}
		function setCell($cell)
		{
			$this->cell=$cell ;
		}
        



		function getEmail()
		{
			return $this->email;
		}
		function setEmail($email)
		{
			$this->email=$email ;
		}

        
        function getCartId()
		{
			return $this->cartId;
		}
		function setCartId($cartId)
		{
			$this->cartId=$cartId ;
		}
        
        
        function getPaymentId()
		{
			return $this->paymentId;
		}
		function setPaymentId($paymentId)
		{
			$this->paymentId=$paymentId ;
		}
        
        
        function getCityId()
		{
			return $this->cityId;
		}
		function setCityId($cityId)
		{
			$this->cityId=$cityId;
		}
        
        
        function getOrderDate()
		{
			return $this->orderDate;
		}
		function setOrderDate($orderDate)
		{
			$this->orderDate=$orderDate ;
		}
        
        
        
        function getDeliveryDate()
		{
			return $this->deliveryDate;
		}
		function setDeliveryDate($deliveryDate)
		{
			$this->deliveryDate=$deliveryDate ;
		}
        
        
        function getShippingAddress()
		{
			return $this->shipAddress;
		}
		function setShippingAddress($shipAddress)
		{
			$this->shipAddress=$shipAddress ;
		}
        
        
        function getBillingAddress()
		{
			return $this->billAddress;
		}
		function setBillingAddress($billAddress)
		{
			$this->billAddress=$billAddress ;
		}
        
        
        function getStatus()
		{
			return $this->status;
		}
		function setStatus($status)
		{
			$this->status=$status ;
		}
        
        
        
        
        
        
        
        
	}
	
?>
<?php	
	class Cart_Product_BLL
	{

        
        
        
        
        
        
        
        private $cartId;
		private $productId;			
		private $quantity;
		
		function __construct( $cartId = null, $productId = null, $quantity = 0 )
		{
			$this->cartId = $cartId;	
			$this->productId = $productId;				
			$this->quantity = $quantity;			
		}
		function setCartId($cartId)
		{
			$this->cartId = $cartId;
		}
		function getCartId()
		{
			return $this->cartId;
		}
		
		function setProductId($productId)
		{
			$this->productId = $productId;
		}
		function getProductId()
		{
			return $this->productId;
		}
		
		function setQuantity($quantity)
		{
			$this->quantity = $quantity;
		}

		function getQuantity()
		{
			return $this->quantity;
		}		
	}
	
?>
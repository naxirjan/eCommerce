<?php
	class CategoryBLL
	{
		protected $category_id;
		protected $category;
		protected $status;
		
	
        public function setMainCategoryId($category_id)
		{
			$this->category_id = $category_id;
		}

		public function getMainCategoryId()
		{
			return $this->category_id;
		}

        
        public function setMainCategory($category)
		{
			$this->category = $category;
		}

		public function getMainCategory()
		{
			return $this->category;
		}
        
        
		public function setStatus($status)
		{
			$this->status = $status;
		}

		public function getStatus()
		{
			return $this->status;
		}

    }
?>
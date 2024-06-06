<?php
	class SubCategoryBLL
	{
		protected $sub_category_id;
        protected $main_category_id;
		protected $sub_category;
		protected $status;
		
	
        public function setSubCategoryId($sub_category_id)
		{
			$this->sub_category_id = $sub_category_id;
		}

		public function getSubCategoryId()
		{
			return $this->sub_category_id;
		}

        
        public function setMainCategoryId($main_category_id)
		{
			$this->main_category_id = $main_category_id;
		}

		public function getMainCategoryId()
		{
			return $this->main_category_id;
		}
        
        
        public function setSubCategory($sub_category)
		{
			$this->sub_category = $sub_category;
		}

		public function getSubCategory()
		{
			return $this->sub_category;
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
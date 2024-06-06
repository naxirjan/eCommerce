<?php
	class UserBLL
	{
		





        protected $id;		
		protected $first_name;
		protected $last_name;
		protected $phone_number;
		protected $gender;
		protected $adress;
		protected $email;
		protected $password;
		protected $user_role_id;
        protected $status;
        protected $email_message;
     
        

		
        public function setId($id)
		{
			$this->id = $id;
		}

		public function getId()
		{
			return $this->id;
		}

        
        public function setFirstName($first_name)
		{
			$this->first_name = $first_name;
		}

		public function getFirstName()
		{
			return $this->first_name;
		}

		public function setLastName($last_name)
		{
			$this->last_name = $last_name;
		}

		public function getLastName()
		{
			return $this->last_name;
		}


		public function setPhoneNumber($phone_number)
		{
			$this->phone_number = $phone_number;
		}

		public function getPhoneNumber()
		{
			return $this->phone_number;
		}



		public function setGender($gender)
		{
			$this->gender = $gender;
		}

		public function getGender()
		{
			return $this->gender;
		}




		public function setAddress($address)
		{
			$this->address = $address;
		}

		public function getAddress()
		{
			return $this->address;
		}



		public function setEmail($email)
		{
			$this->email = $email;
		}

		public function getEmail()
		{
			return $this->email;
		}



		public function setPassword($password)
		{
			$this->password = $password;
		}

		public function getPassword()
		{
			return $this->password;
		}



		public function setUserRoleId($user_role_id)
		{
			$this->user_role_id = $user_role_id;
		}

		public function getUserRoleId()
		{
			return $this->user_role_id;
		}


        public function setStatus($status)
		{
			$this->status = $status;
		}

		public function getStatus()
		{
			return $this->status;
		}

		
        
        
        public function setEmailMessage($email_message)
		{
			$this->email_message = $email_message;
		}

		public function getEmailMessage()
		{
			return $this->email_message;
		}
        
        
        

        
        
	}
?>
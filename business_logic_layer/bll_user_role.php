<?php
	class UserRoleBLL
	{
		protected $user_role_id;
		protected $user_role;

		public function setUserRoleId($user_role_id)
		{
			$this->user_role_id = $user_role_id;
		}

		public function getUserRoleId()
		{
			return $this->user_role_id;
		}

		public function setUserRole($user_role)
		{
			$this->user_role = $user_role;
		}

		public function getUserRole()
		{
			return $this->user_role;
		}
	}
?>
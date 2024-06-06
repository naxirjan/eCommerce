<?php
	require_once("../business_logic_layer/bll_user_role.php");

	class UserRoleDAL extends UserRoleBLL
	{
		private $connection;

		public function __construct($hostname, $username, $password, $database)
		{
			$this->connection = mysqli_connect($hostname, $username, $password, $database);

			if(mysqli_connect_errno())
			{
				echo "Database Connection Problem ".mysqli_connect_error()."<br />";
			}
		}

		public function getUserRole()
		{
			$query  = "SELECT * FROM user_role WHERE user_role_id != 1";
			$result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
			return $result;
		}

		public function __destruct()
		{
			mysqli_close($this->connection);
		}
	}
?>
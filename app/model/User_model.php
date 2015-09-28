<?php

/**
 * User Object
 *
 * @author HLO
 */
class User_model
{

	function __construct()
	{
		
	}

	public function save_new_user($email, $name, $password, $salt, $role)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		//Create SQL Query
		$sql = "INSERT INTO user "
				. "(user_email, user_name, user_password, user_salt, "
				. "user_role) "
				. "VALUES "
				. "(?, ?, ?, ?, ?)";
		//Prepare Statement
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		//Bind parameters.
		$stmt->bind_param('ssssi', $email, $name, $password, $salt, $role);
		//Execute
		$stmt->execute();
		//Get ID of user just saved
		$id = $stmt->insert_id;
		$stmt->close();
		$dbc->terminate_connection();
		if ($id > 0)
		{
			return true;
		}
		return $db_con->error;
	}

	public function search_for_email($email)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		$sql = "SELECT COUNT(*) AS users FROM user WHERE user_email = ?;";
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		$stmt->bind_param('s', $email); //Bind parameters.
		$stmt->execute(); //Execute
		$stmt->bind_result($users); //Get ResultSet
		$stmt->fetch();
		$stmt->close();
		$dbc->terminate_connection();

		return $users;
	}

	public function check_if_valid_user_role($id)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		$sql = "SELECT user_role_short FROM user_role WHERE user_role_id = ?;";
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		$stmt->bind_param('i', $id); //Bind parameters.
		$stmt->execute(); //Execute
		$stmt->bind_result($role_short); //Get ResultSet
		$stmt->fetch();
		$rows = $stmt->num_rows();
		$stmt->close();
		$dbc->terminate_connection();

		if ($rows == 1)
		{
			return true;
		}
		return false;
	}
	
	public function get_salt_via_email($email)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		$sql = "SELECT user_salt FROM user WHERE user_email = ?;";
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		$stmt->bind_param('s', $email); //Bind parameters.
		$stmt->execute(); //Execute
		$stmt->bind_result($user_salt); //Get ResultSet
		$stmt->fetch();
		$stmt->close();
		$dbc->terminate_connection();

		if (!empty($user_salt))
		{
			return $user_salt;
		}
		return false;
	}
	
	public function check_if_hashed_password_matches_email($email, $password)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		$sql = "SELECT user_id FROM user WHERE user_email = ? AND user_password = ?;";
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		$stmt->bind_param('ss', $email, $password); //Bind parameters.
		$stmt->execute(); //Execute
		$stmt->bind_result($user_id); //Get ResultSet
		$stmt->fetch();
		$stmt->close();
		$dbc->terminate_connection();

		if (!empty($user_id))
		{
			return $user_id;
		}
		return false;
	}
	
	public function get_user_name_from_id($id)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		$sql = "SELECT user_name FROM user WHERE user_id = ?;";
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		$stmt->bind_param('i', $id); //Bind parameters.
		$stmt->execute(); //Execute
		$stmt->bind_result($user_name); //Get ResultSet
		$stmt->fetch();
		$stmt->close();
		$dbc->terminate_connection();

		if (!empty($user_name))
		{
			return $user_name;
		}
		return false;
	}

	public function get_all_user_roles()
	{
		
	}
	
	public function get_user_id_from_email($email)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();
		
		$sql = "SELECT user_id FROM user WHERE user_email = ?;";
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		$stmt->bind_param('s', $email); //Bind parameters.
		$stmt->execute(); //Execute
		$stmt->bind_result($user_id); //Get ResultSet
		$stmt->fetch();
		$stmt->close();
		$dbc->terminate_connection();

		if (!empty($user_id))
		{
			return $user_id;
		}
		return false;
	}

}

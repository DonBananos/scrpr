<?php

class Keyword_model
{

	function __construct()
	{
		
	}

	public function save_new_keyword($name, $path, $target_id, $number)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		//Create SQL Query
		$sql = "INSERT INTO keyword "
				. "(keyword_name, keyword_path, keyword_target_id, "
				. "keyword_number) "
				. "VALUES "
				. "(?, ?, ?, ?)";
		//Prepare Statement
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		//Bind parameters.
		$stmt->bind_param('ssii', $name, $path, $target_id, $number);
		//Execute
		$stmt->execute();
		//Get ID of user just saved
		$id = $stmt->insert_id;
		$stmt->close();
		$dbc->terminate_connection();
		if ($id > 0)
		{
			return $id;
		}
		return $db_con->error;
	}

	public function check_if_keyword_exists($name, $path, $target_id)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		//Create SQL Query
		$sql = "SELECT keyword_id "
				. "FROM keyword "
				. "WHERE keyword_name = ? "
				. "AND keyword_path = ? "
				. "AND keyword_target_id = ?;";
		//Prepare Statement
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		$stmt->bind_param('ssi', $name, $path, $target_id); //Bind parameters.
		$stmt->execute(); //Execute
		$stmt->bind_result($keyword_id); //Get ResultSet
		$stmt->fetch();
		$stmt->close();
		$dbc->terminate_connection();
		if ($keyword_id > 0)
		{
			return true;
		}
		return false;
	}

	public function get_all_keyword_ids_for_target($target_id)
	{
		$keyword_ids = array();

		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		$sql = "SELECT keyword_id FROM keyword WHERE keyword_target_id = ?;";
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		$stmt->bind_param('i', $target_id);
		$stmt->execute();
		$stmt->bind_result($keyword_id); //Get ResultSet
		while ($stmt->fetch())
		{
			array_push($keyword_ids, $keyword_id);
		}
		$stmt->close();
		return $keyword_ids;
	}

	public function get_array_of_keyword_details($keyword_id)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		$sql = "SELECT "
				. "keyword_name, keyword_path, keyword_number, "
				. "keyword_target_id "
				. "FROM keyword "
				. "WHERE keyword_id = ?;";
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		$stmt->bind_param('i', $keyword_id); //Bind parameters.
		$stmt->execute(); //Execute
		$stmt->bind_result($name, $path, $number, $target_id); //Get ResultSet
		$stmt->fetch();
		$stmt->close();
		$dbc->terminate_connection();

		$details = array();
		$details['name'] = $name;
		$details['path'] = $path;
		$details['number'] = $number;
		$details['target_id'] = $target_id;

		if (count($details) > 0)
		{
			return $details;
		}
		return false;
	}

}

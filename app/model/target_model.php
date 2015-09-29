<?php
/**
 * Target Model
 *
 * @author Mike Jensen <mj@mjsolutions.dk>
 */
class Target_model
{
	function __construct()
	{
		
	}
	
	public function save_new_target($title, $subtitle, $url, $user_id)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		//Create SQL Query
		$sql = "INSERT INTO target "
				. "(target_title, target_subtitle, target_url, target_user_id) "
				. "VALUES "
				. "(?, ?, ?, ?)";
		//Prepare Statement
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		//Bind parameters.
		$stmt->bind_param('sssi', $title, $subtitle, $url, $user_id);
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
	
	public function get_array_of_target_details($id)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();
		
		$sql = "SELECT "
				. "target_title, target_subtitle, target_url, target_user_id, "
				. "target_created "
				. "FROM target "
				. "WHERE target_id = ?;";
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		$stmt->bind_param('i', $id); //Bind parameters.
		$stmt->execute(); //Execute
		$stmt->bind_result($target_title, $target_subtitle, $target_url, $user_id, $target_created); //Get ResultSet
		$stmt->fetch();
		$stmt->close();
		$dbc->terminate_connection();
		
		$details = array();
		$details['title'] = $target_title;
		$details['subtitle'] = $target_subtitle;
		$details['url'] = $target_url;
		$details['user_id'] = $user_id;
		$details['datetime'] = $target_created;
		
		if(count($details) > 0)
		{
			return $details;
		}
		return false;
	}
	
	public function get_all_target_ids_owned_by_user($id)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();
		
		$target_ids = array();
		$sql = "SELECT target_id FROM target WHERE target_user_id = ? ORDER BY target_title ASC;";
		$stmt = $db_con->prepare($sql); //Prepare Statement
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $dbCon->error, E_USER_ERROR);
		}
		$stmt->bind_param('i', $id); //Bind parameters.
		$stmt->execute(); //Execute
		$stmt->bind_result($target_id); //Get ResultSet
		while($stmt->fetch())
		{
			array_push($target_ids, $target_id);
		}
		$stmt->close();
		return $target_ids;
	}
	
	public function update_target($id, $title, $subtitle, $url, $user_id)
	{
		$user_config = new Config();
		$dbc = new Database_controller($user_config->get_db_host(), $user_config->get_db_user(), $user_config->get_db_pass(), $user_config->get_db_schema());
		$db_con = $dbc->get_db_con();

		//Create SQL Query
		$sql = "UPDATE target SET target_title = ?, target_subtitle = ?, target_url = ?, target_user_id = ? WHERE target_id = ?;";
		//Prepare Statement
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		//Bind parameters.
		$stmt->bind_param('sssii', $title, $subtitle, $url, $user_id, $id);
		//Execute
		$stmt->execute();
		//Get ID of user just saved
		$affected_rows = $stmt->affected_rows;
		$stmt->close();
		$dbc->terminate_connection();
		if ($affected_rows > 0)
		{
			return true;
		}
		return $db_con->error;
	}
}

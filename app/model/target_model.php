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
				. "target_title AS title, target_subtitle AS subtitle, "
				. "target_url AS url, target_user_id AS owner_id, "
				. "target_created AS datetime "
				. "FROM target "
				. "WHERE target_id = ?;";
		//Prepare Statement
		$stmt = $db_con->prepare($sql);
		if ($stmt === false)
		{
			trigger_error('SQL Error: ' . $db_con->error, E_USER_ERROR);
		}
		//Bind parameters.
		$stmt->bind_param('i', $id);
		//Execute
		$stmt->execute();
		//Get ID of user just saved
		$stmt->bind_result($title, $subtitle, $url, $owner_id, $datetime); //Get ResultSet
		$stmt->fetch();
		$stmt->close();
		$dbc->terminate_connection();
		$details = array();
		$details['title'] = $title;
		$details['subtitle'] = $subtitle;
		$details['url'] = $url;
		$details['owner_id'] = $owner_id;
		$details['datetime'] = $datetime;
		if (count($details) == 1)
		{
			return $details;
		}
		return $db_con->error;
	}
}

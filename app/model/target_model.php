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
			return true;
		}
		return $db_con->error;
	}
}

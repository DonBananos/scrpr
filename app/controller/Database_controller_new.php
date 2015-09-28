<?php
/*
 * This object creates a connection to the database.
 */
class Database_controller
{

	private $db_con;

	/*
	 * Create an instance of the object and connect to the database.
	 */
	public function __construct($host, $user, $pass, $schema)
	{
		$this->create_connection($host, $user, $pass, $schema);
	}

	/*
	 * Function that establishes the connection to the database.
	 */
	private function create_connection($host, $user, $pass, $schema)
	{
		$this->db_con = new mysqli($host, $user, $pass, $schema);
	}

	/*
	 * Function that terminates the database connection
	 */
	public function terminate_connection()
	{
		$this->get_db_con()->close();
	}

	/*
	 * Function that can be called to get the connection, to use in other 
	 * objects
	 */
	public function get_db_con()
	{
		return $this->db_con;
	}

}

<?php
class Config
{
	
	private $base_url = '/scrpr/app/';
	private $db_host = '85.119.155.19';
	private $db_user = 'scrprdb';
	private $db_pass = 'MrR0b0t';
	private $db_schema = 'scrprdb';
	//Between 8-40 characters of lenght, shall include 1x lowercase, 1x uppercase, 1x integer
	private $regex_password = "/^(?=.*\d)+(?=.*[a-z])+(?=.*[A-Z])+[a-zA-Z0-9]{8,40}$/";
	//Check for username@domain.extension
	private $regex_email = "/^[a-zA-Z0-9_.+-]+@[a-z0-9A-Z]+\.[a-z0-9A-Z]*\.?[a-zA-Z]{2,}$/";
	
	public function __construct()
	{
		
	}
	
	public function generateRandomString($least_number_of_characters, $max_number_of_characters)
	{
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$number_of_characters = rand($least_number_of_characters, $max_number_of_characters);
		$random_string = "";
		for ($i = 0; $i < $number_of_characters; $i++)
		{
			$random_string .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $random_string;
	}
	
	public function get_base_url()
	{
		return $this->base_url;
	}
	
	public function get_db_host()
	{
		return $this->db_host;
	}

	public function get_db_user()
	{
		return $this->db_user;
	}

	public function get_db_pass()
	{
		return $this->db_pass;
	}

	public function get_db_schema()
	{
		return $this->db_schema;
	}
	
	public function get_regex_password()
	{
		return $this->regex_password;
	}
	
	public function get_regex_email()
	{
		return $this->regex_email;
	}
}
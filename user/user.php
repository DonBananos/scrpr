<?php

class User
{
	private $id;
	private $name;
	private $email;
	private $password;
	private $salt;
	private $creation_date;
	private $birthday;
	
	public function __construct($id = null)
	{
		//Construct the User object!
	}
	
	public function set_values_according_to_id($id)
	{
		
	}
	
	public function set_values_according_to_email($email)
	{
		
	}
	
	public function change_password($old, $new)
	{
		
	}
	
	public function update_user($name, $email, $birthday)
	{
		
	}
	
	private function change_name($name)
	{
		
	}
	
	private function change_email($email)
	{
		
	}
	
	private function change_birthday($birthday)
	{
		
	}
	
	public function reset_password($email)
	{
		
	}
	
	public function delete_user()
	{
		
	}
	
	public function get_all_target_ids()
	{
		
	}
	
	public function get_id()
	{
		return $this->id;
	}
	
	public function get_name()
	{
		return $this->name;
	}
	
	public function get_email()
	{
		return $this->email;
	}
	
	public function get_creation_date()
	{
		return $this->creation_date;
	}
	
	public function get_birthday()
	{
		return $this->birthday;
	}
	
	private function set_id($id)
	{
		$this->id = $id;
	}
	
	private function set_name($name)
	{
		$this->name = $name;
	}
	
	private function set_email($email)
	{
		$this->email = $email;
	}
	
	private function set_password($password)
	{
		$this->password = $password;
	}
	
	private function set_salt($salt)
	{
		$this->salt = $salt;
	}
	
	private function set_creation_date($creation_date)
	{
		$this->creation_date = $creation_date;
	}
	
	private function set_birthday($birthday)
	{
		$this->birthday = $birthday;
	}
}
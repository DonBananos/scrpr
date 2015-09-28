<?php

class User_controller
{

	function __construct()
	{
		
	}

	public function create_new_user($email, $name, $password1, $password2, $role = 1)
	{
		$um = new User_model();
		if (!$this->validate_email($email))
		{
			die("Email validation error");
		}
		if (!$this->validate_passwords($password1, $password2))
		{
			die("Password validation error");
		}
		else
		{
			$salt = $this->generate_salt();
			$password = $this->hash_password($password1, $salt);
		}
		$result = $um->save_new_user($email, $name, $password, $salt, $role);
		return $result;
	}

	private function hash_password($password, $salt)
	{
		/*
		 * Function that receives a password and a salt, and hashes the password
		 * using the received salt
		 */

		//Hash password
		$hashed_password = hash_hmac('sha512', $password, $salt);
		//Return that hashed password
		return $hashed_password;
	}

	public function generate_salt()
	{
		/*
		 * Function to create a random salt for each user
		 */
		//New instance of Config
		$uc_config = new Config();
		//Get new salt from config file
		$salt = $uc_config->generateRandomString(20, 30);
		//returns salt
		return $salt;
	}

	public function validate_email($email)
	{
		/*
		 * Function that checks if email is valid
		 */
		//New instance of Config
		$uc_config = new Config();
		//Get Email Regular Expression Pattern from config
		$regex_email = $uc_config->get_regex_email();
		//Match email with pattern
		$regex_result = preg_match($regex_email, $email);
		//If Patterns is matched in email
		if ($regex_result === 1)
		{
			//Return answer of function that checks if email is in use in db
			return $this->check_if_email_is_free($email);
		}
		//else return false
		return false;
	}

	private function validate_passwords($password1, $password2)
	{
		/*
		 * Function to validate the two typed passwords
		 */
		//If the two passwords are identical
		if ($password1 === $password2)
		{
			//Return answre of function that checks for passwords complexity
			return $this->validate_password_complexity($password1);
		}
		//Else return false
		return false;
	}

	private function validate_password_complexity($password)
	{
		/*
		 * Function that checks if complexity of password is enough
		 */
		//Crete new instance of a config
		$uc_config = new Config();
		//Get the Regular Expression Pattern for passwords from the config file
		$regex_password = $uc_config->get_regex_password();
		//Match password with the pattern
		$regex_result = preg_match($regex_password, $password);
		//If match of pattern and password is correct
		if ($regex_result === 1)
		{
			//Return false
			return true;
		}
		//else return false
		return false;
	}

	public function check_if_email_is_free($email)
	{
		/*
		 * Function that checks if email is in use in database or not
		 */
		//New instance of the user model
		$um = new User_model();
		//if the result of the search_for_email function in the user model is 
		//more than 0
		if ($um->search_for_email($email) > 0)
		{
			return false;
		}
		//else return true (THIS IS WHAT WE WANT!)
		return true;
	}

	private function check_if_valid_user_role($role)
	{
		/*
		 * Function that checks if the given user role is existing in the db
		 */
		//Create new instance of User model
		$um = new User_model();
		//Get if role is in db, and return true or false (true if it is in db)
		return $um->check_if_valid_user_role($role);
	}

	public function sign_user_in($email, $password)
	{
		$email_check = $this->check_if_email_is_free($email);
		if (!$email_check)
		{
			//Email is in use, this is good!
			//New instance of User Model
			$um = new User_model();
			//Get salt from user model
			$salt = $um->get_salt_via_email($email);
			//Hash password with new salt
			$hashed_password = $this->hash_password($password, $salt);
			//Check if credentials are correct
			$result = $um->check_if_hashed_password_matches_email($email, $hashed_password);
			if (is_int($result) AND $result > 0)
			{
				$_SESSION['signed_in'] = true;
				$_SESSION['user_id'] = $um->get_user_id_from_email($email);
				return true;
			}
			return false;
		}
		return false;
	}

	public function get_user_name_from_id($id)
	{
		$uc = new User_model();
		$user_name = $uc->get_user_name_from_id($id);

		return $user_name;
	}

}

<?php

/**
 * Target Controller
 *
 * @author Mike Jensen <mj@mjsolutions.dk>
 */
class Target_controller
{

	function __construct()
	{
		
	}

	public function create_new_target($title, $subtitle, $url, $user_id)
	{
		$tm = new Target_model();
		if (!$this->check_on_target_title($title))
		{
			die("There needs to be a Target title!");
		}
		$target_subtitle = $this->check_on_subtitle($subtitle);
		$target_url = $this->check_on_url($url);
		$target_owner_user_id = $this->check_on_user_id($user_id);

		$result = $tm->save_new_target($title, $target_subtitle, $target_url, $target_owner_user_id);

		return $result;
	}

	private function check_on_target_title($title)
	{
		if (strlen($title) > 0)
		{
			return true;
		}
		return false;
	}

	private function check_on_subtitle($subtitle)
	{
		if (empty($subtitle))
		{
			//no worries - This is not a mandatory field!
			return null;
		}
		return $subtitle;
	}

	public function check_on_url($url)
	{

		$newurl = "";
		if (substr($url, 0, 4) !== "http")
		{
			$newurl = "http://" . $url;
		}
		else
		{
			$newurl = $url;
		}
                
		if (!filter_var($newurl, FILTER_VALIDATE_URL) === false)
		{
			return $newurl;
		}
		else
		{
			die("$newurl is NOT a valid URL");
		}
	}

	private function check_on_user_id($user_id)
	{
		if ($user_id == $_SESSION['user_id'])
		{
			return $user_id;
		}
		die("There was an error with your profile saving a new Target");
	}

	public function get_target_details_on_id($id)
	{
		if (!is_int($id))
		{
			$id = intval($id);
		}
		if ($id > 0)
		{
			$tm = new Target_model();
			$details = $tm->get_array_of_target_details($id);
			return $details;
		}
		return false;
	}

	public function retrieve_all_target_details_with_owner_id($id)
	{
		$all_target_details = array();

		$tm = new Target_model();
		$target_ids = $tm->get_all_target_ids_owned_by_user($id);
		foreach ($target_ids as $target_id)
		{
			$target_details = $tm->get_array_of_target_details($target_id);
			$all_target_details[$target_id] = $target_details;
		}
		return $all_target_details;
	}

}
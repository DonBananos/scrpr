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

	private function check_on_url($url)
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
			return $url;
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

	public function save_keywords_for_target($keyword_names, $keyword_paths, $target_id)
	{
		$saved_keyword_ids = array();
		
		$keywords = $this->make_array_of_submitted_keywords($keyword_names, $keyword_paths);
		//Keyword is an array of keyword arrays with: name, path, number
		foreach ($keywords as $keyword)
		{
			$keyword['target_id'] = $target_id;
			if ($this->check_if_keyword_exists($keyword))
			{
				//Keyword already exists... Don't do anything!
			}
			else
			{
				$km = new Keyword_model();
				$result = $km->save_new_keyword($keyword['name'], $keyword['path'], $target_id, $this->get_next_available_keyword_number_for_target($target_id));
				if ($result > 0)
				{
					$saved_keyword_ids[] = $result;
				}
				else
				{
					$saved_keyword_ids[] = false;
				}
			}
		}
		
		return $saved_keyword_ids;
	}

	private function check_if_keyword_exists($keyword)
	{
		//Keyword is an array with: name, path, number
		$name = $keyword['name'];
		$path = $keyword['path'];
		$target_id = $keyword['target_id'];

		$km = new Keyword_model();
		return $km->check_if_keyword_exists($name, $path, $target_id);
	}

	private function get_next_available_keyword_number_for_target($target_id)
	{
		$highest_number = 0;
		$km = new Keyword_model();
		$keyword_ids = $km->get_all_keyword_ids_for_target($target_id);
		foreach ($keyword_ids as $keyword_id)
		{
			$keyword_details = $km->get_array_of_keyword_details($keyword_id);
			if ($keyword_details['number'] > $highest_number)
			{
				$highest_number = $keyword_details['number'];
			}
		}
		$next_number = $highest_number + 1;
		return $next_number;
	}

	private function make_array_of_submitted_keywords($keyword_names, $keyword_paths)
	{
		$keywords = array();
		if(count($keyword_names) === count($keyword_paths))
		{
			$count = 0;
			foreach($keyword_names as $keyword_name)
			{
				$keyword['name'] = $keyword_name;
				$keyword['path'] = $keyword_paths[$count];
				array_push($keywords, $keyword);
				$count++;
			}
			return $keywords;
		}
		else
		{
			die("Oh no! You fucked up big time!");
		}
	}
	
	public function get_all_keyword_info_for_target($target_id)
	{
		$keyword_details = array();
		$km = new Keyword_model();
		$keyword_ids = $km->get_all_keyword_ids_for_target($target_id);
		foreach($keyword_ids as $keyword_id)
		{
			$details = $km->get_array_of_keyword_details($keyword_id);
			$keyword_details[$keyword_id] = $details;
		}
		return $keyword_details;
	}
}

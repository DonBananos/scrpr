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
		if(!$this->check_on_target_title($title))
		{
			die("There needs to be a Target title!");
		}
		$target_subtitle = $this->check_on_subtitle($subtitle);
	}
	
	private function check_on_target_title($title)
	{
		if(strlen($title) > 0)
		{
			return true;
		}
		return false;
	}
	
	private function check_on_subtitle($subtitle)
	{
		if(empty($subtitle))
		{
			//no worries - This is not a mandatory field!
			return null;
		}
		return $subtitle;
	}
	
	private function check_on_url($url)
	{
		//Some testing on protocol - Insert http:// if missing
		//Some testing on www. - Insert if missing
	}
	
	private function check_on_user_id($user_id)
	{
		if($user_id == $_SESSION['user_id'])
		{
			return true;
		}
		return false;
	}
}
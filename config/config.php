<?php
class Config
{
	
	private $base_url = '/scrpr/app/';
	
	public function __construct()
	{
		
	}
	
	public function get_base_url()
	{
		return $this->base_url;
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $data;
	
	
	function index()
	{
		echo "<h1>Hi " . $this->input->ip_address().'</h1>';
			
	}
	
	
	
	
}

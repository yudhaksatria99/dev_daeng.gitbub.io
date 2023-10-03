<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('max_execution_time', 720);
require APPPATH.'/libraries/REST_Controller.php';
class Email_queued extends REST_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('mymail');
	} 

	function index_get()
	{
        sendMail();
	}
	
}




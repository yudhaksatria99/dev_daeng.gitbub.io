<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('max_execution_time', 720);
require APPPATH.'/libraries/REST_Controller.php';
class CreateSchedule extends REST_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_dashboard');
	} 

	function index_get()
	{
        $rs = $this->m_dashboard->cronCreateSchedule();
		foreach($rs as $r):
			echo $r->schedule_number.' '.$r->schedule_name.' '.$r->nik.' '.$r->date_created.'</br>';
		endforeach;
	}
	
}




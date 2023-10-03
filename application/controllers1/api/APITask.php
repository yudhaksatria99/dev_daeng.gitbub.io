<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('max_execution_time', 120);
ini_set('memory_limit','512M'); 
ini_set('sqlsrv.ClientBufferMaxKBSize','524288');
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');

require APPPATH.'/libraries/REST_Controller.php';
class APITask extends REST_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_list');
		
	} 
	
	function temp_get()
    {
	
		$rs = $this->m_list->getTaskItemTemp();
		if ($rs)
		{
	
			$this->response($rs, REST_Controller::HTTP_OK); 
		}
		else
		{
		
			$this->response([
				'success' => FALSE,
				'message' => 'No data were found'
			], REST_Controller::HTTP_NOT_FOUND); 
		}
       
    }
}

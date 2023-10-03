<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('max_execution_time', 120);
ini_set('memory_limit','512M'); 
ini_set('sqlsrv.ClientBufferMaxKBSize','524288');
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');
 
require APPPATH.'/libraries/REST_Controller.php';
class Register extends REST_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_ac');
		$this->load->model('m_proses');
		$this->load->library('basejson');
		
	} 
	
	function index_post(){
		
		if (!$this->post('username')){
			$respons = array(
                'success' => FALSE,
                'message' => 'Username masih kosong!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);			
		}
		
		if (!$this->post('password')){
			$respons = array(
                'success' => FALSE,
                'message' => 'Password masih kosong!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);			
		}
		
		if (!$this->post('token')){
			$respons = array(
                'success' => FALSE,
                'message' => 'Token masih kosong!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);			
		}

		if (!$this->post('imei')){
			$respons = array(
                'success' => FALSE,
                'message' => 'IMEI masih kosong!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);			
		}

        if (!$this->post('device')){
			$respons = array(
                'success' => FALSE,
                'message' => 'Nama Device masih kosong!'
            );
			$this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);			
		}
		
		$rs = $this->m_ac->setRegister($this->post('username'), $this->post('password'), $this->post('token'), $this->post('imei'), $this->post('device'));
		
		if (!$rs){
			$respons = array(
                'success' => FALSE,
                'message' => 'Server bermasalah!',
            );
			$this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);
			
		}
		if ($rs->Id == 0) {
			$respons = array(
                'success' => FALSE,
                'message' => $rs->ProcessMessage,
            );
			$this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);
			
		}else {
			$data['register'] = $this->m_ac->viewByNIK($this->post('username'));
			if ($data){	
				$str64 = $this->basejson->setJson($data);
				$respons = array(
					'success' => TRUE,
					'message' => $rs->ProcessMessage,
					'data' => $str64
				);
				$this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
				$this->response($respons, 200);
	
			}else {
				$respons = array(
					'success' => FALSE,
					'message' => $rs->ProcessMessage,
				);
				$this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
				$this->response($respons, 200);	
			}
		}
	}
		
}

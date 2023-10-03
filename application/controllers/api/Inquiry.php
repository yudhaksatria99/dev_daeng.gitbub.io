<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('max_execution_time', 120);
ini_set('memory_limit','512M'); 
ini_set('sqlsrv.ClientBufferMaxKBSize','524288');
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');

require APPPATH.'/libraries/REST_Controller.php';
class Inquiry extends REST_Controller {
	private $username;
	private $password;
	private $token;
	private $command;
	private $timestamp;
	private $signature;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_ac');
		$this->load->model('m_proses');
		$this->load->library('basejson');
	} 
	
	function index_post(){
		/* START AUTH */
				
		$this->username = $this->post('username');
		$this->password = $this->post('password');
		$this->token = $this->post('token');
		$this->command = $this->post('command');
		$this->timestamp = $this->post('timestamp');
		$this->signature = $this->post('signature');
		
		if (is_null($this->username)){
			$respons = array(
                'success' => FALSE,
                'message' => 'Username masih kosong!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);			
		}
		
		if (is_null($this->password)){
			$respons = array(
                'success' => FALSE,
                'message' => 'Password masih kosong!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);			
		}
		
		if (is_null($this->token)){
			$respons = array(
                'success' => FALSE,
                'message' => 'Token masih kosong!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);			
		}

        if (is_null($this->command)){
			$respons = array(
                'success' => FALSE,
                'message' => 'Command masih kosong!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);				
		}
    	
        if (is_null($this->timestamp)){
			$respons = array(
                'success' => FALSE,
                'message' => 'Timestamp masih kosong!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);						
		}
		
		if (is_null($this->signature)){
			$respons = array(
                'success' => FALSE,
                'message' => 'Signature masih kosong!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);			
		}

		$login = $this->m_ac->getLogin($this->username, $this->password, $this->token);
		if (!$login) {
			$respons = array(
                'success' => FALSE,
                'message' => 'Username atau Password salah!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);				
		}

		$t1 = time();
		$t2 = abs($t1 - (int)substr($this->timestamp, 0, 10));
		// 9000 detik, 2,5 jam
		if ($t2 > 9000) {
			$respons = array(
                'success' => FALSE,
                'message' => $t2.' seconds, your time is over limit!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);						
		}
		
		$str = $this->command."".$this->username."".$this->password."".$this->timestamp;
		$auth = $this->m_ac->crypto($this->token, $str);
		if ($auth != $this->signature){
			$respons = array(
                'success' => FALSE,
                'message' => 'Signature tidak valid!'
            );
            $this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);										
		}
		
		/* END AUTH */
		
		$helper_name = strtolower($this->command);
		$path_helper =  APPPATH.'/helpers/'.$helper_name.'_helper.php';

		if (file_exists($path_helper)){
			$this->load->helper($helper_name);
		
			$id = 0;
			$awal = date('Y-m-d');
			$akhir = date('Y-m-d');
			if ($this->post('awal')) $awal = $this->post('awal');
			if ($this->post('akhir')) $akhir = $this->post('akhir');
			
			switch ($helper_name){
				case 'schedule':
				case 'history':
					if ($this->post('id')) $id = $this->post('id');
				break;

				case 'forgot_password':
					$id = $this->password;
					$awal = $this->_insert_id;
				break;
				
				case 'otherapp':
					$id = $this->password;
				break;
				
				default: 
					if ($this->post('id')) $id = sprintf("%.0f", $this->post('id'));
					
			}
			
			
			$data = view_data($this->username, $awal, $akhir, $id);

			if ($data){
				$str64 = $this->basejson->setJson($data);
				$respons = array(
					'success' => TRUE,
					'message' => 'Data inquiry '.$this->command,
					'data' => $str64
				);
				$this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons, JSON_UNESCAPED_SLASHES));
				$this->response($respons, 200);
	
			}else {
				$respons = array(
					'success' => FALSE,
					'message' => 'Tidak ada data '.$this->command.'!'
				);
				$this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
				$this->response($respons, 200);		
				
			}
	
		}else {
			$respons = array(
					'success' => FALSE,
					'message' => 'Inquiry command '.$this->command.' tidak dikenal!'
				);
			$this->m_proses->setHttpRespon($this->_insert_id, json_encode($respons));
			$this->response($respons, 200);	
		}
	}
	
		
}

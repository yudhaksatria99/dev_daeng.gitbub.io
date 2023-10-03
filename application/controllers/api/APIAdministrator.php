<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class APIAdministrator extends REST_Controller {
	
	function __construct()
	{
        parent::__construct();
		//Load CRUD Library
		$this->load->library('mycrud', array('tblname' => 'ms_config'));
		
	} 
	
	
	// Insert Data
	function add_post()
    {
		 if(!$this->post('username'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Admin Name masih kosong'), 200);
		}
		
		if (preg_match('/^\S.*\s.*\S$/', $this->post('username'))){
			$this->response(array('success' => FALSE, 'message' => 'Admin Name tidak boleh ada spasi!'), 200);
		}

		$obj = array(
			'username' => $this->post('username'),
			'password' => md5($this->post('password'))
		);
		
		$data = $this->mycrud->getById('config_name', 'superuser');
		$rs = json_decode($data->json_value);
		$object = array();
		$upd = 0;
		for ($i=0;$i<count($rs);$i++){ 
			if ($rs[$i]->username == $this->post('username')){
				$object[] = $obj;
				$upd = 1;
			}else {
				$object[] = $rs[$i];
			}
		}
		
		if ($upd == 0) $object[] = $obj;

		$id = $this->mycrud->updateData('config_name', 'superuser', array('json_value' => json_encode($object)));
		if (!empty($id)){
			$this->response(array('success' => TRUE, 'message' => 'Insert berhasil!'), 200);			
		
		}else {
			$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat diinput!'), 200);
		}
		
    }
	
	
	// Edit Data
	function edit_post()
    {
		
		if(!$this->post('username'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Admin Name masih kosong'), 200);
        }
		
		if ($this->post('old_password') != $this->post('new_password')){
			$obj = array(
				'username' => $this->post('username'),
				'password' => md5($this->post('new_password'))
			);
			
			$data = $this->mycrud->getById('config_name', 'superuser');
			$rs = json_decode($data->json_value);
			$object = array();
			for ($i=0;$i<count($rs);$i++){ 
				if ($rs[$i]->username == $this->post('username')){
					$object[] = $obj;
				}else {
					$object[] = $rs[$i];
				}
			}

			$id = $this->mycrud->updateData('config_name', 'superuser', array('json_value' => json_encode($object)));
			if (!empty($id)){
				$this->response(array('success' => TRUE, 'message' => 'Update berhasil!'), 200);			
			
			}else {
				$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat diubah!'), 200);
			}
			
		}else {
			$this->response(array('success' => FALSE, 'message' => 'Data tidak berubah!'), 200);
		}
		
    }
    
    
	// View Data
	function view_get()
    {
		
		$data = $this->mycrud->getById('config_name', 'superuser');
		if ($data)
		{
			$rs = json_decode($data->json_value);
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

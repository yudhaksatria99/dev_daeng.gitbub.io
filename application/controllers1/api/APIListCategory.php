<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class APIListCategory extends REST_Controller {
	
	function __construct()
	{
        parent::__construct();
		//Load CRUD Library
		$this->load->library('mycrud', array('tblname' => 'list_category'));
		$this->load->model('m_list');

	} 
	
	
	// Insert Data
	function add_post()
    {
		 if(!$this->post('name'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Nama Kategori masih kosong'), 200);
        }
	
		
		$object = array(
				'category_name' => $this->post('name'),
				'is_active' => $this->post('is_active')
			);

		$obj = $this->mycrud->createData($object);
		if (!empty($obj)){
			$this->response(array('success' => TRUE, 'message' => 'Insert berhasil!'), 200);			
		
		}else {
			$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat diinput!'), 200);
		}
		


		
    }
	
	
	// Edit Data
	function edit_post()
    {
		
		if(!$this->post('name'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Nama Kategori masih kosong'), 200);
        }
		
		
		$object = array(
				'category_name' => $this->post('name'),
				'is_active' => $this->post('is_active'),
				'date_updated' => date('Y-m-d H:i:s')
			);
		
		$obj = $this->mycrud->updateData('category_id', $this->post('id'), $object);
		if (!empty($obj)){
			$this->response(array('success' => TRUE, 'message' => 'Update berhasil!'), 200);			
		
		}else {
			$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat diubah!'), 200);
		}
		
    }
    
    
	// View Data
	function view_get()
    {
		
		$rs = $this->m_list	->getAllListCategory();;
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

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class APIListItem extends REST_Controller {
	
	function __construct()
	{
        parent::__construct();
		//Load CRUD Library
		$this->load->library('mycrud', array('tblname' => 'list_item'));
		$this->load->helper('image');
		$this->load->model('m_list');
	} 
	
	
	// Insert Data
	function add_post()
    {
		if(!$this->post('group'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Nama Group masih kosong'), 200);
        }
		
		if(!$this->post('category'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Nama Kategori masih kosong'), 200);
        }
		
		if(!$this->post('description'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Deskripsi Item masih kosong'), 200);
        }
		
		if(!$this->post('bobot'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Bobot Item masih kosong'), 200);
		}
		
		if(!$this->post('rekomendasi'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Rekomendasi masih kosong'), 200);
        }
		
		$object = array(
			'group_id' => $this->post('group'),
			'category_id' => $this->post('category'),
			'description' => $this->post('description'),
			'bobot' => $this->post('bobot'),
			'rekomendasi_id' => $this->post('rekomendasi'),
			'informasi_id' => $this->post('informasi'),
			'dept_id' => $this->post('departement'),
			'is_active' => $this->post('is_active')
		);
		
		if (isset($_FILES['image']['name'])){
			$image_source = basename($_FILES['image']['name']);
			$imageFileType = pathinfo($image_source, PATHINFO_EXTENSION);

			// Allow certain file formats
			if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
				|| $imageFileType == "gif" ) {
					
				$dir = FCPATH .'uploads/';
				
				$target_file = $dir .'original/' . $image_source;

				if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
					
					$image_name = 'listitem_' .rand().'.' .$imageFileType;	
					image_resize( $target_file, $dir .'512/' , $image_name, 512, 256 );
					image_resize( $target_file, $dir .'150/' , $image_name, 150, 75 );
			
					$object['image'] = $image_name;
				}    		
			}
		}
		$obj = $this->mycrud->createData($object);
		if (!empty($obj)){
			$this->m_list->updateListGroup($this->post('group'), array('date_updated' => date('Y-m-d H:i:s')));
			$this->response(array('success' => TRUE, 'message' => 'Insert berhasil!'), 200);			
		
		}else {
			$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat diinput!'), 200);
		}
		
    }
	
	
	// Edit Data
	function edit_post()
    {
		
		if(!$this->post('group'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Nama Group masih kosong'), 200);
        }
		
		if(!$this->post('category'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Nama Kategori masih kosong'), 200);
        }
		
		if(!$this->post('description'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Deskripsi Item masih kosong'), 200);
        }
		
		if(!$this->post('bobot'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Bobot Item masih kosong'), 200);
        }
		
		$object = array(
			'group_id' => $this->post('group'),
			'category_id' => $this->post('category'),
			'description' => $this->post('description'),
			'bobot' => $this->post('bobot'),
			'rekomendasi_id' => $this->post('rekomendasi'),
			'informasi_id' => $this->post('informasi'),
			'dept_id' => $this->post('departement'),
			'is_active' => $this->post('is_active'),
			'date_updated' => date('Y-m-d H:i:s')
		);
		
      
		$image_source = basename($_FILES['image']['name']);
		$imageFileType = pathinfo($image_source, PATHINFO_EXTENSION);
		
		// Allow certain file formats
		if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
			|| $imageFileType == "gif" ) {
				
			
			$dir = FCPATH .'uploads/';
			
			$target_file = $dir .'original/' . $image_source;

			if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
				
				$image_name = 'listitem_' .rand().'.' .$imageFileType;	
				image_resize( $target_file, $dir .'512/' , $image_name, 512, 256 );
				image_resize( $target_file, $dir .'150/' , $image_name, 150, 75 );
				
				$object['image'] = $image_name;

			} 		
		}
		
		$obj = $this->mycrud->updateData('item_id', $this->post('id'), $object);
		if (!empty($obj)){
			$this->m_list->updateListGroup($this->post('group'), array('date_updated' => date('Y-m-d H:i:s')));
			$this->response(array('success' => TRUE, 'message' => 'Update berhasil!'), 200);			
		
		}else {
			$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat diubah!'), 200);
		}
		
    }
    
    
	// View Data
	function view_get($id = null)
    {
		
		$rs = $this->m_list->getListItemByGroup($id);
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

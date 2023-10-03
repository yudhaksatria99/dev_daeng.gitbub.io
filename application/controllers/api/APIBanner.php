<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
require APPPATH.'/libraries/REST_Controller.php';
class APIBanner extends REST_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('image');
		//Load CRUD Library
		$this->load->library('mycrud', array('tblname' => 'ms_banner'));
	
	} 
	
	
	// Insert Data
	function add_post()
    {
        if(!$this->post('name'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Nama Banner masih kosong'), 200);
        }
		
		// HEADER
		$image_source = basename($_FILES['header']['name']);
		$imageFileType = pathinfo($image_source, PATHINFO_EXTENSION);

		// Allow certain file formats
		if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
			|| $imageFileType == "gif" ) {
				
			$dir = FCPATH .'uploads/';
			
			$target_file = $dir .'original/' . $image_source;

			if (move_uploaded_file($_FILES['header']['tmp_name'], $target_file)) {
				
				$image_name = 'header_' .rand().'.' .$imageFileType;	
				image_resize( $target_file, $dir .'512/' , $image_name, 512, 256 );
				image_resize( $target_file, $dir .'150/' , $image_name, 150, 75 );
				
				$obj['header'] = $image_name;

			} else {
				$this->response(array('success' => FALSE, 'message' => 'File tidak dapat diupload!'), 200);				

			}    		
		}else {
			$this->response(array('success' => FALSE, 'message' => 'File '.$image_source. ' bukan format image!'), 200);	
				
		}
		
		
		// FOOTER
		$image_source = basename($_FILES['footer']['name']);
		$imageFileType = pathinfo($image_source, PATHINFO_EXTENSION);

		// Allow certain file formats
		if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
			|| $imageFileType == "gif" ) {
				
			$dir = FCPATH .'uploads/';
			
			$target_file = $dir .'original/' . $image_source;

			if (move_uploaded_file($_FILES['footer']['tmp_name'], $target_file)) {
				
				$image_name = 'footer_' .rand().'.' .$imageFileType;	
				image_resize( $target_file, $dir .'512/' , $image_name, 512, 256 );
				image_resize( $target_file, $dir .'150/' , $image_name, 150, 75 );
				
				$obj['footer'] = $image_name;

			} else {
				$this->response(array('success' => FALSE, 'message' => 'File tidak dapat diupload!'), 200);				

			}    		
		}else {
			$this->response(array('success' => FALSE, 'message' => 'File '.$image_source. ' bukan format image!'), 200);	
				
		}
		
		$obj['banner_name'] = $this->post('name');
		$obj['is_active'] = 0;
		$rs = $this->mycrud->createData($obj);
		if ($rs)
		{
			$this->response(array('success' => TRUE, 'message' => 'Berhasil disimpan!'), 200);
		}
		else
		{
			$this->response(array('success' => FALSE, 'message' => 'Gagal disimpan!'), 200);
		}
	
    }
	

	
	// Edit Data
	function edit_post()
    {
	
		
		$obj = $this->mycrud->updateData('banner_id', $this->post('id'), array('is_active' => $this->post('is_active')));
		if (!empty($obj)){
			$this->response(array('success' => TRUE, 'message' => 'Edit berhasil!'), 200);			
		
		}else {
    		$this->response(array('success' => FALSE, 'message' => 'Data tidak bisa diedit'), 200);
        }
    }
	
	
	// View Data
	function view_get()
    {
		
		$rs = $this->mycrud->readData();
		if ($rs)
		{
			// Set the response and exit
			$this->response($rs, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		}
		else
		{
			// Set the response and exit
			$this->response([
				'success' => FALSE,
				'message' => 'No data were found'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
       
    }
	
}

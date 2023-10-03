<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class APIListGroup extends REST_Controller
{

	function __construct()
	{
		parent::__construct();
		//Load CRUD Library
		$this->load->library('mycrud', array('tblname' => 'list_group'));
		$this->load->helper('image');
		$this->load->model('m_list');
	}


	// Insert Data
	function add_post()
	{
		if (!$this->post('name')) {
			$this->response(array('success' => FALSE, 'message' => 'Nama Group masih kosong'), 200);
		}

		if (!$this->post('seq')) {
			$this->response(array('success' => FALSE, 'message' => 'Sequence masih kosong'), 200);
		}


		$image_source = basename($_FILES['icon']['name']);
		$imageFileType = pathinfo($image_source, PATHINFO_EXTENSION);

		// Allow certain file formats
		if (
			$imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
			|| $imageFileType == "gif"
		) {

			$dir = FCPATH . 'uploads/';

			$target_file = $dir . 'original/' . $image_source;

			if (move_uploaded_file($_FILES['icon']['tmp_name'], $target_file)) {

				$image_name = 'listgroup_' . rand() . '.' . $imageFileType;
				image_resize($target_file, $dir . '512/', $image_name, 512, 512);
				image_resize($target_file, $dir . '150/', $image_name, 150, 150);

				$object = array(
					//'group_name' => ucfirst(strtolower($this->post('name'))),
					'group_name' => $this->post('name'),
					'seq' => $this->post('seq'),
					'is_active' => $this->post('is_active'),
					'group_image' => $image_name
				);

				$obj = $this->mycrud->createData($object);
				if (!empty($obj)) {
					$this->response(array('success' => TRUE, 'message' => 'Insert berhasil!'), 200);
				} else {
					$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat diinput!'), 200);
				}
			} else {
				$this->response(array('success' => FALSE, 'message' => 'File tidak dapat diupload!'), 200);
			}
		} else {
			$this->response(array('success' => FALSE, 'message' => 'File ' . $image_source . ' bukan format image!'), 200);
		}
	}


	// Edit Data
	function edit_post()
	{

		if (!$this->post('name')) {
			$this->response(array('success' => FALSE, 'message' => 'Nama Group masih kosong'), 200);
		}

		if (!$this->post('seq')) {
			$this->response(array('success' => FALSE, 'message' => 'Sequence masih kosong'), 200);
		}

		$object = array(
			//'group_name' => ucfirst(strtolower($this->post('name'))),
			'group_name' => $this->post('name'),
			'seq' => $this->post('seq'),
			'is_active' => $this->post('is_active'),
			'date_updated' => date('Y-m-d H:i:s')
		);



		$image_source = basename($_FILES['icon']['name']);
		$imageFileType = pathinfo($image_source, PATHINFO_EXTENSION);

		// Allow certain file formats
		if (
			$imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
			|| $imageFileType == "gif"
		) {


			$dir = FCPATH . 'uploads/';

			$target_file = $dir . 'original/' . $image_source;

			if (move_uploaded_file($_FILES['icon']['tmp_name'], $target_file)) {

				$image_name = 'listgroup_' . rand() . '.' . $imageFileType;
				image_resize($target_file, $dir . '512/', $image_name, 512, 512);
				image_resize($target_file, $dir . '150/', $image_name, 150, 150);

				$object['group_image'] = $image_name;
			} else {
				$this->response(array('success' => FALSE, 'message' => 'File tidak dapat diupload!'), 200);
			}
		}

		$obj = $this->mycrud->updateData('group_id', $this->post('id'), $object);
		if (!empty($obj)) {
			$this->response(array('success' => TRUE, 'message' => 'Update berhasil!'), 200);
		} else {
			$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat diubah!'), 200);
		}
	}


	// View Data
	function view_get()
	{

		$rs = $this->m_list->getAllListGroup();
		if ($rs) {
			$this->response($rs, REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'success' => FALSE,
				'message' => 'No data were found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}

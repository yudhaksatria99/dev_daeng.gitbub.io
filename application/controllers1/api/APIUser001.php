<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
require APPPATH . '/libraries/REST_Controller.php';
class APIUser extends REST_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('m_user');
		//Load CRUD Library
		$this->load->library('mycrud', array('tblname' => 'ms_user'));
	}

	function login_post()
	{
		if (!$this->post('nik')) {
			$this->response(array('success' => FALSE, 'message' => 'NIK masih kosong'), 200);
		}

		if (!$this->post('password')) {
			$this->response(array('success' => FALSE, 'message' => 'Password masih kosong'), 200);
		}

		$rs = $this->m_user->getSuperUser();
		if ($rs) {
			$jsv = json_decode($rs->json_value);
			foreach ($jsv as $j) :
				if ($j->username == $this->post('nik')) {
					$row = (object) [
						'nik' => 'SUPERUSER',
						'password' => $j->password,
						'nama' => 'Administrator',
						'jabatan' => 'SUPERUSER'
					];
				}
			endforeach;
		}
		if (!$row) $row = $this->m_user->getByNIK($this->post('nik'));

		if (!empty($row)) {

			if ($row->password == md5($this->post('password'))) {

				$this->session->set_userdata('admin', $row);

				$dtjbt = array(
					'jabatan' => $row->jabatan,
				);
				$this->session->set_userdata($dtjbt);





				$this->response(array('success' => TRUE, 'message' => 'Login berhasil!'), 200);
			} else {
				$this->response(array('success' => TRUE, 'message' => 'Password salah!'), 200);
			}
		} else {
			$this->response(array('success' => TRUE, 'message' => 'NIK atau Password tidak terdaftar!'), 200);
		}
	}


	// Insert Data
	function add_post()
	{
		$this->db->db_debug = FALSE;
		if (!$this->post('nik')) {
			$this->response(array('success' => FALSE, 'message' => 'NIK masih kosong'), 200);
		}


		if (!$this->post('email')) {
			$this->response(array('success' => FALSE, 'message' => 'Email masih kosong'), 200);
		}

		if (!$this->post('password')) {
			$this->response(array('success' => FALSE, 'message' => 'Password masih kosong'), 200);
		}

		$row = $this->m_user->getByNIK($this->post('nik'));
		if (empty($row)) {

			$rs = $this->m_user->validNIK($this->post('nik'));
			if (empty($rs)) $this->response(array('success' => FALSE, 'message' => 'NIK tidak valid!'), 200);
			$data = $this->m_user->generateToken();
			$object = array(
				'nik' => trim($this->post('nik')),
				'email' => $this->post('email'),
				'password' => md5($this->post('password')),
				'is_active' => 0,
				'token' => $data->token
			);

			$id = $this->mycrud->createData($object);
			if (!empty($id)) {

				$this->load->helper('emailqueued');
				email_activation($this->post('nik'), $this->post('password'));
				$this->response(array('success' => TRUE, 'message' => 'Insert berhasil!'), 200);
			} else {
				$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat diinput!'), 200);
			}
		} else {
			$this->response(array('success' => FALSE, 'message' => 'NIK ' . $this->post('nik') . ' sudah pernah diinput!'), 200);
		}
	}


	// Edit Data
	function edit_post()
	{
		$this->db->db_debug = FALSE;
		if (!$this->post('nik')) {
			$this->response(array('success' => FALSE, 'message' => 'NIK masih kosong'), 200);
		}

		if (!$this->post('email')) {
			$this->response(array('success' => FALSE, 'message' => 'Email masih kosong'), 200);
		}
		$object = array(
			'email' => $this->post('email'),
			'date_updated' => date('Y-m-d H:i:s')
		);
		if ($this->post('email') != $this->post('old_email')) {
			$data = $this->m_user->generateToken();
			$object['password'] = md5($this->post('password'));
			$object['token'] = $data->token;
		}

		$obj = $this->mycrud->updateData('user_id', $this->post('id'), $object);
		if (!empty($obj)) {
			if ($this->post('email') != $this->post('old_email')) {
				$this->load->helper('emailqueued');
				email_activation($this->post('nik'), $this->post('password'));
			}
			$this->response(array('success' => TRUE, 'message' => 'Edit berhasil!'), 200);
		} else {
			$this->response(array('success' => FALSE, 'message' => 'Data tidak bisa diedit'), 200);
		}
	}

	// reset Data
	function reset_post()
	{
		$this->db->db_debug = FALSE;
		if (!$this->post('nik')) {
			$this->response(array('success' => FALSE, 'message' => 'NIK masih kosong'), 200);
		}

		if (!$this->post('email')) {
			$this->response(array('success' => FALSE, 'message' => 'Email masih kosong'), 200);
		}
		$object = array(
			'email' => $this->post('email'),
			'date_updated' => date('Y-m-d H:i:s')
		);
		if ($this->post('email') == $this->post('old_email')) {
			$data = $this->m_user->generateToken();
			$object['password'] = md5($this->post('password'));
			$object['token'] = $data->token;
		}



		$object2 = array(
			'is_active' => "0",
			'date_updated' => date('Y-m-d H:i:s'),
			'password' => md5($this->post('password')),
			'token' => $data->token
		);
		$this->mycrud->updateData('user_id', $this->post('id'), $object2);

		$obj = $this->mycrud->resetData('user_id', $this->post('id'));

		if (!empty($obj)) {
			if ($this->post('email') == $this->post('old_email')) {
				$this->load->helper('emailqueued');
				email_activation($this->post('nik'), $this->post('password'));
			}
			$this->response(array('success' => TRUE, 'message' => 'Reset berhasil!'), 200);
		} else {
			$this->response(array('success' => FALSE, 'message' => 'Data tidak bisa direset'), 200);
		}
	}

	// Set Trash Data
	function trash_post()
	{
		if (!$this->post('id')) {
			$this->response(array('success' => FALSE, 'message' => 'ID masih kosong'), 200);
		}

		$obj = $this->mycrud->updateData('user_id', $this->post('id'), array('status_data' => 9, 'date_updated' => date('Y-m-d H:i:s')));
		if (!empty($obj)) {
			$this->response(array('success' => TRUE, 'message' => 'Hapus berhasil!'), 200);
		} else {
			$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat dihapus!'), 200);
		}
	}


	// View Data
	function view_get()
	{

		$rs = $this->m_user->getData();
		if ($rs) {
			// Set the response and exit
			$this->response($rs, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'success' => FALSE,
				'message' => 'No data were found'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	function checkNIK_get()
	{
		if (isset($_GET['nik'])) {
			$rs = $this->m_user->validNIK($this->get('nik'));
		}
		if ($rs) {
			$this->response($rs, REST_Controller::HTTP_OK);
		}
	}
}

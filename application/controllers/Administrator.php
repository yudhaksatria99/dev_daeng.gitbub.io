<?php defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'administrator';
	}

	function index()
	{
		$jb = $this->session->userdata('jabatan');
		if (!$jb) {
			checkLogin();
		} else {
			if ($jb !== 'SUPERUSER') show_404();
		}

		$this->load->view('sidebar', $this->data);
		$this->load->view('administrator/view_admin', $this->data);
		$this->load->view('foot', $this->data);
	}

	function add()
	{

		$this->load->view('administrator/add_admin', $this->data);
		$this->load->view('js_form');
	}

	function edit($id = null)
	{

		$this->load->library('mycrud', array('tblname' => 'ms_config'));
		$data = $this->mycrud->getById('config_name', 'superuser');
		$rs = json_decode($data->json_value);
		for ($i=0;$i<count($rs);$i++){ 
			if ($rs[$i]->username == $id) $this->data['admin'] = $rs[$i];
		}

		$this->load->view('administrator/edit_admin', $this->data);
		$this->load->view('js_form');
	}
}

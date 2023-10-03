<?php defined('BASEPATH') or exit('No direct script access allowed');

class Reason extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'reason';
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
		$this->load->view('reason/view_reason', $this->data);
		$this->load->view('foot', $this->data);
	}

	function add()
	{

		$this->load->view('reason/add_reason', $this->data);
		$this->load->view('js_form');
	}

	function edit($id = null)
	{

		$this->load->library('mycrud', array('tblname' => 'schedule_reason'));
		$this->data['reason'] = $this->mycrud->getById('reason_id', $id);

		$this->load->view('reason/edit_reason', $this->data);
		$this->load->view('js_form');
	}
}

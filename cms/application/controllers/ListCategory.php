<?php defined('BASEPATH') or exit('No direct script access allowed');

class ListCategory extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'category';
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
		$this->load->view('list/view_category', $this->data);
		$this->load->view('foot', $this->data);
	}

	function add()
	{

		$this->load->view('list/add_category', $this->data);
		$this->load->view('js_form');
	}

	function edit($id = null)
	{

		$this->load->library('mycrud', array('tblname' => 'list_category'));
		$this->data['category'] = $this->mycrud->getById('category_id', $id);

		$this->load->view('list/edit_category', $this->data);
		$this->load->view('js_form');
	}
}

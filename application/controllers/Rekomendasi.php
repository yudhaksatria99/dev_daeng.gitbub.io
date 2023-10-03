<?php defined('BASEPATH') or exit('No direct script access allowed');

class Rekomendasi extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'rekomendasi';
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
		$this->load->view('list/view_rekomendasi', $this->data);
		$this->load->view('foot', $this->data);
	}

	function add()
	{

		$this->load->view('list/add_rekomendasi', $this->data);
		$this->load->view('js_form');
	}

	function edit($id = null)
	{

		$this->load->library('mycrud', array('tblname' => 'ms_rekomendasi'));
		$this->data['rekomendasi'] = $this->mycrud->getById('rekomendasi_id', $id);

		$this->load->view('list/edit_rekomendasi', $this->data);
		$this->load->view('js_form');
	}
}

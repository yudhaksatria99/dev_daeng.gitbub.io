<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisReport extends CI_Controller {
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'jenis report';
		
	} 

	function index()
	{
		$this->load->view('sidebar', $this->data);
		$this->load->view('jenis_report/view_jenis_report', $this->data);
		$this->load->view('foot', $this->data);
	}
	
	function add()
	{
		$this->data['url_sync'] = URL_WEB_API.'/SyncTableau';
		$this->load->view('jenis_report/sync_report', $this->data);
	}

	function edit($id = null)
	{	
		
		$this->load->library('mycrud', array('tblname' => 'jenis_report'));
		$this->data['report'] = $this->mycrud->getById('report_id', $id);
		
		$this->load->view('jenis_report/edit_jenis_report', $this->data);
		$this->load->view('js_form');
		
	}


}

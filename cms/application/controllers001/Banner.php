<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'banner';
		
	} 

	function index()
	{
		$this->load->view('sidebar', $this->data);
		$this->load->view('banner/view_banner', $this->data);
		$this->load->view('foot', $this->data);
	}
	
	function add()
	{	
	
		$this->load->view('banner/add_banner', $this->data);
		$this->load->view('js_form');
		
	}

	function edit($id = null)
	{	
		
		$this->load->library('mycrud', array('tblname' => 'ms_banner'));
		$this->data['banner'] = $this->mycrud->getById('banner_id', $id);
		
		$this->load->view('banner/edit_banner', $this->data);
		$this->load->view('js_form');
		
	}


}

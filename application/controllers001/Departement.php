<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departement extends CI_Controller {
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'departement';
	
	} 

	function index()
	{
		$this->load->view('sidebar', $this->data);
		$this->load->view('departement/view_dept', $this->data);
		$this->load->view('foot', $this->data);
	}
	
	function add()
	{	
	
		$this->load->view('departement/add_dept', $this->data);
		$this->load->view('js_form');
		
	}

	function edit($id = null)
	{	
		
		$this->load->library('mycrud', array('tblname' => 'ms_departement'));
		$this->data['dept'] = $this->mycrud->getById('dept_id', $id);
		
		$this->load->view('departement/edit_dept', $this->data);
		$this->load->view('js_form');
		
	}

}

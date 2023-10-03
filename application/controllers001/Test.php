<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'test';
		
	} 

	function index()
	{
		$this->load->view('sidebar', $this->data);
		$this->load->view('test/view_test', $this->data);
		$this->load->view('foot', $this->data);
	}
	
}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SyncTableau extends CI_Controller {	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('tableau');
	}
	
	function index()
	{
		get_jenis_report();
	}
	
}

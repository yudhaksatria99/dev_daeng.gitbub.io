<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {	
	function __construct()
	{
		parent::__construct();
		$this->load->library('mycrud', array('tblname' => 'ms_user'));
		
	}
	
	function index()
	{
		if (!isset($_GET['token'])){
			show_404($page = '', $log_error = TRUE);
		}
		$token = $_GET['token'];
		$data = $this->mycrud->getById('token', $token);
		echo "<h1>Hi " . $this->input->ip_address().'</h1>';
		if (!empty($data)){
			if ($data->is_active != 0){
				echo "<p><strong>Already activated on ".date('d M Y H:i:s', strtotime($data->date_updated))."!</strong></p>";
			}else {
					
				$id = $this->mycrud->updateData('user_id', $data->user_id, array('is_active' => 1, 'date_updated' => date('Y-m-d H:i:s')));
				if (!empty($id)){
					echo "<p><strong>Activation was success!</strong></p>";
				}else {
					echo "<p><strong>Failed to activation!</strong></p>";
				}
			}
		}else {
			echo "<p><strong>Wrong activation's token!</strong></p>";
		}
			
	}
	
}

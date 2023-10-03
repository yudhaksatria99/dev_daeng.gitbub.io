<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {	
	function __construct()
	{
		parent::__construct();
		$this->load->library('mycrud', array('tblname' => 'ms_user'));
		$this->load->model('m_ac');
		
	}
	
	function index()
	{
		if (!isset($_GET['token'])){
			show_404($page = '', $log_error = TRUE);
		}
		$token = $_GET['token'];
		$data = $this->mycrud->getById('token', $token);
		if (!empty($data)){
								
			$id = $this->mycrud->updateData('user_id', $data->user_id, array('is_active' => 1, 'date_updated' => date('Y-m-d H:i:s')));
			if (!empty($id)){
				$this->landingPage($data);
			}else {
				echo "<p><strong>Failed to activation!</strong></p>";
			}
			
		}else {
			echo "<p><strong>Wrong activation's token!</strong></p>";
		}
			
	}
	
	private function landingPage($rs){
		$data['ac'] = $this->m_ac->getByNIK($rs->nik);
		$this->load->view('activation.php', $data);
	}
	
}

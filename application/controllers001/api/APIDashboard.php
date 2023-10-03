<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('max_execution_time', 120);
ini_set('memory_limit','512M'); 
ini_set('sqlsrv.ClientBufferMaxKBSize','524288');
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');

require APPPATH.'/libraries/REST_Controller.php';
class APIDashboard extends REST_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_dashboard');
		
	} 
	
	function stores_get()
    {
		
		$rs = $this->m_dashboard->getTokoByNIK($this->get('nik'));
		if ($rs)
		{
			// Set the response and exit
			$this->response($rs, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		}
		else
		{
			// Set the response and exit
			$this->response([
				'success' => FALSE,
				'message' => 'No data were found'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
       
    }
	
	function ac_get()
    {
		
		$rs = $this->m_dashboard->getACByNIK($this->get('nik'));
		if ($rs)
		{
			$this->response($rs, REST_Controller::HTTP_OK); 
		}
		else
		{
		
			$this->response([
				'success' => FALSE,
				'message' => 'No data were found'
			], REST_Controller::HTTP_NOT_FOUND); // 
		}
       
    }

	function schedule_get()
    {
		
		$rs = $this->m_dashboard->getScheduleByNumber($this->get('nik'), $this->get('number'));
		if ($rs)
		{
	
			$this->response($rs, REST_Controller::HTTP_OK); 
		}
		else
		{
		
			$this->response([
				'success' => FALSE,
				'message' => 'No data were found'
			], REST_Controller::HTTP_NOT_FOUND); 
		}
       
	}
	
	function tasks_get()
    {
	
		$rs = $this->m_dashboard->getTaskDetail($this->get('id'));
		if ($rs)
		{
	
			$this->response($rs, REST_Controller::HTTP_OK); 
		}
		else
		{
		
			$this->response([
				'success' => FALSE,
				'message' => 'No data were found'
			], REST_Controller::HTTP_NOT_FOUND); 
		}
       
	}
	
	
	function visited_get()
    {

		$rs = $this->m_dashboard->getVisitedByDate($this->get('nik'), $this->get('awal'), $this->get('akhir'));
		if ($rs)
		{
			// Set the response and exit
			$this->response($rs, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		}
		else
		{
			// Set the response and exit
			$this->response([
				'success' => FALSE,
				'message' => 'No data were found'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
       
	}
	
	function addSchedule_post()
    {
		//Load CRUD Library
		$this->load->library('mycrud', array('tblname' => 'schedule_detail'));

		if(!$this->post('number'))
        {
			$this->response(array('success' => FALSE, 'message' => 'Schedule Number masih kosong'), 200);
        }
		
		$schedule_number = $this->post('number');
		$periode = $this->post('periode');
		$visit_date = $this->post('visit_date');
	
		if ($periode == date('Ym')){
			if (substr($visit_date, 0,7) != date('Y-m')){
				$this->response(array('success' => FALSE, 'message' => 'Visit Date harus dibulan yang sama!'), 200);
			}else if (strtotime($visit_date) <= time()){
				$this->response(array('success' => FALSE, 'message' => 'Visit Date minimal H+1!'), 200);
			}
		}else {
			if (substr($visit_date, 0,7) != date('Y-m', strtotime("+1 months", time()))){
				$this->response(array('success' => FALSE, 'message' => 'Visit Date harus dibulan yang sama!'), 200);
			}
		}
		
		$data = array(
			'schedule_number' => $schedule_number,
			'kode' => $this->post('kode'),
			'visit_date' => $visit_date,
			'visit_hour' => $this->post('hour').':'.$this->post('minute')
		);
		$obj = $this->mycrud->createData($data);
		if (!empty($obj)){
			$this->response(array('success' => TRUE, 'message' => 'Berhasil disimpan!'), 200);			
		}else {
    		$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat disimpan!'), 200);
        }
       
    }

	function editSchedule_post()
    {
		//Load CRUD Library
		$this->load->library('mycrud', array('tblname' => 'schedule_detail'));

		if(!$this->post('id'))
        {
			$this->response(array('success' => FALSE, 'message' => 'ID masih kosong'), 200);
        }
			
		$obj = $this->mycrud->updateData('schedule_id', $this->post('id'), array('is_active' => $this->post('is_active'), 'date_updated' => date('Y-m-d H:i:s')));
		if (!empty($obj)){
			$this->response(array('success' => TRUE, 'message' => 'Berhasil diupdate!'), 200);			
		}else {
    		$this->response(array('success' => FALSE, 'message' => 'Data tidak dapat diupdate!'), 200);
        }
       
    }
	
	function filterToko_get()
	{
		$rs = $this->m_dashboard->filterToko($this->get('nik'), $this->get('filter'));
		if ($rs)
		{
			// Set the response and exit
			$this->response($rs, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		}
		else
		{
			// Set the response and exit
			$this->response([
				'success' => FALSE,
				'message' => 'No data were found'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}
}

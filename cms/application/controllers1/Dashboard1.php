<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 120);
ini_set('memory_limit','512M'); 
ini_set('sqlsrv.ClientBufferMaxKBSize','524288');
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');

class Dashboard extends CI_Controller {
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_dashboard');
		$this->load->model('m_toko');
		$this->data['active'] = 'dashboard';
	} 
	
	function index()
	{
		$this->data['traffic'] = $this->m_dashboard->getReportTraffic();
		$this->data['view'] = 'grafik';
		if (isset($_GET['view'])) $this->data['view'] = $_GET['view'];

		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'dashboard';
		
		$nik = $this->data['admin']->nik;

		if ($this->data['view'] == 'schedule'){
			$d = explode("-", $_GET['id']);
			$this->data['empid'] = $d[0];
			$this->data['number'] = $d[1];
			$this->data['schedule'] = $this->m_dashboard->getScheduleHeader($this->data['number']);
				

		} else if ($this->data['view'] == 'tasks'){
			$this->data['task_id'] = 0;
			$this->data['tasks'] = $this->m_dashboard->getAllTask();
			if (isset($_GET['id'])) {
				$this->data['task_id'] = $_GET['id'];
			}else {
				if (isset($this->data['tasks'][0]->task_id)){
					$this->data['task_id'] = $this->data['tasks'][0]->task_id;
				}
			}

			//Bobot
			$this->data['bobot'] = $this->m_dashboard->countBobotList($this->data['task_id']);
		}else if ($this->data['view'] == 'visited'){
			$this->data['awal'] = date('Y-m-01');
			$this->data['akhir'] = date('Y-m-d');
			if (isset($_GET['awal'])) $this->data['awal'] = $_GET['awal'];
			if (isset($_GET['akhir'])) $this->data['akhir'] = $_GET['akhir'];

		}

		$this->data['store'] = $this->m_dashboard->countStore($nik);
		$this->data['ac'] = $this->m_dashboard->countAC($nik);
		$this->data['task'] = $this->m_dashboard->countTasks();
		$this->data['visited'] = $this->m_dashboard->countVisited($nik);
		
		
		$this->load->view('sidebar', $this->data);
		$this->load->view('body', $this->data);
		$this->load->view('foot', $this->data);
		
	}

	function add($id = null){
		$this->data['admin'] = checkLogin();
		$nik = $this->data['admin']->nik;
		
		$d = explode("-", $id);
		$this->data['empid'] = $d[0];
		$this->data['number'] = $d[1];
		$this->data['schedule'] = $this->m_dashboard->getScheduleHeader($this->data['number']);
		$this->data['suffix'] = '/?view=schedule&id='.$id;  
		$this->data['toko'] = $this->m_toko->viewTokoByNIK($nik);
		
		$this->load->view('sidebar', $this->data);
		$this->load->view('dashboard/add_schedule', $this->data);
		$this->load->view('js_form_suffix', $this->data);
		$this->load->view('foot', $this->data);
	}

	function edit($id = null){
		$this->data['schedule'] = $this->m_dashboard->getScheduleById($id);
		$this->data['suffix'] = '/?view=schedule&id='.$this->data['schedule']->nik.'-'.$this->data['schedule']->schedule_number;  
		$this->load->view('dashboard/edit_schedule', $this->data);
		$this->load->view('js_form_suffix', $this->data);
	}
	

	function login()
	{
		$this->load->view('login');		
	}
	
	function logout()
	{
		unset($_SESSION['admin']);
		$this->load->view('login');
		
	}


}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'dashboard';
		$this->load->model('m_list');
		$this->data['group'] = $this->m_list->getListGroup();
		$this->data['category'] = $this->m_list->getListCategory();
	} 

	function add()
	{		
		
		if (isset($_GET['id'])) $this->m_list->insertItemTemp($_GET['id']);
		if (isset($_GET['temp_id'])) $this->m_list->deleteItemTemp($_GET['temp_id']);

		$this->data['group_id'] = 5;
		if (isset($_GET['group'])) $this->data['group_id'] = $_GET['group'];
		
		$this->data['category_id'] = 0;
		if (isset($_GET['category'])){
			$this->data['category_id'] = $_GET['category'];
			$this->data['item'] = $this->m_list->getTodoListByGroupCategory($this->data['group_id'], $this->data['category_id']);
		} else {
			$this->data['item'] = $this->m_list->getTodoListByGroup($this->data['group_id']);
		}
		//Bobot
		$this->data['bobot'] = $this->m_list->countBobotTemp();
		
		$this->load->view('sidebar', $this->data);
		$this->load->view('task/add_task', $this->data);
		$this->load->view('foot', $this->data);
	}

	function submit(){
		$uri = $this->input->post('uri');
		$name = $this->input->post('name');
		$effective = date("Y-m-01", strtotime("+1 month", time()));
		$rs = $this->m_list->processTaskList($name, $effective);

		if ($rs->Id == 0){
			header('Location:'.$uri);
		
		}else {
			header('Location:'.base_url('Dashboard/?view=tasks'));
		}
	}

	function edit(){
		$id = $_GET['id'];
		$seq = $_GET['seq'];
		$rs = $this->m_list->editSeqTemp($id, $seq);
		echo $rs;
	}


}

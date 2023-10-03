<?php defined('BASEPATH') or exit('No direct script access allowed');

class ListItem extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data['admin'] = checkLogin();
		$this->data['active'] = 'group';
		$this->load->model('m_list');
		$this->data['group'] = $this->m_list->getListGroup();
		$this->data['category'] = $this->m_list->getListCategory();
		$this->data['departement'] = $this->m_list->getDepartement();
		$this->data['rekomendasi'] = $this->m_list->getRekomendasi();
		$this->data['info'] = $this->m_list->getInformasi();
	}

	function index()
	{
		$jb = $this->session->userdata('jabatan');
		if (!$jb) {
			checkLogin();
		} else {
			if ($jb !== 'SUPERUSER') show_404();
		}

		$this->load->library('mycrud', array('tblname' => 'list_group'));
		$this->data['group_id'] = 1;
		if (isset($_GET['group'])) $this->data['group_id'] = $_GET['group'];
		$rs = $this->mycrud->getById('group_id', $this->data['group_id']);
		$this->data['group_name'] = $rs->group_name;

		$this->data['item'] = $this->m_list->getListItemByGroup($this->data['group_id']);
		$this->load->view('sidebar', $this->data);
		$this->load->view('list/view_item', $this->data);
		$this->load->view('foot', $this->data);
	}

	function add($id = null)
	{
		foreach ($this->data['group'] as $group) :
			if ($group->group_id == $id) {
				$this->data['group_id'] = $id;
				$this->data['group_name'] = $group->group_name;
			}
		endforeach;
		$this->data['suffix'] = '/?group=' . $id;
		$this->load->view('sidebar', $this->data);
		$this->load->view('list/add_item', $this->data);
		$this->load->view('js_form_suffix', $this->data);
		$this->load->view('foot', $this->data);
	}

	function edit($id = null)
	{

		$this->load->library('mycrud', array('tblname' => 'list_item'));
		$this->data['item'] = $this->mycrud->getById('item_id', $id);
		$this->data['suffix'] = '/?group=' . $this->data['item']->group_id;

		$this->load->view('sidebar', $this->data);
		$this->load->view('list/edit_item', $this->data);
		$this->load->view('js_form_suffix', $this->data);
		$this->load->view('foot', $this->data);
	}
}

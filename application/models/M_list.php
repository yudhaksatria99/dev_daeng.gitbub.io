<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_list extends CI_Model {
	private $ho = DB_HO;

	function getListGroup() {
		$this->db->where('is_active', 1);
		$this->db->order_by('group_name ASC');
		$query  = $this->db->get('list_group');
		return $query->result();

	}
	
	function getAllListGroup() {
		$this->db->order_by('is_active DESC, group_name ASC');
		$query  = $this->db->get('list_group');
		return $query->result();

	}

	function getListCategory() {
		$this->db->where('is_active', 1);
		$this->db->order_by('category_name');
		$query  = $this->db->get('list_category');
		return $query->result();

	}

	function getDepartement() {
		$this->db->where('is_active', 1);
		$this->db->order_by('dept_name');
		$query  = $this->db->get('ms_departement');
		return $query->result();

	}

	function getRekomendasi() {
		$this->db->where('is_active', 1);
		$this->db->order_by('rekomendasi');
		$query  = $this->db->get('ms_rekomendasi');
		return $query->result();
	}

	function getInformasi() {
		$this->db->where('is_active', 1);
		$this->db->order_by('informasi');
		$query  = $this->db->get('ms_informasi');
		return $query->result();
	}
	
	function getAllListCategory() {
		$this->db->order_by('is_active DESC, category_name');
		$query  = $this->db->get('list_category');
		return $query->result();

	}


	function getListItemByGroup($group){
		$this->db->select('a.*,b.group_name,c.category_name');
		$this->db->join('list_group b', 'b.group_id=a.group_id');
		$this->db->join('list_category c', 'c.category_id=a.category_id');
		$this->db->where('a.group_id', $group);
		//$this->db->order_by('LTRIM(a.description) ASC');
		
		$query = $this->db->get('list_item a');
		return $query->result();
		
	}

	function getTodoListByGroup($group){
		$this->db->select('a.*,b.group_name,c.category_name,ISNULL(d.temp_id,0) AS temp_id');
		$this->db->join('list_group b', 'b.group_id=a.group_id');
		$this->db->join('list_category c', 'c.category_id=a.category_id');
		$this->db->join('task_detail_temp d', 'd.item_id=a.item_id', 'LEFT');
		$this->db->where('a.group_id', $group);
		$this->db->where('a.is_active', 1);
		$this->db->where('a.effective_date <= ', date('Y-m-d'));
		$query = $this->db->get('list_item a');
		return $query->result();
		
	}

	function getTodoListByGroupCategory($group, $category){
		$this->db->select('a.*,b.group_name,c.category_name,ISNULL(d.temp_id,0) AS temp_id');
		$this->db->join('list_group b', 'b.group_id=a.group_id');
		$this->db->join('list_category c', 'c.category_id=a.category_id');
		$this->db->join('task_detail_temp d', 'd.item_id=a.item_id', 'LEFT');
		$this->db->where('a.group_id', $group);
		$this->db->where('a.category_id', $category);
		$this->db->where('a.is_active', 1);
		$this->db->where('a.effective_date <= ', date('Y-m-d'));
		$query = $this->db->get('list_item a');
		return $query->result();
		
	}

	function getTaskItemTemp(){
		$this->db->select('a.*,b.description,b.image,b.bobot,c.group_name,d.category_name');
		$this->db->join('list_item b', 'b.item_id=a.item_id');
		$this->db->join('list_group c', 'c.group_id=b.group_id');
		$this->db->join('list_category d', 'd.category_id=b.category_id');
		$this->db->order_by('b.group_id, a.seq');
		$query = $this->db->get('task_detail_temp a');
		return $query->result();
		
	}

	function insertItemTemp($id){
		$this->db->db_debug = false;
		$query = $this->db->query("EXEC dbo.spInsertItemTemp '$id'");
	}

	function deleteItemTemp($id){
		$this->db->db_debug = false;
		$this->db->delete('task_detail_temp', array('temp_id' => $id));
	}

	function editSeqTemp($id, $seq){
		$this->db->db_debug = false;
		$this->db->where('temp_id', $id);
		$query = $this->db->update('task_detail_temp', array('seq' => $seq));
		return $this->db->affected_rows();
		
	}

	function countBobotTemp(){
		$this->db->select('ISNULL(SUM(b.bobot),0) AS jumlah');  
		$this->db->join('list_item b','b.item_id=a.item_id');
		$query = $this->db->get('task_detail_temp a');
		return $query->row(); 
	}

	function processTaskList($name, $effective){
		$query = $this->db->query("EXEC dbo.spProcessTaskList '$name','$effective'");
		return $query->row();

	}

	function updateListGroup($id, $obj){
		$this->db->where('group_id', $id);
		$query = $this->db->update('list_group', $obj);
		return $this->db->affected_rows();
	}

	function copyTaskTemp($id){
		$query = $this->db->query("EXEC dbo.spCopyTaskTemp '$id'");
		return $query->row();

	}
}

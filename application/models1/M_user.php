<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_user extends CI_Model {
	private $ho = DB_HO;

	function getData() {
		$query  = $this->db->query("EXEC dbo.spGetAllUser '$this->ho'");
		return $query->result();

	}

	function getById($id){
		$this->db->where("user_id", $id);
		$query  = $this->db->get("ms_user");
		return $query->row();
	}
	
	
	function getByNIK($nik){
		$query  = $this->db->query("EXEC dbo.spGetByNIK '$this->ho','$nik'");
		return $query->row();
	}
			
	function validNIK($nik){
		$query  = $this->db->query("EXEC dbo.spValidNIK '$this->ho','$nik'");
		return $query->row();
	}

	function generateToken(){
		$query  = $this->db->query("SELECT dbo.fcGetToken() AS token");
		return $query->row();
	}

	function insertEmailQueued($object){
		$query = $this->db->insert('email_queued', $object);
		return $this->db->insert_id();
	}
	
	function getSuperUser(){
		$this->db->where('config_name', 'superuser');
		$query  = $this->db->get('ms_config');
		return $query->row();
		
	}
}

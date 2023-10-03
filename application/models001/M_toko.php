<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_toko extends CI_Model {
	private $ho = DB_HO;

	function getData() {
		$query  = $this->db->query("EXEC dbo.spGetAllToko '$this->ho'");
		return $query->result();

	}
	
	function getByKode($kode){
		$query  = $this->db->query("EXEC dbo.spGetByKode '$this->ho','$kode'");
		return $query->row();
	}

	function viewTokoByNIK($nik){
		$query  = $this->db->query("EXEC dbo.spGetTokoByNIK '$this->ho','$nik'");
		return $query->result();
	}
            
}

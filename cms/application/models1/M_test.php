<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_test extends CI_Model {
	private $ho;

	function __construct(){
		$this->ho = $this->load->database('rms', TRUE);

	}

	function testTable(){
		$this->db->select("user_id, token");
		$query  = $this->db->get("ms_user");
		return $query->result();
	}

	function getTest(){
		$query  = $this->ho->query("EXEC dbo.spTest");
		return $query->result();
	}

}

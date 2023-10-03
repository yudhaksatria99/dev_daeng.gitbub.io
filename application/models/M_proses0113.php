<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_proses extends CI_Model
{
	private $ho = PB_HO;

	function setHttpRespon($rest_log_id, $respons)
	{
		$object = array(
			'rest_log_id' => $rest_log_id,
			'respons' => $respons
		);
		$this->db->insert('log_respons', $object);
		$id =  $this->db->insert_id();
		return $id;
	}

	function checkIn($nik, $toko, $reason, $xml)
	{
		$query  = $this->db->query("EXEC dbo.Proses_Checkin '$nik','$toko','$reason','$xml'");
		return $query->row();
	}

	function checkOut($nik, $visit_id, $timestamp)
	{
		$query  = $this->db->query("EXEC dbo.Proses_Checkout '$nik','$visit_id','$timestamp'");
		return $query->row();
	}

	function createSchedule($nik, $period, $name, $xml)
	{
		$query  = $this->db->query("EXEC dbo.Proses_CreateSchedule2 '$nik','$period','$name','$xml'");
		return $query->row();
	}

	function getVisitHeader($id)
	{
		$this->db->where('visit_id', $id);
		$query = $this->db->get('visit_header');
		return $query->result();
	}

	function prosesCheckList($visit_id, $group_id, $xml)
	{
		$query  = $this->db->query("EXEC dbo.Proses_CheckList '$visit_id','$group_id','$xml'");
		return $query->row();
	}

	function prosesNotes($visit_id, $group_id, $object)
	{
		$this->db->where('visit_id', $visit_id);
		$this->db->where('group_id', $group_id);
		foreach ($object as $obj) :
			$this->db->update('visit_rekomendasi', $obj);
		endforeach;
		return $this->db->affected_rows();
	}

	function changePassword($nik, $new_password)
	{
		$this->db->where('nik', $nik);
		$this->db->update('ms_user', array('password' => md5($new_password), 'date_updated' => date('Y-m-d H:i:s')));
		return $this->db->affected_rows();
	}
}

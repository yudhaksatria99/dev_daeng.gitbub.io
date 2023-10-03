<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_inquiry extends CI_Model {
	private $ho = DB_HO;
	
	function viewTokoByNIK($nik){
		$query  = $this->db->query("EXEC dbo.spGetTokoByNIK '$this->ho','$nik'");
		return $query->result();
	}

	function viewScheduleByNIK($nik, $awal, $akhir){
		$query  = $this->db->query("EXEC dbo.spGetScheduleByNIK '$this->ho','$nik','$awal','$akhir'");
		return $query->result();
	}
	
	function viewScheduleByNumber($number){
		$query  = $this->db->query("EXEC dbo.spGetScheduleByNumber '$this->ho','$number'");
		return $query->result();
	}

	function viewReason(){
		$this->db->select('reason_id,reason_name');
		$this->db->where('is_active', 1);
		$query = $this->db->get('schedule_reason');
		return $query->result();
	}

	function viewListGroup($tgl_update){
		$image_url = IMAGE_URL;
		$query  = $this->db->query("EXEC dbo.spGetTaskGroup '$image_url','$tgl_update'");
		return $query->result();

	}

	function viewListItem($task_id){	
		$image_url = IMAGE_URL;
		$query  = $this->db->query("EXEC dbo.spGetTaskItem '$image_url','$task_id'");
		return $query->result();
	
	}

	function visitReportByGroup($visit_id, $group_id){	
		$query  = $this->db->query("EXEC dbo.spVisitReportByGroup '$visit_id','$group_id'");
		return $query->result();
	}

	function viewStatusCheckIn($nik){	
		$query  = $this->db->query("EXEC dbo.spGetStatusCheckIn '$nik'");
		return $query->result();
	}

	function viewJenisReport(){
		$image_url = IMAGE_URL;
		$query  = $this->db->query("EXEC dbo.spGetJenisReport '$image_url'");
		return $query->result();
	}
	
	function viewBanner(){
		$image_url = IMAGE_URL;
		$query  = $this->db->query("EXEC dbo.spGetBanner '$image_url'");
		return $query->result();
	}
	
}

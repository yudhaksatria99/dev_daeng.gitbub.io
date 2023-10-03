<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_dashboard extends CI_Model
{
	private $ho = DB_HO;

	function countStore($nik)
	{
		$query  = $this->db->query("EXEC dbo.spCountStore '$this->ho','$nik'");
		return $query->row();
	}

	function countAC($nik)
	{
		$query  = $this->db->query("EXEC dbo.spCountAC '$this->ho','$nik'");
		return $query->row();
	}


	function countTasks()
	{
		$query  = $this->db->query("EXEC dbo.spCountTasks");
		return $query->row();
	}

	function countVisited($nik)
	{
		$query  = $this->db->query("EXEC dbo.spCountVisited '$nik'");
		return $query->row();
	}

	function getTokoByNIK($nik)
	{
		$query  = $this->db->query("EXEC spGetTokoByNIK '$this->ho','$nik'");
		return $query->result();
	}

	function getACByNIK($nik)
	{
		$query  = $this->db->query("EXEC spGetACByNIK2 '$this->ho','$nik'");
		return $query->result();
	}

	function getVisitedByNIK($nik)
	{
		$query  = $this->db->query("EXEC spGetVisitedByNIK '$nik'");
		return $query->result();
	}

	function getVisitedByDate($nik, $awal, $akhir)
	{
		$query  = $this->db->query("EXEC spGetVisitedByDate '$nik','$awal','$akhir'");
		return $query->result();
	}

	function getScheduleHeader($number)
	{
		$this->db->where('schedule_number', $number);
		$query  = $this->db->get('schedule_header');
		return $query->row();
	}

	function getScheduleByNumber($nik, $number)
	{
		$query  = $this->db->query("EXEC spGetScheduleByNumber '$this->ho','$number' ");
		return $query->result();
	}

	function getScheduleById($id)
	{
		$query  = $this->db->query("EXEC spGetScheduleById '$this->ho','$id' ");
		return $query->row();
	}

	function getAllTask()
	{
		$this->db->order_by('effective_date', 'DESC');
		$query = $this->db->get('task_header');
		return $query->result();
	}

	function getTaskDetail($id)
	{
		$this->db->select('a.*,b.description,b.image,b.bobot,c.group_name,d.category_name,e.is_active');
		$this->db->join('list_item b', 'b.item_id=a.item_id');
		$this->db->join('list_group c', 'c.group_id=b.group_id');
		$this->db->join('list_category d', 'd.category_id=b.category_id');
		$this->db->join('task_header e', 'e.task_id=a.task_id');
		$this->db->where('a.task_id', $id);
		$this->db->order_by('b.group_id, a.seq');
		$query = $this->db->get('task_detail a');
		return $query->result();
	}

	function countBobotList($id)
	{
		$this->db->select('ISNULL(SUM(b.bobot),0) AS jumlah');
		$this->db->join('list_item b', 'b.item_id=a.item_id');
		$this->db->where('a.task_id', $id);
		$query = $this->db->get('task_detail a');
		return $query->row();
	}

	function getReportTraffic()
	{
		$query  = $this->db->query("EXEC Report_Traffic");
		return $query->result();
	}

	function cronCreateSchedule()
	{
		$name = date('M Y');
		$period = date('Ym');
		$query  = $this->db->query("EXEC Cron_CreateSchedule '$name','$period'");
		return $query->result();
	}

	function fcGetScheduleNumber()
	{
		$query  = $this->db->query("SELECT dbo.fcGetScheduleNumber() AS schedule_number");
		return $query->row();
	}

	function insertScheduleHeader($object)
	{
		$this->db->insert("schedule_header", $object);
	}

	function validSchedule($xml)
	{
		$query  = $this->db->query("EXEC dbo.spValidSchedule '$xml'");
		return $query->row();
	}

	function validScheduleIns($schedulenumber, $kode, $visitdate, $visithour)
	{
		$query  = $this->db->query("EXEC dbo.spValidScheduleIns $schedulenumber,'$kode', '$visitdate','$visithour'");
		return $query->row();
	}

	function getScheduleByPeriod($nik, $period){
		$this->db->where('nik', $nik);
		$this->db->where('period', $period);
		$query = $this->db->get('schedule_header');
		return $query->row();
	}
}

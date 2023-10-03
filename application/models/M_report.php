<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_report extends CI_Model
{
	private $ho = DB_HO;

	function viewPerformance($nik, $toko, $jenis)
	{
		$query  = $this->db->query("EXEC dbo.Report_Performance '$nik','$toko', '$jenis'");
		return $query->result();
	}
	function viewPerformance2($nik, $toko, $jenis, $awl, $akh)
	{
		$query  = $this->db->query("EXEC dbo.Report_Performance2 '$nik','$toko', '$jenis','$awl','$akh'");
		return $query->result();
	}

	function syncReport($jenis)
	{
		$query  = $this->db->query("EXEC dbo.Report_Sync '$jenis'");
		return $query->row();
	}
}

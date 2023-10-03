<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_ac extends CI_Model {
	private $ho = DB_HO;
	function getLogin($nik, $password, $token) {
		$query = $this->db->query("EXEC dbo.spGetLogin '$nik','$password','$token'");
		return $query->row();
	}
	
	function crypto($key, $strvalue){
		$signature =  hash_hmac("sha1", $strvalue, $key, FALSE);
		return $signature;
	}
	
	function setRegister($nik, $password, $token, $imei, $device) {
		$query = $this->db->query("EXEC dbo.spSetRegister '$nik','$password','$token','$imei','$device'");
		return $query->row();
	}
	
	function getByNIK($nik){
		$query  = $this->db->query("EXEC dbo.spGetByNIK '$this->ho','$nik'");
		return $query->row();
	}
	
	function viewByNIK($nik){
		$query  = $this->db->query("EXEC dbo.spGetByNIK '$this->ho','$nik'");
		return $query->result();
	}
	
	function viewSchedule($nik, $awal, $akhir){
		$query  = $this->db->query("EXEC dbo.spGetSchedule '$this->ho','$nik','$awal','$akhir'");
		return $query->result();
	}
	
	function viewReason(){
		$this->db->select('reason_id,reason_name');
		$this->db->where('is_active', 1);
		$this->db->where('status_data', 1);
		$query = $this->db->get('schedule_reason');
		return $query->result();
	}
	
	function prosesCheckin($nik, $toko, $reason, $xml){
		$query  = $this->db->query("EXEC dbo.Proses_Checkin '$nik','$toko','$reason','$xml'");
		return $query->row();
	}
	
	function newPassword($nik, $newPass){
		$this->db->where('nik', $nik);
		$this->db->update('ms_user', array('password' => md5($newPass)));
		return $this->db->affected_rows();
	}
	
	function insertEmailQueued($object){
		$query = $this->db->insert('email_queued', $object);
		return $this->db->insert_id();
	}
}

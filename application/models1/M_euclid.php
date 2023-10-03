<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_euclid extends CI_Model {
	private $rms;
	private $euclid;
	
    function __construct()
	{
		parent::__construct();
		$this->euclid = $this->load->database('euclid', TRUE);
		$this->rms = $this->load->database('rms', TRUE);

    } 
    
	function downloadData($table) {
        $this->euclid->where('tgl_download IS NULL OR tgl_update > tgl_download');
		$query  = $this->euclid->get($table);
		return $query->result();

	}
	
	function insertData($xml, $table){
		$query = $this->db->query("EXEC dbo.Insert_".$table." '$xml'");
		return $query->row();
	}
		
	function flagData($flag, $table) {
        $this->euclid->where($flag);
		$query  = $this->euclid->update($table, array('tgl_download' => date('Y-m-d H:i:s')));

	}

	function injectRMS($xml, $table){
		$query = $this->rms->query("EXEC dbo.Insert_".$table." '$xml'");
		return $query->row();
	
	}

    /* Todo in RMS HO to clean up for the first time  
    * delete from MstDcPenanggungJawab  
    * delete from MstTokoPenangungJawab 
    * delete from TblKaryawan 
    * delete from MstKaryawan 
    */
}

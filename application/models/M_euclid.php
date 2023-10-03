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
       /* $this->euclid->where('tgl_download IS NULL OR tgl_update > tgl_download');
        $this->euclid->where('datestatus is not null');
	/*$this->euclid->where('datestatus >= now()::date');*/
	$this->euclid->where("datestatus between (NOW() - interval '1 day') and now()");
	/*$this->euclid->where("datestatus between '2023-01-07 00:00:00' and now()");*/

		$query  = $this->euclid->get($table);
		return $query->result();

	}
	
	function insertData($xml, $table){
		$query = $this->db->query("EXEC dbo.Insert_".$table." '$xml'");
		return $query->row();
	}
		
	function flagData($flag, $table) {
        $this->euclid->where($flag);
		/*$query  = $this->euclid->update($table, array('tgl_download' => date('Y-m-d H:i:s')));*/
	  	$query  = $this->euclid->update($table, array('datestatus' => date('Y-m-d H:i:s')));
		/*$query  = $this->euclid->update($table, array('datestatus' => date('Y-m-d H:i:s',strtotime("-1 days"))));*/


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

<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('max_execution_time', 720);
set_time_limit(300);
require APPPATH.'/libraries/REST_Controller.php';
class Euclid extends REST_Controller {
	/*private $tbl = array(
		'smi_stguser_job' => 'MstJabatan',
		'smi_stguser_pib' => 'MstKaryawan',
		'smi_stguser_wlc' => 'MstTokoPenangungJawab'
	);*/
       private $tbl = array(
                'stguser_job' => 'MstJabatan',
                'stguser_pib' => 'MstKaryawan',
                'stguser_wlc' => 'MstTokoPenangungJawab'
        );


	function __construct()
	{
		parent::__construct();
		$this->load->model('m_euclid');
		$this->load->library('myxml');
	} 

	function index_get()
	{
		$table = $this->input->get('table');
		if (empty($table)){
			exit('Table belum didefinisikan!');
		}
		$data = $this->m_euclid->downloadData($table);
		
		if (!$data) {
			log_message('debug', 'Tidak ada data '.$table.' baru/update!'.PHP_EOL);
			exit('Tidak ada data '.$table.' baru/update!');
		}
        
        log_message('debug', $table.' Row(s) downloaded: '.count($data));
		log_message('debug', $table.' Data downloaded: '.json_encode($data).PHP_EOL);
		$i=0;
		
		foreach ($data as $dt):
			$xml = $this->myxml->Serialize_Object($dt);
			$xml = str_replace("'", "''",$xml);
			$rs = $this->m_euclid->insertData($xml, $table);
			
			if ($rs->Id != '0'){
				// Inject ke RMS
				if (isset($this->tbl[$table])){
					$row = $this->m_euclid->injectRMS($xml, $this->tbl[$table]);
					if (isset($row->Id)){
						if ($row->Id != '0'){
							log_message('debug', $table.' Data injected: '.$row->ProcessNumber.PHP_EOL);

						}else {
							log_message('debug', $table.' Error inject: '.$row->ProcessMessage.' '.$xml.PHP_EOL);
							echo $row->ProcessMessage.' '.$xml.'<br /><br />';
						}
					}else {
						log_message('debug', $table.' InjectRMS tidak ada row Id '.$xml.PHP_EOL);
						echo $table.' InjectRMS tidak ada row Id '.PHP_EOL;
					}
				}
				//Flag Euclid
				log_message('debug', $table.' Data inserted: '.$rs->ProcessNumber.PHP_EOL);
				$i++;
				$flag = json_decode($rs->ProcessNumber, TRUE);
				//$this->m_euclid->flagData($flag, $table);
				echo $rs->ProcessNumber.'<br />';
				
			}else {
				log_message('debug', $table.' Error insert: '.$rs->ProcessMessage.' '.$xml.PHP_EOL);
				echo $rs->ProcessMessage.' '.$xml.'<br /><br />';
			}

			
		endforeach;
		
		log_message('debug', $table.' Row(s) inserted: '.$i);
	}
	
	/*
		--delete from MstDcPenanggungJawab 
		delete from MstTokoPenangungJawab 
		delete from TblKaryawan 
		delete from MstKaryawan 
		
		delete from smi_stguser_wlc 
		delete from smi_stguser_pib 
		delete from smi_stguser_job 
		delete from smi_hrd_psa096s 
		delete from smi_hrd_par001s 

	
	*/
	
}




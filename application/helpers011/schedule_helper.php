<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function view_data($nik, $awal, $akhir, $id){
    $CI =& get_instance();
    //load database table
    $CI->load->model('m_inquiry');
    
	$object['schedule'] = $CI->m_inquiry->viewScheduleByNIK($nik, $awal, $akhir);
	$object['reason'] = $CI->m_inquiry->viewReason();
    
	return $object;

}

function proses_data($rest_log_id, $nik, $id, $reff, $strJson){
    $CI =& get_instance();
    
	//load database table
    $CI->load->model('m_proses');
    $CI->load->model('m_inquiry');
    $CI->load->library('myxml');
    
    log_message('debug','CREATE SCHEDULE =>'.$rest_log_id.' '.$nik.' '.$id.' '.$reff.' '.$strJson. PHP_EOL);

    
    $next_month = strtotime("+28 days", time());
    if ($id != date('Ym', $next_month)){
        $respons = array(
            'success' => FALSE,
            'message' => 'Periode harus bulan depan!'
        );
        $CI->m_proses->setHttpRespon($rest_log_id, json_encode($respons));
		$CI->response($respons, REST_Controller::HTTP_OK);
    }

    
    $dt = json_decode($strJson, TRUE);
	if ($dt){
		$xml = $CI->myxml->Serialize_Array($dt['schedule']);
		$xml = str_replace("'", "''",$xml);
        
        $rs = $CI->m_proses->createSchedule($nik, $id, $reff, $xml); 
		log_message('debug','RESULT CREATE SCHEDULE =>'. $rs->ProcessMessage.' '.$rs->ProcessNumber);
		if ($rs->Id != 0){	
			
			$data['result'] = $CI->m_inquiry->viewScheduleByNumber($rs->Id);
			$str64 = $CI->basejson->setJson($data);
			$respons = array(
                'success' => TRUE,
                'message' => $rs->ProcessMessage,
                'data' => $str64
            );		
		}else {
			$respons = array(
                'success' => FALSE,
                'message' => $rs->ProcessMessage
            );
		}
		$CI->m_proses->setHttpRespon($rest_log_id, json_encode($respons));
		$CI->response($respons, REST_Controller::HTTP_OK);
	}else{
		$respons = array(
                'success' => FALSE,
                'message' => 'Data masih kosong!'
            );
		$CI->m_proses->setHttpRespon($rest_log_id, json_encode($respons));
		$CI->response($respons, REST_Controller::HTTP_OK);
		
	}
						
}

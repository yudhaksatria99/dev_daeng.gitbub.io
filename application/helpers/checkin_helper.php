<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function proses_data($rest_log_id, $nik, $id, $reff, $strJson){
    $CI =& get_instance();
    
	//load database table
    $CI->load->model('m_proses');
	$CI->load->library('myxml');
	$CI->load->library('basejson');
	
	log_message('debug','PROSES CHECKIN =>'.$rest_log_id.' '.$nik.' '.$id.' '.$reff.' '.$strJson. PHP_EOL);
	
	$dt = json_decode($strJson, TRUE);
	if ($dt){
		$xml = $CI->myxml->Serialize_Array($dt['checkin']);
		$xml = str_replace("'", "''",$xml);
				
		$rs = $CI->m_proses->checkIn($nik, $id, $reff, $xml); 
		log_message('debug','RESULT PROSES CHECKIN =>'. $rs->ProcessMessage.' '.$rs->ProcessNumber);
		if ($rs->Id != 0){	
			
			$data['result'] = $CI->m_proses->getVisitHeader($rs->ProcessNumber);
			$str64 = $CI->basejson->setJson($data);
			$respons = array(
                'success' => TRUE,
                'message' => 'Checkin berhasil!',
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

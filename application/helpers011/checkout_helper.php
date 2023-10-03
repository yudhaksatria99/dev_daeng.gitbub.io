<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function proses_data($rest_log_id, $nik, $id, $reff, $strJson){
    $CI =& get_instance();
    
	//load database table
    $CI->load->model('m_proses');
	
	log_message('debug','PROSES CHECKOUT =>'.$rest_log_id.' '.$nik.' '.$id.' '.$reff.' '.$strJson. PHP_EOL);
    $rs = $CI->m_proses->checkOut($nik, $id, $reff); 
    log_message('debug','RESULT PROSES CHECKOUT =>'. $rs->ProcessMessage.' '.$rs->ProcessNumber);
    if ($rs->Id != 0){	
        $respons['success'] = TRUE;

    }else {
        $respons['success'] = FALSE;
    }

    $respons['message'] = $rs->ProcessMessage;
    $CI->m_proses->setHttpRespon($rest_log_id, json_encode($respons));
    $CI->response($respons, REST_Controller::HTTP_OK);
						
}

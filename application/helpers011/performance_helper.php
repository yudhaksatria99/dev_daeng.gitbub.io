<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function get_report($rest_log_id, $nik, $reff, $id){
    $CI =& get_instance();
    
    //load database table
    $CI->load->model('m_report');
    $CI->load->model('m_proses');
	
	log_message('debug','REPORT PERFORMANCE =>'.$rest_log_id.' '.$nik.' '.$id.' '.$reff. PHP_EOL);
    $rs = $CI->m_report->viewPerformance($nik, $id, strtolower($reff)); 
    
    if ($rs){	
        $data['result'] = $rs;
        $str64 = $CI->basejson->setJson($data);
        $respons = array(
            'success' => TRUE,
            'message' => 'Report performance',
            'data' => $str64
        );		
    }else {
        $respons = array(
            'success' => FALSE,
            'message' => 'Tidak ada performance!',
        );
    }
    $CI->m_proses->setHttpRespon($rest_log_id, json_encode($respons));
    $CI->response($respons, REST_Controller::HTTP_OK);
    
}

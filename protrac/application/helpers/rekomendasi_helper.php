<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function proses_data($rest_log_id, $nik, $id, $reff, $strJson){
    $CI =& get_instance();
    
	//load database table
    $CI->load->model('m_proses');
    $CI->load->model('m_inquiry');
    $CI->load->library('myxml');
    
    log_message('debug','PROSES NOTES =>'.$rest_log_id.' '.$nik.' '.$id.' '.$reff.' '.$strJson. PHP_EOL);

    $dt = json_decode($strJson, TRUE);
	if ($dt){
	
        $rs = $CI->m_proses->prosesNotes($id, $reff, $dt['rekomendasi']); 
		if ($rs){	
			
			$data['result'] = $CI->m_inquiry->visitReportByGroup($id, $reff);
			$str64 = $CI->basejson->setJson($data);
			$respons = array(
                'success' => TRUE,
                'message' => 'Notes berhasil disubmit',
                'data' => $str64
            );		
		}else {
			$respons = array(
                'success' => FALSE,
                'message' => 'Notes gagal disubmit!',
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

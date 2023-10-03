<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function view_data($nik, $awal, $akhir, $id){
    $CI =& get_instance();
    //load database table
    $CI->load->model('m_inquiry');

    $object['list_group'] = $CI->m_inquiry->viewListGroup($akhir);
    $task_id = 0;
    if (isset($object['list_group'][0]->task_id)) {
        $task_id = $object['list_group'][0]->task_id;          
    }
    $object['list_item'] = $CI->m_inquiry->viewListItem($task_id);
    
	return $object;

}


function proses_data($rest_log_id, $nik, $id, $reff, $strJson){
    $CI =& get_instance();
    
	//load database table
    $CI->load->model('m_proses');
    $CI->load->model('m_inquiry');
    $CI->load->library('myxml');
    
    log_message('debug','PROSES CHECK LIST =>'.$rest_log_id.' '.$nik.' '.$id.' '.$reff.' '.$strJson. PHP_EOL);

    $dt = json_decode($strJson, TRUE);
	if ($dt){
		$xml = $CI->myxml->Serialize_Array($dt['check_list']);
		$xml = str_replace("'", "''",$xml);
        
        $rs = $CI->m_proses->prosesCheckList($id, $reff, $xml); 
		log_message('debug','RESULT PROSES CHECK LIST =>'. $rs->ProcessMessage.' '.$rs->ProcessNumber);
		if ($rs->Id != 0){	
			
			$data['result'] = $CI->m_inquiry->visitReportByGroup($id, $reff);
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

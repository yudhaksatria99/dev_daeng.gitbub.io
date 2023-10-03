<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function get_report($rest_log_id, $nik, $dashboard_code, $id){
    $CI =& get_instance();
    $CI->load->model('m_proses');
    $CI->load->helper('log_helper');
    
    $timestamp = "".date('YmdHis').""; 	
	$signature = hash('sha256', implode('#', array(
            TABLEAU_KEY,
            strtolower($dashboard_code), 
            (int)$nik, 
            $timestamp 
        )));

    $url = TABLEAU_URL.'/api/tableau/trusted';	
    $ch = curl_init();
    // Create json
    $strJson = json_encode(
        array(
            'dashboard_code' => strtolower($dashboard_code),
            'id' => (int) $nik,
            'timestamp' => $timestamp,
            'signature' => $signature
        )
    );

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 45);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $strJson);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                                                                                                   
                 
    // write log
    $log_id = tableau_log(array(
        'rest_log_id' => $rest_log_id,
        'url' => $url,
        'http_query' => $strJson
    ));


    // Execute
    $server_output = curl_exec ($ch);
    curl_close ($ch);

    // write return
    $object = array(
        'http_return' => (string) $server_output,
        'date_updated' => date('Y-m-d H:i:s')
    );

    log_return($log_id, $object);
    $respons = array(
	'success' => TRUE,
	'message' => TABLEAU_URL.'/embed/tableau/'.strtolower($dashboard_code).'/'.$nik
     );

/*
    if ($server_output){
        try{
            $rs = json_decode($server_output);
            if (isset($rs->token)){
                $respons = array(
                    'success' => TRUE,
                    'message' => TABLEAU_URL.'/embed/tableau/'.strtolower($dashboard_code).'/'.$nik.'/'.$rs->token
                );
            }else {
                if (isset($rs->error)){
                    $respons = array(
                        'success' => FALSE,
                        'message' => 'Error di server report! '.$rs->error
                    );
                }else {
                    $respons = array(
                        'success' => FALSE,
                        'message' => 'Unknow error!'
                    );
                }
            }
        }catch(Throwable $e){
            log_message('debug',$rest_log_id.' '.$e->getMessage().PHP_EOL);
            $respons = array(
                'success' => FALSE,
                'message' => $e->getMessage()
            );
        } 

    }else {
        $respons = array(
            'success' => FALSE,
            'message' => 'Tidak mendapat respon dari server report!'
        );
    }
*/
    $CI->m_proses->setHttpRespon($rest_log_id, json_encode($respons, JSON_UNESCAPED_SLASHES));
    $CI->response($respons, REST_Controller::HTTP_OK);

}


function get_jenis_report(){
	print '<label>Start '.date('Y-m-d H:i:s').'</label>';
	print '<br />';
	
    $CI =& get_instance();
    $CI->load->model('m_report');
	
    $url = TABLEAU_URL.'/api/tableau/list';	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 45);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                                                                                                   
                 
    $server_output = curl_exec ($ch);
    curl_close ($ch);
	
	print '<code>';		
    if ($server_output){
        try{
            $rs = json_decode($server_output);
            if ($rs){
				foreach($rs as $r):
					$CI->m_report->syncReport($r);
					print $r.'<br />';
				endforeach;
				
            }else {
               print 'No data found!';
            }
        }catch(Throwable $e){
			print $e->getMessage();
        } 

    }else {
        print 'Cannot connect to '.$url;
    }
	print '</code>';		
    
	print '<br />';
	print '<label>End '.date('Y-m-d H:i:s').'<label>';
}

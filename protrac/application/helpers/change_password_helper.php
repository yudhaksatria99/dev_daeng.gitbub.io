<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function proses_data($rest_log_id, $nik, $id, $reff, $strJson){
    $CI =& get_instance();
    
	//load database table
    $CI->load->model('m_proses');
    $CI->load->model('m_inquiry');
    $CI->load->library('myxml');
    
    log_message('debug','PROSES CHANGE PASSWORD =>'.$rest_log_id.' '.$nik.' '.$id.' '.$reff.' '.$strJson. PHP_EOL);
    if ($nik == $id){    
        $rs = $CI->m_proses->changePassword($nik, $reff); 
        if ($rs){	

            $data['register'] = $CI->m_ac->viewByNIK($nik);
            if ($data){	
                $str64 = $CI->basejson->setJson($data);
                $respons = array(
                    'success' => TRUE,
                    'message' => 'Berhasil ganti password',
                    'data' => $str64
                );
            }else {
                $respons = array(
                    'success' => FALSE,
                    'message' => 'User tidak aktif!',
                );
            }	
        }else {
            $respons = array(
                'success' => FALSE,
                'message' => 'Gagal ganti password!',
            );
        }
        $CI->m_proses->setHttpRespon($rest_log_id, json_encode($respons));
        $CI->response($respons, REST_Controller::HTTP_OK);
   
    }else {
        $respons = array(
            'success' => FALSE,
            'message' => 'NIK tidak sesuai!',
        );
    
        $CI->m_proses->setHttpRespon($rest_log_id, json_encode($respons));
        $CI->response($respons, REST_Controller::HTTP_OK);
    }
                            
}

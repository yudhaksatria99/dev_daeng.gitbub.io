<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function view_data($nik, $awal, $akhir, $id){
    $CI =& get_instance();
    //load database table
    $CI->load->model('m_ac');
	$CI->load->model('m_proses');

	$rest_log_id = $awal;
    $rs = $CI->m_ac->getByNIK($nik);
    if ($rs){
		$nama = ucfirst(strtolower($rs->nama));
		$email = $rs->email;
		$token = $rs->token;
		$password = $id;
		
		require_once(VIEWPATH.'forgot_password.php');			
		$obj = array(
			'to' => $email,
			'subject' => 'Password Requested',
			'body' => $body
		);
		$CI->m_ac->insertEmailQueued($obj);
		
		$respons = array(
			'success' => TRUE,
			'message' => 'Password telah dikirim ke '.$email
		);
		
	}else{
		$respons = array(
			'success' => FALSE,
			'message' => 'Tidak ada data user!'
		);		
	}
	$CI->m_proses->setHttpRespon($rest_log_id, json_encode($respons));
	$CI->response($respons, 200);			
}

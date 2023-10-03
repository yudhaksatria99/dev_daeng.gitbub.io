<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function view_data($nik, $awal, $akhir, $id){
    $CI =& get_instance();
    //load database table
    $CI->load->model('m_inquiry');

    $object['banner'] = $CI->m_inquiry->viewBanner();
	return $object;

}

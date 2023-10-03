<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function tableau_log($object = null ){
    $CI =& get_instance();

    //load database table
    $CI->load->library('mycrud', array('tblname' => 'tableau_log'));
 
    //save to database
    $id = $CI->mycrud->createData($object);
    return $id;
}


function log_return($id = null, $object = null){
    $CI =& get_instance();

     //load database table
     $CI->load->library('mycrud', array('tblname' => 'tableau_log'));
 
     //update table
     $id = $CI->mycrud->updateData('id', $id, $object);

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_queued extends CI_Model {

	function getQueued() {
        $this->db->where('status_data', 1);
        $this->db->order_by('date_created', 'ASC');
		$query  = $this->db->get('email_queued');
		return $query->row();

	}
	
    function updateQueued($id, $obj){
        $this->db->where('id', $id);
        $this->db->update('email_queued', $obj);
        return $this->db->affected_rows();
    }
}

<?php
class M_feedback extends CI_Model
{
    public function search_toko($kodetoko)
    {
        return $this->db->query("SELECT * FROM smi_hrd_psa096s Where subarea = '" . $kodetoko . "' ")->result();
    }

    public function insert_form($data)
    {
        return $this->db->insert('feedback', $data);

    }
    public function updatevisit($visit)
    {
        $this->db->query("update visit_header set form_feedback=1 where visit_id = '" . $visit . "' ");
    }

    public function search_feedback($visit)
    {
        return $this->db->query("SELECT * FROM feedback Where visit_id = '" . $visit . "' ")->result();
    }

    public function search_visitid($visit, $kodetoko)
    {
        return $this->db->query("SELECT * FROM visit_header Where visit_id = '" . $visit . "' and toko = '" . $kodetoko . "'")->result();
    }

}
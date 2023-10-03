<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class APIFeedback extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        //Load CRUD Library
        $this->load->library('mycrud', array('tblname' => 'feedback'));
        $this->load->model('M_feedback');

    }

    // Insert Data
    function add_post()
    {

        if (!$this->post('nik')) {
            $this->response(array('success' => FALSE, 'message' => 'NIK masih kosong'), 200);
        }

        if (!$this->post('nama')) {
            $this->response(array('success' => FALSE, 'message' => 'Nama masih kosong'), 200);
        }

        if (!$this->post('note')) {
            $this->response(array('success' => FALSE, 'message' => 'Note masih kosong'), 200);
        }

        $data = array(
            'visit_id' => $this->post('visit'),
            'nama_cabang' => $this->post('nama_cabang'),
            'kodetoko' => $this->post('kodetoko'),
            'nik' => $this->post('nik'),
            'nama' => $this->post('nama'),
            'komunikasi' => $this->post('komunikasi'),
            'keamanan' => $this->post('keamanan'),
            'keterampilan' => $this->post('keterampilan'),
            'kerapihan' => $this->post('kerapihan'),
            'note' => $this->post('note'),
            'created_date' => date('Y-m-d H:i:s')
        );

        $visit = $this->post('visit');
        // print_r($visit);
        // die();

        if ($this->M_feedback->insert_form($data)) {

            // success
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">We received your feedback! Will get back to you shortly!!!</div>');

            $this->M_feedback->updatevisit($visit);
            redirect('FormFeedback/view_success');
        } else {
            // error
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Oops! Some Error.  Please try again later!!!</div>');
            redirect('FormFeedback/view_error');
        }


    }

    function add_success()
    {

        $this->session->unset_userdata('kodetoko');
        $this->load->view('form_feedback/view_success');
    }

    function view_get()
    {

        $rs = $this->mycrud->readData();
        if ($rs) {
            $this->response($rs, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'success' => FALSE,
                'message' => 'No data were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

    }


}
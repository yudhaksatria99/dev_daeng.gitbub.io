<?php defined('BASEPATH') or exit('No direct script access allowed');

class FormFeedback extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();
        $this->data['active'] = 'feedback';
        $this->load->model('M_feedback');
        $this->load->library('session');

    }

    function add()
    {
        if (empty($_GET['visit'])) {
            // no data passed by get
            $this->load->view('form_feedback/view_error');

        } else if (empty($_GET['kodetoko'])) {

            $this->load->view('form_feedback/view_error');
        } else {

            $visit = $_GET['visit'];
            $kodetoko = $_GET['kodetoko'];

            $getvisit = $this->M_feedback->search_feedback($visit);

            if (!empty($getvisit)) {

                $this->load->view('form_feedback/view_done');

            } else {

                $visit_id = $this->M_feedback->search_visitid($visit, $kodetoko);

                if (!empty($visit_id)) {

                    $this->data['kodetoko'] = $kodetoko;
                    $this->data['visit'] = $visit;
                    $datatoko = $this->M_feedback->search_toko($kodetoko);

                    if (!$datatoko) {


                        $this->load->view('form_feedback/view_error');

                    } else {
                        $this->data['par_area'] = $datatoko[0]->par_area;

                        $this->add_success();

                    }
                } else {

                    $this->load->view('form_feedback/view_error');
                }
            }

        }
    }

    function add_success()
    {
        $this->load->view('form_feedback/add_feedback', $this->data);

    }



    function view_success()
    {
        $this->load->view('form_feedback/view_success');

    }
    function view_error()
    {

        $this->load->view('form_feedback/view_error');

    }


}
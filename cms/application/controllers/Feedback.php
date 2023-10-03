<?php defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();
        // $this->data['admin'] = checkLogin();
        $this->data['active'] = 'feedback';
        $this->load->model('M_feedback');
        $this->load->library('session');
        $this->data['admin'] = checkLogin();
    }

    function index()
    {
        $jb = $this->session->userdata('jabatan');
        if (!$jb) {
            checkLogin();
        } else {
            if ($jb !== 'SUPERUSER')
                show_404();
        }

        $this->load->view('sidebar', $this->data);
        $this->load->view('feedback/view_feedback', $this->data);
        $this->load->view('foot', $this->data);
    }

    // function add()
    // {
    //     $visit = $_GET['visit'];
    //     $kodetoko = $_GET['kodetoko'];

    //     $this->data['kodetoko'] = $kodetoko;
    //     $this->data['visit'] = $visit;
    //     $data1 = $this->M_feedback->search_toko($kodetoko);


    //     if (!$data1) {

    //         $this->load->view('feedback/view_error');

    //     } else {

    //         $this->load->view('feedback/add_feedback', $this->data);
          
    //     }
    // }

    // function add_success()
    // {

    //     // $hasil = $this->load->view('feedback/add_feedback', $this->data);
    //     $this->load->view('feedback/view_success');
    //     // $this->session->unset_userdata('kodetoko');
    //     // $this->load->view('js_form');
    //     // $hasil = $this->result['success'] = 'true';
    //     // print_r($hasil);
    //     // die();
    //     // $this->load->view('login');
    // }



}
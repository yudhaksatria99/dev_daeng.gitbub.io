<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Otherapp extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();
        $this->data['admin'] = checkLogin();
        $this->data['active'] = 'otherapp';
    }

    function index()
    {
        $jb = $this->session->userdata('jabatan');
        if (!$jb) {
            checkLogin();
        } else {
            if ($jb !== 'SUPERUSER') show_404();
        }
        $this->load->view('sidebar', $this->data);
        $this->load->view('otherapp/view_otherapp', $this->data);
        $this->load->view('foot', $this->data);
    }

    function add()
    {

        $this->load->view('otherapp/add_otherapp', $this->data);
        $this->load->view('js_form');
    }

    function edit($id = null)
    {

        $this->load->library('mycrud', array('tblname' => 'list_Otherapp'));
        $this->data['otherapp'] = $this->mycrud->getById('id', $id);

        $this->load->view('otherapp/edit_otherapp', $this->data);
        $this->load->view('js_form');
    }
}

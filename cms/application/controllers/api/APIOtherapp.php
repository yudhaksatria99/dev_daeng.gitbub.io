<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
require APPPATH . '/libraries/REST_Controller.php';
class APIOtherapp extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('image');
        //Load CRUD Library
        $this->load->library('mycrud', array('tblname' => 'list_Otherapp'));
    }


    // Insert Data
    function add_post()
    {
        if (!$this->post('judul')) {
            $this->response(array('success' => FALSE, 'message' => 'Nama aplikasi masih kosong'), 200);
        }
        if (!$this->post('link')) {
            $this->response(array('success' => FALSE, 'message' => 'Link aplikasi masih kosong'), 200);
        }

        $object = array(
            'judul' => $this->post('judul'),
            'link' => $this->post('link'),
            'nik' => $this->post('nik'),
            'password' => $this->post('password'),
            'store' => $this->post('store'),
            'suffix' => $this->post('suffix'),
            'is_active' =>  $this->post('is_active'),
            'date_updated' => date('Y-m-d H:i:s')
        );

        // IMAGE
        $image_source = basename($_FILES['iconx']['name']);
        $imageFileType = pathinfo($image_source, PATHINFO_EXTENSION);

        // Allow certain file formats
        if (
            $imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
            || $imageFileType == "gif"
        ) {

            $dir = FCPATH . 'uploads/';

            $target_file = $dir . 'original/' . $image_source;

            if (move_uploaded_file($_FILES['iconx']['tmp_name'], $target_file)) {

                $image_name = 'otherapp_' . rand() . '.' . $imageFileType;
                image_resize($target_file, $dir . '512/', $image_name, 512, 256);
                image_resize($target_file, $dir . '150/', $image_name, 150, 75);

                $object['path_img'] = $image_name;
            } else {
                $this->response(array('success' => FALSE, 'message' => 'File tidak dapat diupload!'), 200);
            }
        } else {
            $this->response(array('success' => FALSE, 'message' => 'File ' . $image_source . ' bukan format image!'), 200);
        }

        $rs = $this->mycrud->createData($object);
        if ($rs) {
            $this->response(array('success' => TRUE, 'message' => 'Berhasil disimpan!'), 200);
        } else {
            $this->response(array('success' => FALSE, 'message' => 'Gagal disimpan!'), 200);
        }
    }



    // Edit Data
    function edit_post()
    {
        $object = array(
            'judul' => $this->post('judul'),
            'link' => $this->post('link'),
            'nik' => $this->post('nik'),
            'password' => $this->post('password'),
            'store' => $this->post('store'),
            'suffix' => $this->post('suffix'),
            'is_active' => $this->post('is_active'),
            'date_updated' => date('Y-m-d H:i:s')
        );

        // IMAGE
        $image_source = basename($_FILES['iconx']['name']);
        $imageFileType = pathinfo($image_source, PATHINFO_EXTENSION);

        // Allow certain file formats
        if (
            $imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
            || $imageFileType == "gif"
        ) {

            $dir = FCPATH . 'uploads/';

            $target_file = $dir . 'original/' . $image_source;

            if (move_uploaded_file($_FILES['iconx']['tmp_name'], $target_file)) {

                $image_name = 'otherapp_' . rand() . '.' . $imageFileType;
                image_resize($target_file, $dir . '512/', $image_name, 512, 256);
                image_resize($target_file, $dir . '150/', $image_name, 150, 75);

                $object['path_img'] = $image_name;
            } 
        } 

        $id = $this->mycrud->updateData('id', $this->post('id'), $object);
        if (!empty($id)) {
            $this->response(array('success' => TRUE, 'message' => 'Edit berhasil!'), 200);
        } else {
            $this->response(array('success' => FALSE, 'message' => 'Data tidak bisa diedit'), 200);
        }
    }


    // View Data
    function view_get()
    {

        $rs = $this->mycrud->readData();
        if ($rs) {
            // Set the response and exit
            $this->response($rs, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'success' => FALSE,
                'message' => 'No data were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
}

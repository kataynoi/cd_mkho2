<?php

class Upload extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('upload_model');
    }

    function index()
    {
        $this->load->view('test/index_view');
    }


    function do_upload_user_images()
    {
        $config['upload_path'] = './assets/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['encrypt_name'] = TRUE;
        $config['max_size'] = 10240;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $config['file_name'] = $this->session->userdata('id');

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("file")) {
            $data = array('upload_data' => $this->upload->data());

            $title = $this->input->post('title');
            $image = $data['upload_data']['file_name'];

            $result = $this->upload_model->save_upload($title, $image);
            echo json_encode($result);
        }

    }

    function do_upload_file()
    {

        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|xls|xlsx|gif|jpg|png';
        //$config['encrypt_name'] = TRUE;
        $config['max_size'] = 10240;
        //$config['max_width'] = 1024;
        //$config['max_height'] = 768;

        $config['file_name'] = $this->session->userdata('id') . '_' . date("YmdHis");
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload("file")) {
            $error = array('error' => $this->upload->display_errors());
            console_log($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];
            //$result= $this->upload_model->save_upload($title,$image);

        }
        $json = '{"success": true, "file": "'.$image.'"}';

        render_json($json);
    }

}
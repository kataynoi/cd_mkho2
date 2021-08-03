<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report2 extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

        $this->layout->setHeader('layout/header_comeback');
        $this->layout->setLayout('comeback_layout');
        $this->load->model('Report2_model', 'crud');
    }

    public function index()
    {
        $data[] = '';

        $this->layout->view('reports/report2', $data);
    }


    function fetch_report2()
    {
        $id = $this->input->post('param1');
        $fetch_data = $this->crud->make_datatables($id);
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
            $sub_array[] = to_thai_date($row->date_input);
            $sub_array[] = $row->all_record;
            $sub_array[] = $row->RT_PCR;
            $sub_array[] = $row->AntigenTest;
            $sub_array[] = $row->no_resule;
            
            $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function  get_report2()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_report2($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}
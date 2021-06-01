<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Org_vaccine extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('print_layout');
        $this->load->model('Org_vaccine_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        
        $this->layout->view('reports/org_vaccine', $data);
    }


    function fetch_org_vaccine()
    {
        $id = $this->input->post('param1');
        $fetch_data = $this->crud->make_datatables($id);
        $data = array();
        $no=0;
        foreach ($fetch_data as $row) {

            $no++;
            $sub_array = array();
                $sub_array[] = $no;
                $sub_array[] = $row->username;
                $sub_array[] = $row->org_name;
                $sub_array[] = $row->vaccine;
                $data[] = $sub_array;
        }
        $output = array(
            "data" => $data
        );
        echo json_encode($output);
    }

    public function  get_org_vaccine()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_org_vaccine($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
}
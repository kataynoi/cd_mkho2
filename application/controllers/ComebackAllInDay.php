<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComebackAllInDay extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

                
        $this->layout->setHeader('layout/header_comeback');
        $this->layout->setLayout('comeback_layout');
        $this->load->model('AllInDay_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        
        $this->layout->view('reports/AllInDay', $data);
    }


    function fetch_AllInDay()
    {
        $input_date = to_mysql_date($this->input->post('input_date'));
        $fetch_data = $this->crud->make_datatables($input_date);
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
                $sub_array['DateNow'] = to_thai_date($row->DateNow);
                $sub_array['total'] = $row->total;
                $sub_array['newInDay'] = $row->newInDay;
                $sub_array['PcrAll'] = $row->PcrAll;
                $sub_array['PcrInDay'] = $row->PcrInDay;
                $sub_array['AgAll'] = $row->AgAll;
                $sub_array['AgInday'] = $row->AgInday;
                $sub_array['NoResult'] = $row->NoResult;
                $sub_array['NoResultInday'] = $row->NoResultInday;
                $sub_array['OnBed'] = $row->OnBed;
                $sub_array['OnBedInday'] = $row->OnBedInday;
                $sub_array['QueueBed'] = $row->QueueBed;
                $sub_array['QueueBedInday'] = $row->QueueBedInday;
                $sub_array['Quarantine'] = $row->Quarantine;
                $sub_array['QuarantineInday'] = $row->QuarantineInday;
                $data[] = $sub_array;
        }
        $rows = json_encode($data);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }

    public function  get_AllInDay()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_AllInDay($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
}
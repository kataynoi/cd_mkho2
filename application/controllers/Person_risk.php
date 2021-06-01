<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_risk extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata("login"))
            redirect(site_url("user/login"));
        $this->load->model('Person_risk_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["chq_status"] = $this->crud->get_chq_status();
        $this->layout->view('person_risk/index', $data);
    }
    public function add_person_risk()
    {
        $data[] = '';
        $data["crisk_type"] = $this->crud->get_crisk_type();
        $data["crisk_group"] = $this->crud->get_crisk_group();
        $data["cnation"] = $this->crud->get_cnation();
        $data["cchangwat"] = $this->crud->get_cchangwat();
        $data["chq_status"] = $this->crud->get_chq_status();
        $this->layout->view('person_risk/add_person_risk', $data);
    }


    function fetch_person_risk()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
            $sub_array[] = $row->id;
            $sub_array[] = $row->cid;
            $sub_array[] = $row->risk_type;
            $sub_array[] = $row->risk_group;
            $sub_array[] = $row->risk_place;
            $sub_array[] = $row->risk_event;
            $sub_array[] = $row->from_country;
            $sub_array[] = $row->tel;
            $sub_array[] = $row->province;
            $sub_array[] = $row->ampur;
            $sub_array[] = $row->tambon;
            $sub_array[] = $row->moo;
            $sub_array[] = $row->no;
            $sub_array[] = $row->date_throatswab;
            $sub_array[] = $row->throatswab_sesult;
            $sub_array[] = $row->hq_province;
            $sub_array[] = $row->hq_ampur;
            $sub_array[] = $row->hq_tambon;
            $sub_array[] = $row->hq_moo;
            $sub_array[] = $row->hq_no;
            $sub_array[] = $row->hq_startdate;
            $sub_array[] = $row->hq_enddate;
            $sub_array[] = $row->hq_status;
            $sub_array[] = '<div class="btn-group pull-right" role="group" >
                <button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' . $row->id . '"><i class="fa fa-eye"></i></button>
                <button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' . $row->id . '"><i class="fa fa-edit"></i></button>
                <button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data(),
            "recordsFiltered" => $this->crud->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_person_risk()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_person_risk($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_person_risk()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_person_risk($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_person_risk($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_person_risk()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_person_risk($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}
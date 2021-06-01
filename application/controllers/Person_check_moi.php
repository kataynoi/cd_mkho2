<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_check_moi extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Person_check_moi_model', 'crud');
    }

    public function login()
    {
        if ($this->session->userdata("login"))
            redirect(site_url('person_check_moi/'));
        $this->layout->view('person_check_moi/login');
    }

    public function index()
    {
        if (!$this->session->userdata("login"))
            redirect(site_url('person_check_moi/login'));
        $data[] = '';
        //$data["cnation"] = $this->crud->get_cnation();
        //$data["cchangwat"] = $this->crud->get_cchangwat();
        //$data["cchangwat"] = $this->crud->get_cchangwat();
       // $data["campur"] = $this->crud->get_campur();
        //$data["ctambon"] = $this->crud->get_ctambon();
        $this->layout->view('person_check_moi/index', $data);
    }


    function fetch_person_check_moi()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
            $sub_array[] = $row->id;
            $sub_array[] = $row->cid;
            $sub_array[] = $row->name;
            $sub_array[] = $row->lname;
            $sub_array[] = $row->tel;
            $sub_array[] = $row->from_nation;
            $sub_array[] = $row->from_province;
            $sub_array[] = $row->date_in;
            $sub_array[] = $row->to_province;
            $sub_array[] = $row->to_ampur;
            $sub_array[] = $row->to_tambon;
            $sub_array[] = $row->to_village;
            $sub_array[] = $row->address;
            $sub_array[] = $row->in_home;
            $sub_array[] = $row->risk_1;
            $sub_array[] = $row->risk_2;
            $sub_array[] = $row->risk_3;
            $sub_array[] = $row->risk_4;
            $sub_array[] = $row->reporter;
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

    public function del_person_check_moi()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_person_check_moi($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_person_check_moi()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_person_check_moi($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_person_check_moi($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_person_check_moi()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_person_check_moi($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}
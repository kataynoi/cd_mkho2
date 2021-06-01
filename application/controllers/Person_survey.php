<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_survey extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();


        $this->load->model('Person_survey_model', 'crud');
        $this->user_id = $this->session->userdata('id');
    }

    public function index()
    {
        if (!$this->session->userdata("login_mobile"))
            redirect(site_url("person_survey/login"));
        $data[] = '';
        $data["cnation"] = $this->crud->get_cnation();
        //$data["cvillage"] = $this->crud->get_cvillage();
        //$data["ctambon"] = $this->crud->get_ctambon();
        $data["campur"] = $this->crud->get_campur();
        $data["cchangwat"] = $this->crud->get_cchangwat();
        $this->layout->view('person_survey/index', $data);
    }
    public function login()
    {

        if ($this->session->userdata("login_mobile"))
            redirect(site_url('person_survey/'));
        $this->layout->view('person_survey/login');
    }

    public function add_person_survey()
    {
        $data[] = '';
        $data["cnation"] = $this->crud->get_cnation();
        //$data["cvillage"] = $this->crud->get_cvillage();
        //$data["ctambon"] = $this->crud->get_ctambon();
        $data["campur"] = $this->crud->get_campur();
        $data["cchangwat"] = $this->crud->get_cchangwat();
        $this->layout->view('person_survey/add_person_survey', $data);
    }

    public function get_person_by_cid()
    {
        $cid = $this->input->post('cid');
        if($this->crud->check_person_cid($cid) >=1){
            $json = '{"success": true,"check":true}';
        }else{
            $rs = $this->crud->get_person_cid($cid);
            if($rs){
                
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
            }else{
                $json = '{"success": true, "check": false}';
            }

        }

        render_json($json);
    }


    function fetch_person_survey()
    {
        $fetch_data = $this->crud->make_datatables($this->user_id);
        $data = array();
        $no = 0;
        foreach ($fetch_data as $row) {

            $no++;
            $sub_array = array();
            $sub_array[] = $no;
            $sub_array[] = to_thai_date_time($row->d_update);
            $sub_array[] = $row->cid;
            $sub_array[] = $row->name;
            $sub_array[] = to_thai_date_short($row->date_in);
            $sub_array[] = get_province_name($row->from_province);
            $sub_array[] = $row->moo;
            $sub_array[] = $row->tambon;
            $sub_array[] = $row->ampur;
            $sub_array[] = '<div class="btn-group pull-right" role="group" >
                <button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' . $row->id . '"><i class="fa fa-eye"></i></button>
                <button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' . $row->id . '"><i class="fa fa-edit"></i></button>
                <button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button></div>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data($this->user_id),
            "recordsFiltered" => $this->crud->get_filtered_data($this->user_id),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_person_survey()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_person_survey($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_person_survey()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_person_survey($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_person_survey($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_person_survey()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_person_survey($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}
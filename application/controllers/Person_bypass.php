<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_bypass extends CI_Controller
{
    public $user_id;
    public $check_point;

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata("checkpoint")!=1){
            redirect(site_url("/user/login"));
        }

        $this->load->model('Person_bypass_model', 'crud');
        $this->check_point = $this->session->userdata('id');
    }

    public function index()
    {
        $data[] = '';
        $data["cchangwat"] = $this->crud->get_cchangwat();
        $this->layout->view('person_bypass/index', $data);
    }


    function fetch_person_bypass()
    {
        $fetch_data = $this->crud->make_datatables($this->check_point);
        $data = array();
        $n=0;
        $all = count($fetch_data);
        foreach ($fetch_data as $row) {

            $n ++;
            $sub_array = array();
            $sub_array[] = $n;
            $sub_array[] = $row->cid;
            //$sub_array[] = $row->trpre;
            $sub_array[] = $row->tname;
            $sub_array[] = $row->tlast;
            //$sub_array[] = $row->birth;
            $sub_array[] = $row->sex;
            //$sub_array[] = $row->addrno;
            //$sub_array[] = $row->addrmu;
            //$sub_array[] = $row->addrtb;
            $sub_array[] = $row->addrap;
            $sub_array[] = $row->addrcw;
            $sub_array[] = $row->agenow;
            $sub_array[] = $row->form." -> ".$row->to;
            $sub_array[] = to_thai_date_time($row->d_update);

            //$sub_array[] = $row->temp_check;
            //$sub_array[] = $row->temp_result;
            //$sub_array[] = $row->symtom1;
            //$sub_array[] = $row->check_point;
            $sub_array[] = '<div class="btn-group pull-right" role="group" >
                <button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' . $row->id . '"><i class="fa fa-eye"></i></button>
                <button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' . $row->id . '"><i class="fa fa-edit"></i></button>
                <button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button></div>';
            $data[] = $sub_array;

        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data($this->check_point),
            "recordsFiltered" => $this->crud->get_filtered_data($this->check_point),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_person_bypass()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_person_bypass($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_person_bypass()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_person_bypass($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_person_bypass($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_person_bypass()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_person_bypass($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}
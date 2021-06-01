<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata("login"))
            redirect(site_url("user/login"));
        $this->load->model('Person_model', 'crud');
        $this->hdc = $this->load->database('hdc', true);
    }

    public function index()
    {
        $data[] = '';

        $this->layout->view('person/index', $data);
    }


    function fetch_person()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
            //$sub_array[] = $row->HOSPCODE;
            $sub_array[] = $row->CID;
            //$sub_array[] = $row->PID;
            //$sub_array[] = $row->HID;
            //$sub_array[] = $row->PRENAME;
            $sub_array[] = $row->NAME;
            $sub_array[] = $row->LNAME;
            //$sub_array[] = $row->HN;
            $sub_array[] = get_sex($row->SEX);
            $sub_array[] = to_thai_date_short($row->BIRTH);
            /*$sub_array[] = $row->MSTATUS;
            $sub_array[] = $row->OCCUPATION_OLD;
            $sub_array[] = $row->OCCUPATION_NEW;
            $sub_array[] = $row->RACE;
            $sub_array[] = $row->NATION;
            $sub_array[] = $row->RELIGION;
            $sub_array[] = $row->EDUCATION;
            $sub_array[] = $row->FSTATUS;
            $sub_array[] = $row->FATHER;
            $sub_array[] = $row->MOTHER;
            $sub_array[] = $row->COUPLE;
            $sub_array[] = $row->VSTATUS;
            $sub_array[] = $row->MOVEIN;
            $sub_array[] = $row->DISCHARGE;
            $sub_array[] = $row->DDISCHARGE;
            $sub_array[] = $row->ABOGROUP;
            $sub_array[] = $row->RHGROUP;
            $sub_array[] = $row->LABOR;
            $sub_array[] = $row->PASSPORT;*/
            $sub_array[] = $row->TYPEAREA;
           /* $sub_array[] = $row->D_UPDATE;
            $sub_array[] = $row->check_hosp;
            $sub_array[] = $row->check_typearea;
            $sub_array[] = $row->vhid;*/
            $sub_array[] = get_address($row->check_vhid);
            //$sub_array[] = $row->maininscl;
           // $sub_array[] = $row->inscl;
            $sub_array[] = $row->age_y;
            //$sub_array[] = $row->addr;
            //$sub_array[] = $row->home;
            //$sub_array[] = $row->TELEPHONE;
            //$sub_array[] = $row->MOBILE;
            $sub_array[] = '<div class="btn-group pull-right" role="group" >
                <button class="btn btn-outline btn-warning" data-btn="btn_symptom" data-id="' . $row->CID . '"><i class="fa fa-save"></i>บันทึกอาการ</button>
                <button class="btn btn-outline btn-warning" data-btn="btn_add_risk" data-id="' . $row->CID . '"><i class="fa fa-save"></i>บันทึกข้อมูลเพิ่มเติม</button>
                <button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' . $row->CID . '"><i class="fa fa-edit"></i></button>
                <button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' . $row->CID . '"><i class="fa fa-trash"></i></button></div>';
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

    public function del_person()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_person($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_person()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_person($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_person($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_person()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_person($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
    public  function search_person_hdc (){

        $search_type =  $this->input->post('search_type');
        $txt_search = $this->input->post('txt_search');
        // console_log($search_type." + ".$txt_search);
        if($search_type=='cid'){
            $rs = $this->crud->getPerson_by_cid($txt_search);
        }else if($search_type=='name'){
            $rs = $this->crud->getPerson_by_name($txt_search);
        }

        if($rs)
        {
            $arr_result = array();
            foreach($rs as $r)
            {
                $obj = new stdClass();
                $obj->CID           = $r->CID;
                $obj->NAME          = $r->NAME;
                $obj->LNAME         = $r->LNAME;
                $obj->BIRTH         = to_thai_date_short($r->BIRTH);
                $obj->age_y         = $r->age_y;
                $obj->VHID         = $r->check_vhid;
                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            //$rows = json_encode($rs);
            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else{
            $json = '{"success": false, "msg": "ไม่มีข้อมูล."}';
        }
        render_json($json);
    }

    public function import_person(){
        $cid = $this->input->post('cid');

        $rs=$this->crud->import_person($cid);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
}
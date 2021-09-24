<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whitelist_student extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();    
        $this->layout->setLayout('print_layout');
        $vaccine = $this->load->database('vaccine', TRUE);
       $this->load->model('Whitelist_student_model', 'crud');
        $this->load->model('basic_model', 'basic');
    }

    public function index()
    {
        //if(!$this->session->userdata("hospital_login"))
        //redirect(site_url("user/login_hospital"));
        $data[] = '';
       
        $this->layout->view('whitelist_student/index', $data);
    }
    public function set_org()
    {
        $data["campur"] = $this->crud->get_campur();
        $data["org"] = $this->crud->get_org($this->session->userdata('id'));
        
        $this->layout->view('whitelist_student/set_org',$data);
    }
    public function add_whitelist()
    {
        //$data["campur"] = $this->crud->get_campur();
        $data["cchangwat"] = $this->crud->get_cchangwat();
        $data["chospmain"] = $this->crud->get_hospmain();
        $this->layout->view('whitelist_student/add_whitelist',$data);
    }

    function fetch_whitelist_student()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {
            $vaccine="";
            if($row->vaccine==1){
                $vaccine="<span><i class='fa fa-check-circle' style='color:green;'></i><span>";
            }else{
                $vaccine="<span><i class='fa fa-times-circle' style='color:red;'></i><span>";
            }
            $sub_array = array();
                $sub_array[] =$vaccine;
                $sub_array[] = $row->hospcode;
                $sub_array[] = substr($row->cid,0,10)."xxx";
                $sub_array[] = $row->prename;
                $sub_array[] = $row->name;
                $sub_array[] = $row->lname;
                $sub_array[] = $row->sex;
                $sub_array[] = $row->tel;
               
                $sub_array[] = '<div class="btn-group pull-right" role="group" >
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

    public function del_whitelist_student(){
        $id = $this->input->post('id');

        $rs=$this->crud->del_whitelist_student($id);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_whitelist_student()
    {
            $data = $this->input->post('items');
            if($data['action']=='insert'){
                $rs=$this->crud->save_whitelist_student($data);
                if($rs){
                    $json = '{"success": true,"id":'.$rs.'}';
                  }else{
                    $json = '{"success": false}';
                  }
            }else if($data['action']=='update'){
                $rs=$this->crud->update_whitelist_student($data);
                    if($rs){
                        $json = '{"success": true}';
                    }else{
                        $json = '{"success": false}';
                    }
            }

            render_json($json);
        }
        public function  save_org()
        {
                $data = $this->input->post('items');
                
                    $rs=$this->crud->update_org($data);
                        if($rs){
                            $this->session->set_userdata("fullname",$data['org_name']);
                            $json = '{"success": true}';
                        }else{
                            $json = '{"success": false}';
                        }
                
    
                render_json($json);
            }
    public function  get_whitelist_student()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_whitelist_student($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
    public function get_student_by_cid()
    {
        $cid = $this->input->post('cid');
        if ($this->crud->check_vaccine($cid) >= 1) {
            $json = '{"success": true,"check_vaccine":true}';
        } else if ($this->crud->check_student_cid($cid) >= 1) {
            $json = '{"success": true, "check":true}';
        } else {
            $rs = $this->crud->get_student_cid($cid);
            $rs->PRENAME = get_prename($rs->PRENAME);
            $rs->BIRTH = to_thai_date($rs->BIRTH);
            $rs->AMPNAME = get_ampur_name($rs->vhid);
            $rs->HOSPMAIN = get_hospmain($rs->HOSPCODE);
            if ($rs) {
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
            } else {
                $json = '{"success": true, "check": false}';
            }
        }

        render_json($json);
    }
}
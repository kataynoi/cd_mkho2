<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_vaccine extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

                if(!$this->session->userdata("login"))
                    redirect(site_url("user/login"));
        $this->load->model('Person_vaccine_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["cvaccine_status"] = $this->crud->get_cvaccine_status();
        $this->layout->view('person_vaccine/index', $data);
    }


    function fetch_person_vaccine()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        $cvaccine_status = $this->crud->get_cvaccine_status();
        
        foreach ($fetch_data as $row) {
            $option ="";
            foreach($cvaccine_status as $r){
                $selected='';
                if($r['id']==$row->vaccine_status){
                    $selected='selected';
                }
                    $option .="<option value='".$r['id']."' ".$selected.">".$r['name']."</option>";
            }
            $sub_array = array();
                $sub_array[] = "<select data-btn='sl_vaccine_status' data-cid='".$row->CID."' >".$option."</select>";
                $sub_array[] = $row->HOSPCODE;
                $sub_array[] = $row->CID;
                $sub_array[] = $row->NAME;
                $sub_array[] = $row->LNAME;
                $sub_array[] = $row->SEX;
                $sub_array[] = to_thai_date($row->BIRTH);
                $sub_array[] = $row->TYPEAREA;
                $sub_array[] = $row->vhid;
                //$sub_array[] = $row->check_vhid;
                $sub_array[] = $row->age_y;
               // $sub_array[] = $row->addr;
                //$sub_array[] = $row->home;
                $sub_array[] = to_thai_date($row->vaccine_plan1_date);
                $sub_array[] = $row->vaccine_hosp1;
                $sub_array[] = $row->vaccine_name1;
                $sub_array[] = to_thai_date($row->vaccine_plan2_date);
                $sub_array[] = $row->vaccine_hosp2;
                $sub_array[] = $row->vaccine_name2;
                $sub_array[] = $cvaccine_status[$row->vaccine_status_survey - 1]["name"];
                $sub_array[] = $row->vaccine_provname;
                
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

    public function del_person_vaccine(){
        $id = $this->input->post('id');

        $rs=$this->crud->del_person_vaccine($id);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
    public function set_vaccine_status(){
        $cid = $this->input->post('cid');
        $val = $this->input->post('val');

        $rs=$this->crud->set_vaccine_status($cid,$val);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
    public function  save_person_vaccine()
    {
            $data = $this->input->post('items');
            if($data['action']=='insert'){
                $rs=$this->crud->save_person_vaccine($data);
                if($rs){
                    $json = '{"success": true,"id":'.$rs.'}';
                  }else{
                    $json = '{"success": false}';
                  }
            }else if($data['action']=='update'){
                $rs=$this->crud->update_person_vaccine($data);
                    if($rs){
                        $json = '{"success": true}';
                    }else{
                        $json = '{"success": false}';
                    }
            }

            render_json($json);
        }

    public function  get_person_vaccine()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_person_vaccine($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
}
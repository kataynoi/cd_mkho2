<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_vaccine_needle3_set extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

                if(!$this->session->userdata("login"))
                    redirect(site_url("user/login"));
        $this->load->model('Person_vaccine_needle3_set_model', 'crud');
        $this->load->model('Dashboard_model', 'dash');
    }

    public function index()
    {
        $data[] = '';
        $data["cvaccine_status"] = $this->crud->get_cvaccine_status();
        $this->layout->view('person_vaccine_needle3_set/index', $data);
    }
    public function set_person()
    {
        $data[] = '';
        $data["cvaccine_status"] = $this->crud->get_cvaccine_status();
        $this->layout->view('person_vaccine_needle3/set_person', $data);
    }

    
    public function countdown()
    { $this->layout->setLayout('print_layout');

        $data['summary'] = $this->dash->get_summary();
        $data['ampur'] = $this->dash->get_summary_ampur();
        $this->layout->view('person_vaccine_needle3/countdown', $data);
        
    }
    function fetch_person_vaccine()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        
        
        foreach ($fetch_data as $row) {
            if($row->target_needle3_14!=''){
                
                    $needle3 = "<div class='test-center'><button class='btn btn-info'><i class='fa fa-check'></i></button></div>";
        
                
                    }else{
                $needle3 ="<button class='btn btn-success' data-btn='btn_needle3' data-cid='".$row->CID."'>กำหนดเป็นกลุ่มเป้าหมาย</button>";
            }

           $day_needle2 = get_current_age($row->vaccine_plan2_date);
            $sub_array = array();
                $sub_array[] = $needle3;
                $sub_array[] = $row->CID;
                $sub_array[] = $row->NAME;
                $sub_array[] = $row->LNAME;
                $sub_array[] = $row->SEX;
                $sub_array[] = to_thai_date($row->BIRTH);
                $sub_array[] = $row->TYPEAREA;
                $sub_array[] = $row->addr." ".get_address($row->vhid);
                $sub_array[] = $row->age_y;
                $sub_array[] = to_thai_date($row->vaccine_plan2_date);
                $sub_array[] = $row->vaccine_hosp2;
                $sub_array[] = $row->vaccine_name1."/".$row->vaccine_name2;
                $sub_array[] = $row->vaccine_provname;
                $sub_array[] = $day_needle2['month']." เดือน ".$day_needle2['day']." วัน";
                $sub_array[] = to_thai_date($row->vaccine_plan3_date)."-".$row->vaccine_name3;
                
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

        $rs=$this->crud->set_vaccine_status($cid);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function set_need_vaccine3(){
        $cid = $this->input->post('cid');

        $rs=$this->crud->set_need_vaccine3($cid);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }



   // set_need_vaccine3
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
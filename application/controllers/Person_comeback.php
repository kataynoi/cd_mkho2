<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Person_comeback extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata("comeback_login"))
           redirect(site_url("user/login_comeback"));
        // $this->layout->setLeft("layout/left_admin");
        $this->layout->setHeader('layout/header_comeback');
        $this->layout->setLayout('comeback_layout');
        $this->load->model('Person_comeback_model', 'crud');
    }

    public function index()
    {
        $data[] = '';

        $this->layout->view('person_comeback/index', $data);
    }


    function fetch_person_comeback()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        //$lab_type = array("Volvo", "BMW", "Toyota");
        $lab_type = get_lab_type();
        $process_status = get_process_status();
        $travel_status = get_ctravel_status();
        $travel_type = get_ctravel_type();
        $chronic = get_chronic();
        $row_id1=1;
        $row_id2=1;
        foreach ($fetch_data as $row) {

            if($row->sat_confirm_bed==1){$color_b='btn-success';$fa_b='fa-check';}else{$color_b='btn-danger';$fa_b='fa-times';};
            if($row->sat_confirm_travel==1){$color_t='btn-success';$fa_t='fa-check';}else{$color_t='btn-danger';$fa_t='fa-times';};
            $sat_confirm_bed='<button class="btn   '.$color_b.'" alt="แจ้งSATได้เตียง" data-row_id1='.$row_id1.' data-btn="btn_confirm_bed" data-id='.$row->id.' data-val="'.$row->sat_confirm_bed.'"><i class="fa '.$fa_b.'" aria-hidden="true"></i></button>';
            $sat_confirm_travel='<button class="btn    '.$color_t.'" alt=" แจ้งSATเดินทาง" data-row_id2='.$row_id2.' data-btn="btn_confirm_travel" data-id='.$row->id.' data-val="'.$row->sat_confirm_travel.'"><i class="fa '.$fa_t.'" aria-hidden="true"></i></button>';
            $attach_files='<a class="btn btn-info " href="'.site_url('person_comeback/files/').$row->id.'"><i class="fa fa-paperclip" aria-hidden="true"></i>
            แนบไฟลล์</a>';
           if($this->session->userdata('user_level')==1){
               $delete = '<button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';
           }else{
            $delete = "";
              }
            $sub_array = array();
            $sub_array[] = '<div class="btn-group pull-right" role="group" >
            <button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' . $row->id . '"><i class="fa fa-edit"></i></button>'.$delete.'</div>';
           
            $sub_array[] = to_thai_date_time($row->date_input);
            $sub_array[] = '<p class="text-center"><div class="btn-group btn-toggle">'.$sat_confirm_bed.$sat_confirm_travel.$attach_files.'</div></p>';
            $sub_array[] = $process_status[$row->process_status-1]["name"];
            $sub_array[] = $row->prename.$row->name."  ".$row->lname;
            $sub_array[] = $row->cid;
            $sub_array[] = $lab_type[$row->lab_type-1]["name"];
            $sub_array[] = $row->lab_date ? to_thai_date($row->lab_date)."  <br>ตรวจแล้ว ".DateDiff($row->lab_date)."":"";
            $sub_array[] = $row->tel;
            $sub_array[] = $travel_status[$row->travel_status-1]["name"];
            $sub_array[] = to_thai_date($row->travel_date);
            $sub_array[] = ($row->address)? $row->address ." อ.".get_ampur_name_ampcode($row->amp):$row->no." ".get_address($row->moo);
            $sub_array[] = $travel_type[$row->travel_type-1]["name"];  
            $sub_array[] = $row->age_y;
            $sub_array[] = ($row->sex==1 ? 'ชาย':($row->sex==2 ? 'หญิง':''));
            $sub_array[] = $row->weight;
            $sub_array[] = $row->symptom;
            $sub_array[] = ($row->chronic !=NULL)? $chronic[$row->chronic-1]["name"]:'';
            $sub_array[] = $row->note;
           // $sub_array[] = $row->confirm_case;
           //     $sub_array[] = $row->call_confirm;
               // $sub_array[] = $row->birth;
                $data[] = $sub_array;
                $row_id1++;$row_id2++;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data(),
            "recordsFiltered" => $this->crud->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_person_comeback()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_person_comeback($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_person_comeback()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_person_comeback($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_person_comeback($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_person_comeback($id)
    {
        $rs = $this->crud->get_person_comeback($id);
        return $rs;
    }

    public function add_person_comeback($id=null)
    {
        $data['person']='';
        $data['action']= 'insert';
        if($id!=null){
            $data['person'] = $this->get_person_comeback($id);
            $data['action']='update';
            $data["campur"] = $this->crud->get_campur($data['person']->prov);
            $data["ctambon"] = $this->crud->get_ctambon($data['person']->amp);
            $data["cvillage"] = $this->crud->get_cvillage($data['person']->tambon);
        }
        //$data["campur"] = $this->crud->get_campur();
        $data["cchangwat"] = $this->crud->get_cchangwat();
        $data["clab_type"] = $this->crud->get_clab_type();
        $data["ctravel_status"] = $this->crud->get_ctravel_status();
        $data["ctravel_type"] = $this->crud->get_ctravel_type();
        $data["cprocess_status"] = $this->crud->get_cprocess_status();
        $data["chospmain"] = $this->crud->get_hospmain();
        $data["chronic"] = $this->crud->get_cchronic();
        $this->layout->view('person_comeback/add_person_comeback', $data);
    }

    public function get_person_by_cid()
    {
        $cid = $this->input->post('cid');
        if ($this->crud->check_person_cid($cid) >= 1) {
            $json = '{"success": true, "check":true}';
        } else {
            $rs = $this->crud->get_person_cid($cid);
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
    public function files ($id){
        $data['files']= "";
        $this->layout->view('person_comeback/files',$data);
    }
}